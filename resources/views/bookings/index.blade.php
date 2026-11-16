@extends('layouts.app')

@section('title', 'Booking Saya - MyKos')

@section('content')
<section class="max-w-6xl mx-auto px-5 pt-10">
    <h1 class="text-3xl font-extrabold">Booking Saya</h1>
    <p class="text-soft mt-1">Tunjukkan kode booking ke pemilik saat kamu datang check-in.</p>

    @if ($bookings->isEmpty())
        <div class="mt-6 bg-white border-[1.5px] border-dashed border-line rounded-2xl p-10 text-center">
            <h2 class="font-extrabold text-lg">Kamu belum punya booking</h2>
            <p class="text-soft mt-1">Cari kos dulu dari katalog atau peta, lalu booking dari halaman detailnya.</p>
            <a href="{{ route('home') }}" class="inline-block mt-4 bg-pine hover:bg-pinedark text-white font-bold rounded-[10px] px-5 py-2.5">Cari Kos</a>
        </div>
    @else
        <div class="mt-6 bg-white border border-line rounded-2xl overflow-x-auto">
            <table class="w-full text-[15px] min-w-[760px]">
                <thead>
                    <tr class="text-left border-b border-line text-soft text-[13px]">
                        <th class="px-5 py-3.5">Kode booking</th>
                        <th class="px-5 py-3.5">Kos</th>
                        <th class="px-5 py-3.5">Tanggal masuk</th>
                        <th class="px-5 py-3.5">Durasi</th>
                        <th class="px-5 py-3.5">Total</th>
                        <th class="px-5 py-3.5">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $b)
                        <tr class="border-b border-line last:border-0">
                            <td class="px-5 py-3.5 font-extrabold">{{ $b->kode_booking }}</td>
                            <td class="px-5 py-3.5"><a href="{{ route('kos.show', $b->kos) }}" class="text-pine font-bold">{{ $b->kos->nama }}</a><span class="block text-[13px] text-soft">{{ $b->kos->kota }}</span></td>
                            <td class="px-5 py-3.5">{{ $b->tanggal_masuk->format('d M Y') }}</td>
                            <td class="px-5 py-3.5">{{ $b->durasi_bulan }} bulan</td>
                            <td class="px-5 py-3.5 font-bold">Rp{{ number_format($b->total_harga, 0, ',', '.') }}</td>
                            <td class="px-5 py-3.5">@include('partials.booking-status', ['status' => $b->status])</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</section>
@endsection
