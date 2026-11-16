@extends('layouts.app')

@section('title', 'Kos Saya - MyKos')

@section('content')
<section class="max-w-6xl mx-auto px-5 pt-10">
    <div class="flex flex-wrap justify-between items-end gap-4">
        <div>
            <h1 class="text-3xl font-extrabold">Kos Saya</h1>
            <p class="text-soft mt-1">Hanya kos milikmu yang tampil dan bisa diubah di sini.</p>
        </div>
        <a href="{{ route('pemilik.kos.create') }}" class="bg-accent hover:bg-accentdark text-white font-bold rounded-[10px] px-5 py-2.5">Tambah Kos</a>
    </div>

    @if ($kos->isEmpty())
        <div class="mt-6 bg-white border-[1.5px] border-dashed border-line rounded-2xl p-10 text-center">
            <h2 class="font-extrabold text-lg">Kamu belum memasang kos</h2>
            <p class="text-soft mt-1">Tambahkan kos pertamamu, lengkap dengan titik petanya, supaya bisa ditemukan penyewa.</p>
            <a href="{{ route('pemilik.kos.create') }}" class="inline-block mt-4 bg-pine hover:bg-pinedark text-white font-bold rounded-[10px] px-5 py-2.5">Tambah Kos</a>
        </div>
    @else
        <div class="mt-6 bg-white border border-line rounded-2xl overflow-x-auto">
            <table class="w-full text-[15px] min-w-[760px]">
                <thead>
                    <tr class="text-left border-b border-line text-soft text-[13px]">
                        <th class="px-5 py-3.5">Nama kos</th>
                        <th class="px-5 py-3.5">Kota</th>
                        <th class="px-5 py-3.5">Harga / bulan</th>
                        <th class="px-5 py-3.5">Sisa kamar</th>
                        <th class="px-5 py-3.5">Status</th>
                        <th class="px-5 py-3.5">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kos as $k)
                        <tr class="border-b border-line last:border-0">
                            <td class="px-5 py-3.5 font-bold">{{ $k->nama }}</td>
                            <td class="px-5 py-3.5">{{ $k->kota }}</td>
                            <td class="px-5 py-3.5">Rp{{ number_format($k->harga, 0, ',', '.') }}</td>
                            <td class="px-5 py-3.5">{{ $k->kamar_tersedia }}</td>
                            <td class="px-5 py-3.5">{{ $k->is_active ? 'Aktif' : 'Nonaktif oleh admin' }}</td>
                            <td class="px-5 py-3.5 whitespace-nowrap">
                                <a href="{{ route('kos.show', $k) }}" class="text-pine font-bold mr-3">Lihat</a>
                                <a href="{{ route('pemilik.kos.edit', $k) }}" class="text-pine font-bold mr-3">Edit</a>
                                <form method="POST" action="{{ route('pemilik.kos.destroy', $k) }}" class="inline" onsubmit="return confirm('Hapus kos {{ $k->nama }}? Booking yang terkait juga ikut terhapus.')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-accentdark font-bold">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</section>
@endsection
