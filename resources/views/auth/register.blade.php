@extends('layouts.app')

@section('title', 'Daftar - MyKos')

@section('content')
<section class="max-w-md mx-auto px-5 pt-14">
    <div class="bg-white border border-line rounded-[20px] p-7">
        <h1 class="text-2xl font-extrabold">Buat akun MyKos</h1>
        <p class="text-soft text-[15px] mt-1">Pilih peranmu: penyewa yang mencari kos, atau pemilik yang mau memasang kos.</p>
        <form method="POST" action="{{ route('register') }}" class="grid gap-4 mt-6">
            @csrf
            <div>
                <span class="block text-[13px] font-bold text-soft mb-1.5">Daftar sebagai</span>
                <div class="grid grid-cols-2 gap-2">
                    <label class="border-[1.5px] border-line rounded-[10px] px-4 py-3 cursor-pointer has-[:checked]:border-pine has-[:checked]:bg-[#e7efec]">
                        <input type="radio" name="role" value="user" class="mr-1.5" @checked(old('role', 'user') === 'user')>
                        <strong>Penyewa</strong>
                        <span class="block text-[13px] text-soft">Cari dan booking kos</span>
                    </label>
                    <label class="border-[1.5px] border-line rounded-[10px] px-4 py-3 cursor-pointer has-[:checked]:border-pine has-[:checked]:bg-[#e7efec]">
                        <input type="radio" name="role" value="pemilik" class="mr-1.5" @checked(old('role') === 'pemilik')>
                        <strong>Pemilik Kos</strong>
                        <span class="block text-[13px] text-soft">Pasang dan kelola kos</span>
                    </label>
                </div>
            </div>
            <div>
                <label for="name" class="block text-[13px] font-bold text-soft mb-1.5">Nama lengkap</label>
                <input type="text" id="name" name="name" required value="{{ old('name') }}" class="w-full border-[1.5px] border-line rounded-[10px] px-3 py-2.5">
            </div>
            <div>
                <label for="email" class="block text-[13px] font-bold text-soft mb-1.5">Email</label>
                <input type="email" id="email" name="email" required value="{{ old('email') }}" class="w-full border-[1.5px] border-line rounded-[10px] px-3 py-2.5">
            </div>
            <div>
                <label for="phone" class="block text-[13px] font-bold text-soft mb-1.5">Nomor HP / WhatsApp (opsional)</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="w-full border-[1.5px] border-line rounded-[10px] px-3 py-2.5">
            </div>
            <div>
                <label for="password" class="block text-[13px] font-bold text-soft mb-1.5">Password (minimal 8 karakter)</label>
                <input type="password" id="password" name="password" required class="w-full border-[1.5px] border-line rounded-[10px] px-3 py-2.5">
            </div>
            <div>
                <label for="password_confirmation" class="block text-[13px] font-bold text-soft mb-1.5">Ulangi password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required class="w-full border-[1.5px] border-line rounded-[10px] px-3 py-2.5">
            </div>
            <button class="bg-accent hover:bg-accentdark text-white font-bold rounded-[10px] px-6 py-3">Buat Akun</button>
        </form>
        <p class="text-sm text-soft mt-5">Sudah punya akun? <a href="{{ route('login') }}" class="text-pine font-bold">Masuk di sini</a></p>
    </div>
</section>
@endsection
