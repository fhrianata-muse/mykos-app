@extends('layouts.app')

@section('title', 'Kelola Kos - Admin MyKos')

@section('content')
<section class="max-w-6xl mx-auto px-5 pt-10">
    <h1 class="text-3xl font-extrabold">Kelola Kos</h1>
    <p class="text-soft mt-1">Semua listing di platform. Nonaktifkan listing yang bermasalah agar hilang dari katalog dan peta tanpa menghapus datanya.</p>

    <div class="mt-6 bg-white border border-line rounded-2xl overflow-x-auto">
        <table class="w-full text-[15px] min-w-[820px]">
            <thead>
                <tr class="text-left border-b border-line text-soft text-[13px]">
                    <th class="px-5 py-3.5">Nama kos</th>
                    <th class="px-5 py-3.5">Pemilik</th>
                    <th class="px-5 py-3.5">Kota</th>
                    <th class="px-5 py-3.5">Harga</th>
                    <th class="px-5 py-3.5">Booking</th>
                    <th class="px-5 py-3.5">Tayang</th>
                    <th class="px-5 py-3.5">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kos as $k)
                    <tr class="border-b border-line last:border-0">
                        <td class="px-5 py-3.5 font-bold">{{ $k->nama }}</td>
                        <td class="px-5 py-3.5">{{ $k->pemilik->name }}</td>
                        <td class="px-5 py-3.5">{{ $k->kota }}</td>
                        <td class="px-5 py-3.5">Rp{{ number_format($k->harga, 0, ',', '.') }}</td>
                        <td class="px-5 py-3.5">{{ $k->bookings_count }}</td>
                        <td class="px-5 py-3.5">{{ $k->is_active ? 'Ya' : 'Tidak' }}</td>
                        <td class="px-5 py-3.5 whitespace-nowrap">
                            <form method="POST" action="{{ route('admin.kos.toggle', $k) }}" class="inline">
                                @csrf
                                @method('PATCH')
                                <button class="font-bold {{ $k->is_active ? 'text-accentdark' : 'text-pine' }}">{{ $k->is_active ? 'Nonaktifkan' : 'Aktifkan' }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <p class="mt-5"><a href="{{ route('admin.dashboard') }}" class="text-pine font-bold">Kembali ke dashboard admin</a></p>
</section>
@endsection
