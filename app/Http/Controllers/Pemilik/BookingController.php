<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::whereIn('kos_id', auth()->user()->kos()->pluck('id'))
            ->with(['user', 'kos'])
            ->latest()
            ->get();

        return view('pemilik.bookings.index', compact('bookings'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        abort_unless($booking->kos->user_id === auth()->id(), 403, 'Ini bukan booking untuk kos milikmu.');

        $data = $request->validate([
            'status' => ['required', Rule::in(['diterima', 'ditolak'])],
        ]);

        if ($booking->status !== 'menunggu') {
            return back()->withErrors(['status' => 'Status booking ini sudah diputuskan.']);
        }

        if ($data['status'] === 'diterima') {
            if ($booking->kos->kamar_tersedia < 1) {
                return back()->withErrors(['status' => 'Kamar sudah habis, booking tidak bisa diterima.']);
            }
            // Satu booking yang diterima mengurangi satu kamar tersedia.
            $booking->kos->decrement('kamar_tersedia');
        }

        $booking->update(['status' => $data['status']]);

        return back()->with('success', "Booking {$booking->kode_booking} berhasil {$data['status']}.");
    }
}
