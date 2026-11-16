<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Kos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_user' => User::where('role', User::ROLE_USER)->count(),
            'total_pemilik' => User::where('role', User::ROLE_PEMILIK)->count(),
            'total_kos' => Kos::count(),
            'total_booking' => Booking::count(),
            'booking_menunggu' => Booking::where('status', 'menunggu')->count(),
            'booking_diterima' => Booking::where('status', 'diterima')->count(),
            'nilai_booking_diterima' => Booking::where('status', 'diterima')->sum('total_harga'),
        ];

        $bookingTerbaru = Booking::with(['user', 'kos'])->latest()->take(8)->get();

        return view('admin.dashboard', compact('stats', 'bookingTerbaru'));
    }

    public function users()
    {
        $users = User::latest()->get();

        return view('admin.users', compact('users'));
    }

    public function kos()
    {
        $kos = Kos::with('pemilik')->withCount('bookings')->latest()->get();

        return view('admin.kos', compact('kos'));
    }

    public function toggleKos(Kos $kos)
    {
        $kos->update(['is_active' => ! $kos->is_active]);

        return back()->with('success', $kos->is_active
            ? "Kos {$kos->nama} diaktifkan kembali."
            : "Kos {$kos->nama} dinonaktifkan dan tidak tampil di katalog.");
    }

    public function bookings()
    {
        $bookings = Booking::with(['user', 'kos.pemilik'])->latest()->get();

        return view('admin.bookings', compact('bookings'));
    }

    public function updateBookingStatus(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(['menunggu', 'diterima', 'ditolak', 'selesai'])],
        ]);

        // Jaga stok tetap konsisten kalau admin mengubah keputusan pemilik.
        if ($booking->status !== 'diterima' && $data['status'] === 'diterima' && $booking->kos->kamar_tersedia > 0) {
            $booking->kos->decrement('kamar_tersedia');
        }
        if ($booking->status === 'diterima' && $data['status'] !== 'diterima') {
            $booking->kos->increment('kamar_tersedia');
        }

        $booking->update(['status' => $data['status']]);

        return back()->with('success', "Status booking {$booking->kode_booking} diubah menjadi {$data['status']}.");
    }
}
