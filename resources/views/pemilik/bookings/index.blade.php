@extends('layouts.app')

@section('title', 'Booking Masuk - MyKos')

@section('content')
<section class="max-w-6xl mx-auto px-5 pt-10">
    <h1 class="text-3xl font-extrabold">Booking Masuk</h1>
    <p class="text-soft mt-1">Terima booking untuk mengunci satu kamar bagi penyewa. Stok kamar berkurang otomatis saat booking diterima.</p>

    @if ($bookings->isEmpty())
        <div class="mt-6 bg-white border-[1.5px] border-dashed border-line rounded-2xl p-10 text-center">
            <h2 class="font-extrabold text-lg">Belum ada booking masuk</h2>
            <p class="text-soft mt-1">Booking dari penyewa akan muncul di sini.</p>
        </div>
    @else
        <div class="mt-6 bg-white border border-line rounded-2xl overflow-x-auto">
            <table class="w-full text-[15px] min-w-[860px]">
                <thead>
                    <tr class="text-left border-b border-line text-soft text-[13px]">
                        <th class="px-5 py-3.5">Kode</th>
                        <th class="px-5 py-3.5">Penyewa</th>
                        <th class="px-5 py-3.5">Kos</th>
                        <th class="px-5 py-3.5">Masuk</th>
                        <th class="px-5 py-3.5">Durasi</th>
                        <th class="px-5 py-3.5">Total</th>
                        <th class="px-5 py-3.5">Status</th>
                        <th class="px-5 py-3.5">Keputusan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $b)
                        <tr class="border-b border-line last:border-0 align-top">
                            <td class="px-5 py-3.5 font-extrabold">{{ $b->kode_booking }}</td>
                            <td class="px-5 py-3.5">{{ $b->user->name }}<span class="block text-[13px] text-soft">{{ $b->user->phone ?? $b->user->email }}</span></td>
                            <td class="px-5 py-3.5">{{ $b->kos->nama }}</td>
                            <td class="px-5 py-3.5">{{ $b->tanggal_masuk->format('d M Y') }}</td>
                            <td class="px-5 py-3.5">{{ $b->durasi_bulan }} bulan</td>
                            <td class="px-5 py-3.5 font-bold">Rp{{ number_format($b->total_harga, 0, ',', '.') }}</td>
                            <td class="px-5 py-3.5">@include('partials.booking-status', ['status' => $b->status])</td>
                            <td class="px-5 py-3.5 whitespace-nowrap">
                                @if ($b->status === 'menunggu')
                                    <form method="POST" action="{{ route('pemilik.bookings.status', $b) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="diterima">
                                        <button class="bg-pine hover:bg-pinedark text-white font-bold text-sm rounded-[8px] px-3 py-1.5 mr-1">Terima</button>
                                    </form>
                                    <form method="POST" action="{{ route('pemilik.bookings.status', $b) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="ditolak">
                                        <button class="border-[1.5px] border-accent text-accentdark font-bold text-sm rounded-[8px] px-3 py-1.5">Tolak</button>
                                    </form>
                                @else
                                    <span class="text-soft text-sm">Sudah diputuskan</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</section>
@endsection
