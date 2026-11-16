@extends('layouts.app')

@section('title', 'Panel Pemilik - MyKos')

@section('content')
<section class="max-w-6xl mx-auto px-5 pt-10">
    <div class="flex flex-wrap justify-between items-end gap-4">
        <div>
            <h1 class="text-3xl font-extrabold">Panel Pemilik</h1>
            <p class="text-soft mt-1">Halo, {{ auth()->user()->name }}. Ini ringkasan kos dan bookingmu.</p>
        </div>
        <a href="{{ route('pemilik.kos.create') }}" class="bg-accent hover:bg-accentdark text-white font-bold rounded-[10px] px-5 py-2.5">Tambah Kos</a>
    </div>

    <div class="grid sm:grid-cols-3 gap-5 mt-7">
        <div class="bg-white border border-line rounded-2xl p-5">
            <p class="text-[13px] font-bold text-soft">Kos saya</p>
            <p class="text-3xl font-extrabold mt-1">{{ $kosSaya->count() }}</p>
        </div>
        <div class="bg-white border border-line rounded-2xl p-5">
            <p class="text-[13px] font-bold text-soft">Total kamar tersedia</p>
            <p class="text-3xl font-extrabold mt-1">{{ $kosSaya->sum('kamar_tersedia') }}</p>
        </div>
        <div class="bg-white border border-line rounded-2xl p-5">
            <p class="text-[13px] font-bold text-soft">Booking menunggu keputusan</p>
            <p class="text-3xl font-extrabold mt-1 {{ $menunggu > 0 ? 'text-accentdark' : '' }}">{{ $menunggu }}</p>
        </div>
    </div>

    <div class="flex gap-3 mt-8">
        <a href="{{ route('pemilik.kos.index') }}" class="bg-pine hover:bg-pinedark text-white font-bold rounded-[10px] px-5 py-2.5">Kelola Kos Saya</a>
        <a href="{{ route('pemilik.bookings.index') }}" class="border-[1.5px] border-pine text-pine font-bold rounded-[10px] px-5 py-2.5 hover:bg-[#e7efec]">Lihat Semua Booking Masuk</a>
    </div>

    <h2 class="text-xl font-extrabold mt-10">Booking masuk terbaru</h2>
    @if ($bookingMasuk->isEmpty())
        <p class="text-soft mt-2">Belum ada booking masuk. Pastikan kosmu tampil di katalog dan titik petanya benar.</p>
    @else
        <div class="mt-4 bg-white border border-line rounded-2xl overflow-x-auto">
            <table class="w-full text-[15px] min-w-[680px]">
                <thead>
                    <tr class="text-left border-b border-line text-soft text-[13px]">
                        <th class="px-5 py-3.5">Kode</th>
                        <th class="px-5 py-3.5">Penyewa</th>
                        <th class="px-5 py-3.5">Kos</th>
                        <th class="px-5 py-3.5">Masuk</th>
                        <th class="px-5 py-3.5">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookingMasuk as $b)
                        <tr class="border-b border-line last:border-0">
                            <td class="px-5 py-3.5 font-extrabold">{{ $b->kode_booking }}</td>
                            <td class="px-5 py-3.5">{{ $b->user->name }}</td>
                            <td class="px-5 py-3.5">{{ $b->kos->nama }}</td>
                            <td class="px-5 py-3.5">{{ $b->tanggal_masuk->format('d M Y') }}</td>
                            <td class="px-5 py-3.5">@include('partials.booking-status', ['status' => $b->status])</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</section>
@endsection
