@extends('layouts.app')

@section('title', 'Tambah Kos - MyKos')

@section('content')
<section class="max-w-3xl mx-auto px-5 pt-10">
    <h1 class="text-3xl font-extrabold">Tambah Kos Baru</h1>
    <p class="text-soft mt-1">Kos langsung tampil di katalog dan peta begitu disimpan.</p>
    <form method="POST" action="{{ route('pemilik.kos.store') }}" class="bg-white border border-line rounded-[20px] p-6 mt-6">
        @csrf
        @include('pemilik.kos._form')
        <button class="mt-6 bg-accent hover:bg-accentdark text-white font-bold rounded-[10px] px-6 py-3">Simpan Kos</button>
        <a href="{{ route('pemilik.kos.index') }}" class="ml-3 font-bold text-pine">Batal</a>
    </form>
</section>
@endsection
