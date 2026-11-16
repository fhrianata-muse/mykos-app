@extends('layouts.app')

@section('title', 'Kelola User - Admin MyKos')

@section('content')
<section class="max-w-6xl mx-auto px-5 pt-10">
    <h1 class="text-3xl font-extrabold">Kelola User (CRM)</h1>
    <p class="text-soft mt-1">Semua akun terdaftar beserta perannya dan aktivitasnya. Kontak penyewa dan pemilik ada di sini untuk kebutuhan follow-up customer.</p>

    <div class="mt-6 bg-white border border-line rounded-2xl overflow-x-auto">
        <table class="w-full text-[15px] min-w-[820px]">
            <thead>
                <tr class="text-left border-b border-line text-soft text-[13px]">
                    <th class="px-5 py-3.5">Nama</th>
                    <th class="px-5 py-3.5">Kontak</th>
                    <th class="px-5 py-3.5">Peran</th>
                    <th class="px-5 py-3.5">Kos dimiliki</th>
                    <th class="px-5 py-3.5">Booking dibuat</th>
                    <th class="px-5 py-3.5">Terdaftar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $u)
                    <tr class="border-b border-line last:border-0">
                        <td class="px-5 py-3.5 font-bold">{{ $u->name }}</td>
                        <td class="px-5 py-3.5">{{ $u->email }}<span class="block text-[13px] text-soft">{{ $u->phone ?? 'Nomor HP belum diisi' }}</span></td>
                        <td class="px-5 py-3.5"><span class="inline-block px-2.5 py-1 rounded-full text-xs font-bold bg-[#e7efec] text-pine">{{ $u->role }}</span></td>
                        <td class="px-5 py-3.5">{{ $u->kos()->count() }}</td>
                        <td class="px-5 py-3.5">{{ $u->bookings()->count() }}</td>
                        <td class="px-5 py-3.5">{{ $u->created_at->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <p class="mt-5"><a href="{{ route('admin.dashboard') }}" class="text-pine font-bold">Kembali ke dashboard admin</a></p>
</section>
@endsection
