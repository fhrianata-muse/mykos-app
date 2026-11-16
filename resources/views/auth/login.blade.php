@extends('layouts.app')

@section('title', 'Masuk - MyKos')

@section('content')
<section class="max-w-md mx-auto px-5 pt-14">
    <div class="bg-white border border-line rounded-[20px] p-7">
        <h1 class="text-2xl font-extrabold">Masuk ke MyKos</h1>
        <p class="text-soft text-[15px] mt-1">Satu akun untuk semua peran. Panel yang terbuka mengikuti peran akunmu.</p>
        <form method="POST" action="{{ route('login') }}" class="grid gap-4 mt-6">
            @csrf
            <div>
                <label for="email" class="block text-[13px] font-bold text-soft mb-1.5">Email</label>
                <input type="email" id="email" name="email" required value="{{ old('email') }}" class="w-full border-[1.5px] border-line rounded-[10px] px-3 py-2.5">
            </div>
            <div>
                <label for="password" class="block text-[13px] font-bold text-soft mb-1.5">Password</label>
                <input type="password" id="password" name="password" required class="w-full border-[1.5px] border-line rounded-[10px] px-3 py-2.5">
            </div>
            <label class="flex items-center gap-2 text-sm font-semibold">
                <input type="checkbox" name="remember" class="rounded"> Ingat saya
            </label>
            <button class="bg-accent hover:bg-accentdark text-white font-bold rounded-[10px] px-6 py-3">Masuk</button>
        </form>
        <p class="text-sm text-soft mt-5">Belum punya akun? <a href="{{ route('register') }}" class="text-pine font-bold">Daftar di sini</a></p>
        <div class="text-[13px] text-soft bg-cream border border-line rounded-[10px] px-4 py-3 mt-5">
            <p class="font-bold text-ink">Akun demo untuk presentasi (password semua: password)</p>
            <p>Admin: admin@mykos.test</p>
            <p>Pemilik: pemilik@mykos.test</p>
            <p>Penyewa: user@mykos.test</p>
        </div>
    </div>
</section>
@endsection
