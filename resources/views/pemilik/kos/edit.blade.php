@extends('layouts.app')

@section('title', 'Edit Kos - MyKos')

@section('content')
<section class="max-w-3xl mx-auto px-5 pt-10">
    <h1 class="text-3xl font-extrabold">Edit Kos: {{ $kos->nama }}</h1>
    <form method="POST" action="{{ route('pemilik.kos.update', $kos) }}" class="bg-white border border-line rounded-[20px] p-6 mt-6">
        @csrf
        @method('PUT')
        @include('pemilik.kos._form')
        <button class="mt-6 bg-accent hover:bg-accentdark text-white font-bold rounded-[10px] px-6 py-3">Simpan Perubahan</button>
        <a href="{{ route('pemilik.kos.index') }}" class="ml-3 font-bold text-pine">Batal</a>
    </form>
</section>
@endsection
