<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Kos;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = auth()->user()->bookings()
            ->with('kos')
            ->latest()
            ->get();

        return view('bookings.index', compact('bookings'));
    }

    public function store(Request $request, Kos $kos)
    {
        abort_unless($kos->is_active, 404);

        if ($kos->kamar_tersedia < 1) {
            return back()->withErrors(['booking' => 'Kamar di kos ini sudah habis.']);
        }

        $data = $request->validate([
            'tanggal_masuk' => ['required', 'date', 'after_or_equal:today'],
            'durasi_bulan' => ['required', 'integer', 'min:1', 'max:12'],
            'catatan' => ['nullable', 'string', 'max:500'],
        ]);

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'kos_id' => $kos->id,
            'kode_booking' => $this->buatKodeBooking(),
            'tanggal_masuk' => $data['tanggal_masuk'],
            'durasi_bulan' => $data['durasi_bulan'],
            'total_harga' => $kos->harga * $data['durasi_bulan'],
            'catatan' => $data['catatan'] ?? null,
        ]);

        return redirect()->route('bookings.index')
            ->with('success', "Booking {$booking->kode_booking} terkirim. Tunggu konfirmasi dari pemilik kos.");
    }

    private function buatKodeBooking(): string
    {
        do {
            $kode = 'MK-' . strtoupper(Str::random(8));
        } while (Booking::where('kode_booking', $kode)->exists());

        return $kode;
    }
}
