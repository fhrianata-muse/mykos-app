@extends('layouts.app')

@section('title', $kos->nama . ' - MyKos')

@section('content')
<section class="max-w-6xl mx-auto px-5 pt-10">
    <a href="{{ route('home') }}" class="text-pine font-bold text-sm">Kembali ke katalog</a>
    <div class="grid md:grid-cols-2 gap-10 mt-4">
        <div>
            <img src="{{ $kos->foto_url }}" alt="Foto {{ $kos->nama }}" width="1000" height="700" class="w-full aspect-[4/3] object-cover rounded-[20px]">
            <div id="map" class="mt-5 h-[260px] rounded-[20px] border border-line z-0"></div>
            <p class="text-sm text-soft mt-2">{{ $kos->alamat }}, {{ $kos->kota }}</p>
        </div>
        <div>
            <div class="flex items-start justify-between gap-3">
                <h1 class="text-3xl font-extrabold leading-tight">{{ $kos->nama }}</h1>
                <span class="text-xs font-extrabold bg-[#e7efec] text-pine px-2.5 py-1 rounded-full whitespace-nowrap mt-1.5">{{ ucfirst($kos->tipe) }}</span>
            </div>
            <p class="text-soft mt-1">{{ $kos->area }}, {{ $kos->kota }}. Pemilik: {{ $kos->pemilik->name }}</p>

            <p class="mt-5"><strong class="text-[26px]">Rp{{ number_format($kos->harga, 0, ',', '.') }}</strong> <span class="text-soft">per bulan</span></p>
            <p class="font-bold {{ $kos->kamar_tersedia <= 2 ? 'text-accentdark' : 'text-pine' }}">{{ $kos->kamar_tersedia > 0 ? 'Sisa ' . $kos->kamar_tersedia . ' kamar tersedia' : 'Kamar habis' }}</p>

            <h2 class="font-extrabold text-lg mt-7">Fasilitas</h2>
            <ul class="mt-2 flex flex-wrap gap-2">
                @foreach ($kos->daftarFasilitas() as $f)
                    <li class="bg-white border border-line rounded-full px-3 py-1.5 text-sm font-semibold">{{ $f }}</li>
                @endforeach
            </ul>

            @if ($kos->deskripsi)
                <h2 class="font-extrabold text-lg mt-7">Deskripsi</h2>
                <p class="text-soft mt-1">{{ $kos->deskripsi }}</p>
            @endif

            @if ($kos->aturan)
                <h2 class="font-extrabold text-lg mt-7">Aturan dan biaya</h2>
                <p class="bg-white border border-line rounded-[10px] px-4 py-3 text-[15px] mt-1">{{ $kos->aturan }}</p>
            @endif

            <div class="mt-8 bg-white border border-line rounded-[20px] p-6">
                <h2 class="font-extrabold text-lg">Booking kos ini</h2>
                @auth
                    @if (auth()->user()->isUser())
                        @if ($kos->kamar_tersedia > 0)
                            <form method="POST" action="{{ route('bookings.store', $kos) }}" class="grid gap-4 mt-4">
                                @csrf
                                <div>
                                    <label for="tanggal_masuk" class="block text-[13px] font-bold text-soft mb-1.5">Tanggal masuk</label>
                                    <input type="date" id="tanggal_masuk" name="tanggal_masuk" required min="{{ now()->toDateString() }}" value="{{ old('tanggal_masuk') }}" class="w-full border-[1.5px] border-line rounded-[10px] px-3 py-2.5">
                                </div>
                                <div>
                                    <label for="durasi_bulan" class="block text-[13px] font-bold text-soft mb-1.5">Durasi sewa (bulan)</label>
                                    <select id="durasi_bulan" name="durasi_bulan" class="w-full border-[1.5px] border-line rounded-[10px] px-3 py-2.5 bg-white">
                                        @foreach ([1, 3, 6, 12] as $d)
                                            <option value="{{ $d }}" @selected(old('durasi_bulan') == $d)>{{ $d }} bulan, total Rp{{ number_format($kos->harga * $d, 0, ',', '.') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="catatan" class="block text-[13px] font-bold text-soft mb-1.5">Catatan untuk pemilik (opsional)</label>
                                    <textarea id="catatan" name="catatan" rows="2" class="w-full border-[1.5px] border-line rounded-[10px] px-3 py-2.5">{{ old('catatan') }}</textarea>
                                </div>
                                <button class="bg-accent hover:bg-accentdark text-white font-bold rounded-[10px] px-6 py-3">Kirim Booking</button>
                                <p class="text-[13px] text-soft">Booking berstatus menunggu sampai pemilik menerimanya. Kode booking terbit begitu booking terkirim.</p>
                            </form>
                        @else
                            <p class="text-soft mt-2">Kamar di kos ini sedang habis. Coba kos lain di katalog.</p>
                        @endif
                    @else
                        <p class="text-soft mt-2">Kamu masuk sebagai {{ auth()->user()->role }}. Booking hanya bisa dilakukan oleh akun penyewa.</p>
                    @endif
                @else
                    <p class="text-soft mt-2">Masuk dulu dengan akun penyewa untuk booking kos ini.</p>
                    <a href="{{ route('login') }}" class="inline-block mt-3 bg-pine hover:bg-pinedark text-white font-bold rounded-[10px] px-5 py-2.5">Masuk untuk Booking</a>
                @endauth
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    const map = L.map('map').setView([{{ $kos->latitude }}, {{ $kos->longitude }}], 15);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors',
        maxZoom: 19,
    }).addTo(map);
    L.marker([{{ $kos->latitude }}, {{ $kos->longitude }}]).addTo(map)
        .bindPopup('<strong>{{ $kos->nama }}</strong><br>{{ $kos->area }}, {{ $kos->kota }}')
        .openPopup();
</script>
@endpush
