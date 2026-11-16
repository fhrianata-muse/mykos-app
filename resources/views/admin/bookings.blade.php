@extends('layouts.app')

@section('title', 'Kelola Booking - Admin MyKos')

@section('content')
<section class="max-w-6xl mx-auto px-5 pt-10">
    <h1 class="text-3xl font-extrabold">Kelola Booking</h1>
    <p class="text-soft mt-1">Semua booking di platform. Admin dapat mengoreksi status, misalnya menandai booking selesai setelah penyewa check-in dan masa sewanya berjalan.</p>

    <div class="mt-6 bg-white border border-line rounded-2xl overflow-x-auto">
        <table class="w-full text-[15px] min-w-[900px]">
            <thead>
                <tr class="text-left border-b border-line text-soft text-[13px]">
                    <th class="px-5 py-3.5">Kode</th>
                    <th class="px-5 py-3.5">Penyewa</th>
                    <th class="px-5 py-3.5">Kos / Pemilik</th>
                    <th class="px-5 py-3.5">Masuk</th>
                    <th class="px-5 py-3.5">Total</th>
                    <th class="px-5 py-3.5">Status</th>
                    <th class="px-5 py-3.5">Ubah status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $b)
                    <tr class="border-b border-line last:border-0 align-top">
                        <td class="px-5 py-3.5 font-extrabold">{{ $b->kode_booking }}</td>
                        <td class="px-5 py-3.5">{{ $b->user->name }}<span class="block text-[13px] text-soft">{{ $b->user->email }}</span></td>
                        <td class="px-5 py-3.5">{{ $b->kos->nama }}<span class="block text-[13px] text-soft">{{ $b->kos->pemilik->name }}</span></td>
                        <td class="px-5 py-3.5">{{ $b->tanggal_masuk->format('d M Y') }}</td>
                        <td class="px-5 py-3.5 font-bold">Rp{{ number_format($b->total_harga, 0, ',', '.') }}</td>
                        <td class="px-5 py-3.5">@include('partials.booking-status', ['status' => $b->status])</td>
                        <td class="px-5 py-3.5">
                            <form method="POST" action="{{ route('admin.bookings.status', $b) }}" class="flex gap-2">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="border-[1.5px] border-line rounded-[8px] px-2 py-1.5 text-sm bg-white">
                                    @foreach (['menunggu', 'diterima', 'ditolak', 'selesai'] as $s)
                                        <option value="{{ $s }}" @selected($b->status === $s)>{{ ucfirst($s) }}</option>
                                    @endforeach
                                </select>
                                <button class="bg-pine hover:bg-pinedark text-white font-bold text-sm rounded-[8px] px-3 py-1.5">Simpan</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="px-5 py-6 text-soft">Belum ada booking di platform.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <p class="mt-5"><a href="{{ route('admin.dashboard') }}" class="text-pine font-bold">Kembali ke dashboard admin</a></p>
</section>
@endsection
