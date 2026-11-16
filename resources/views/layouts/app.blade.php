<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MyKos - Cari, Bandingkan, Booking Kos Online')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        ink: '#1c2a27',
                        soft: '#52615c',
                        pine: '#0e4f4a',
                        pinedark: '#09322f',
                        cream: '#faf7f1',
                        line: '#e4ddd0',
                        accent: '#e4572e',
                        accentdark: '#c7431f',
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
                    },
                },
            },
        };
    </script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <style>
        .leaflet-popup-content { margin: 0; font-family: "Plus Jakarta Sans", system-ui, sans-serif; }
        .leaflet-popup-content-wrapper { border-radius: 14px; overflow: hidden; padding: 0; }
        .leaflet-popup-content a { color: inherit; }
    </style>
    @stack('styles')
</head>
<body class="bg-cream text-ink font-sans min-h-screen flex flex-col">

<header class="sticky top-0 z-[1000] bg-cream border-b border-line">
    <div class="max-w-6xl mx-auto px-5 py-3.5 flex items-center gap-6">
        <a href="{{ route('home') }}" class="text-2xl font-extrabold text-pine">My<span class="text-accent">Kos</span></a>
        <nav class="hidden md:flex gap-5 text-[15px] font-semibold mr-auto">
            <a href="{{ route('home') }}" class="hover:text-pine">Cari Kos</a>
            <a href="{{ route('home') }}#peta" class="hover:text-pine">Peta Kos</a>
            @auth
                @if (auth()->user()->isUser())
                    <a href="{{ route('bookings.index') }}" class="hover:text-pine">Booking Saya</a>
                @endif
                @if (auth()->user()->isPemilik())
                    <a href="{{ route('pemilik.dashboard') }}" class="hover:text-pine">Panel Pemilik</a>
                @endif
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-pine">Panel Admin</a>
                @endif
            @endauth
        </nav>
        <div class="flex items-center gap-2.5 ml-auto md:ml-0">
            @guest
                <a href="{{ route('login') }}" class="px-4 py-2 rounded-[10px] border-[1.5px] border-pine text-pine font-bold text-[15px] hover:bg-[#e7efec]">Masuk</a>
                <a href="{{ route('register') }}" class="px-4 py-2 rounded-[10px] bg-pine text-white font-bold text-[15px] hover:bg-pinedark">Daftar</a>
            @else
                <span class="hidden sm:block text-sm text-soft">{{ auth()->user()->name }} <span class="font-bold text-pine">({{ auth()->user()->role }})</span></span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="px-4 py-2 rounded-[10px] bg-pine text-white font-bold text-[15px] hover:bg-pinedark">Keluar</button>
                </form>
            @endguest
        </div>
    </div>
</header>

<main class="flex-1">
    @if (session('success'))
        <div class="max-w-6xl mx-auto px-5 mt-5">
            <p class="bg-[#e7efec] border border-pine/30 text-pine font-semibold rounded-[10px] px-4 py-3">{{ session('success') }}</p>
        </div>
    @endif
    @if ($errors->any())
        <div class="max-w-6xl mx-auto px-5 mt-5">
            <div class="bg-[#fdeee9] border border-accent/40 text-accentdark font-semibold rounded-[10px] px-4 py-3">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        </div>
    @endif

    @yield('content')
</main>

<footer class="bg-pinedark text-[#c9d8d3] mt-16">
    <div class="max-w-6xl mx-auto px-5 py-10 grid md:grid-cols-2 gap-8">
        <div>
            <p class="text-2xl font-extrabold text-white">My<span class="text-accent">Kos</span></p>
            <p class="mt-2 text-[15px] max-w-md">Platform pencarian dan booking kos online. Cari dari daftar atau peta, bandingkan, booking, lalu pindah.</p>
        </div>
        <nav class="flex flex-col gap-2 font-semibold text-[#eef4f1]">
            <a href="{{ route('home') }}" class="hover:underline">Cari Kos</a>
            <a href="{{ route('home') }}#peta" class="hover:underline">Peta Kos</a>
            <a href="{{ route('register') }}" class="hover:underline">Daftar sebagai Pemilik Kos</a>
        </nav>
    </div>
    <div class="border-t border-white/15">
        <p class="max-w-6xl mx-auto px-5 py-4 text-[13.5px]">MyKos, proyek mahasiswa. Data kos pada halaman ini adalah data contoh untuk demo dan presentasi.</p>
    </div>
</footer>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@stack('scripts')
</body>
</html>
