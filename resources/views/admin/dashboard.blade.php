@extends('layouts.app')

@section('title', 'Panel Admin CRM - MyKos')

@section('content')
<section class="max-w-6xl mx-auto px-5 pt-10">
    <h1 class="text-3xl font-extrabold">Panel Admin (CRM)</h1>
    <p class="text-soft mt-1">Ringkasan platform untuk mengelola customer: siapa penggunanya, kos apa yang tayang, dan booking mana yang perlu perhatian.</p>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 mt-7">
        <div class="bg-white border border-line rounded-2xl p-5">
            <p class="text-[13px] font-bold text-soft">Penyewa terdaftar</p>
            <p class="text-3xl font-extrabold mt-1">{{ $stats['total_user'] }}</p>
        </div>
        <div class="bg-white border border-line rounded-2xl p-5">
            <p class="text-[13px] font-bold text-soft">Pemilik kos</p>
            <p class="text-3xl font-extrabold mt-1">{{ $stats['total_pemilik'] }}</p>
        </div>
        <div class="bg-white border border-line rounded-2xl p-5">
            <p class="text-[13px] font-bold text-soft">Listing kos</p>
            <p class="text-3xl font-extrabold mt-1">{{ $stats['total_kos'] }}</p>
        </div>
        <div class="bg-white border border-line rounded-2xl p-5">
            <p class="text-[13px] font-bold text-soft">Total booking</p>
            <p class="text-3xl font-extrabold mt-1">{{ $stats['total_booking'] }}</p>
        </div>
        <div class="bg-white border border-line rounded-2xl p-5">
            <p class="text-[13px] font-bold text-soft">Booking menunggu</p>
            <p class="text-3xl font-extrabold mt-1 {{ $stats['booking_menunggu'] > 0 ? 'text-accentdark' : '' }}">{{ $stats['booking_menunggu'] }}</p>
        </div>
        <div class="bg-white border border-line rounded-2xl p-5">
            <p class="text-[13px] font-bold text-soft">Booking diterima</p>
            <p class="text-3xl font-extrabold mt-1">{{ $stats['booking_diterima'] }}</p>
        </div>
        <div class="bg-white border border-line rounded-2xl p-5 col-span-2">
            <p class="text-[13px] font-bold text-soft">Nilai booking diterima</p>
            <p class="text-3xl font-extrabold mt-1">Rp{{ number_format($stats['nilai_booking_diterima'], 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="flex flex-wrap gap-3 mt-8">
        <a href="{{ route('admin.users') }}" class="bg-pine hover:bg-pinedark text-white font-bold rounded-[10px] px-5 py-2.5">Kelola User (CRM)</a>
        <a href="{{ route('admin.kos') }}" class="border-[1.5px] border-pine text-pine font-bold rounded-[10px] px-5 py-2.5 hover:bg-[#e7efec]">Kelola Kos</a>
        <a href="{{ route('admin.bookings') }}" class="border-[1.5px] border-pine text-pine font-bold rounded-[10px] px-5 py-2.5 hover:bg-[#e7efec]">Kelola Booking</a>
    </div>

    <h2 class="text-xl font-extrabold mt-10">Booking terbaru di platform</h2>
    <div class="mt-4 bg-white border border-line rounded-2xl overflow-x-auto">
        <table class="w-full text-[15px] min-w-[720px]">
            <thead>
                <tr class="text-left border-b border-line text-soft text-[13px]">
                    <th class="px-5 py-3.5">Kode</th>
                    <th class="px-5 py-3.5">Penyewa</th>
                    <th class="px-5 py-3.5">Kos</th>
                    <th class="px-5 py-3.5">Total</th>
                    <th class="px-5 py-3.5">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookingTerbaru as $b)
                    <tr class="border-b border-line last:border-0">
                        <td class="px-5 py-3.5 font-extrabold">{{ $b->kode_booking }}</td>
                        <td class="px-5 py-3.5">{{ $b->user->name }}</td>
                        <td class="px-5 py-3.5">{{ $b->kos->nama }}</td>
                        <td class="px-5 py-3.5 font-bold">Rp{{ number_format($b->total_harga, 0, ',', '.') }}</td>
                        <td class="px-5 py-3.5">@include('partials.booking-status', ['status' => $b->status])</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-5 py-6 text-soft">Belum ada booking di platform.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
