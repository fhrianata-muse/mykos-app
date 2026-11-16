@extends('layouts.app')

@section('content')
<section class="max-w-6xl mx-auto px-5 pt-12 pb-2">
    <h1 class="text-4xl md:text-[42px] font-extrabold leading-tight max-w-2xl">Cari kos, bandingkan, booking. Semua dari satu tempat.</h1>
    <p class="text-lg text-soft mt-4 max-w-xl">Lihat harga, fasilitas, foto, dan lokasi kos di peta. Kalau cocok, langsung booking dan kamarmu diamankan atas namamu.</p>

    <form method="GET" action="{{ route('home') }}" class="mt-8 bg-white border border-line rounded-[20px] shadow-[0_12px_32px_rgba(28,42,39,0.10)] p-5 grid gap-4 md:grid-cols-5 items-end">
        <div class="md:col-span-2">
            <label for="q" class="block text-[13px] font-bold text-soft mb-1.5">Kata kunci</label>
            <input id="q" name="q" value="{{ request('q') }}" placeholder="Nama kos, kota, atau area kampus" class="w-full border-[1.5px] border-line rounded-[10px] px-3 py-2.5">
        </div>
        <div>
            <label for="kota" class="block text-[13px] font-bold text-soft mb-1.5">Kota</label>
            <select id="kota" name="kota" class="w-full border-[1.5px] border-line rounded-[10px] px-3 py-2.5 bg-white">
                <option value="">Semua kota</option>
                @foreach ($daftarKota as $k)
                    <option value="{{ $k }}" @selected(request('kota') === $k)>{{ $k }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="tipe" class="block text-[13px] font-bold text-soft mb-1.5">Tipe kos</label>
            <select id="tipe" name="tipe" class="w-full border-[1.5px] border-line rounded-[10px] px-3 py-2.5 bg-white">
                <option value="">Semua tipe</option>
                <option value="putra" @selected(request('tipe') === 'putra')>Putra</option>
                <option value="putri" @selected(request('tipe') === 'putri')>Putri</option>
                <option value="campur" @selected(request('tipe') === 'campur')>Campur</option>
            </select>
        </div>
        <div>
            <label for="harga_max" class="block text-[13px] font-bold text-soft mb-1.5">Harga maks / bulan</label>
            <select id="harga_max" name="harga_max" class="w-full border-[1.5px] border-line rounded-[10px] px-3 py-2.5 bg-white">
                <option value="">Semua harga</option>
                <option value="1000000" @selected(request('harga_max') === '1000000')>Di bawah Rp1 jt</option>
                <option value="1500000" @selected(request('harga_max') === '1500000')>Di bawah Rp1,5 jt</option>
                <option value="2000000" @selected(request('harga_max') === '2000000')>Di bawah Rp2 jt</option>
                <option value="3000000" @selected(request('harga_max') === '3000000')>Di bawah Rp3 jt</option>
            </select>
        </div>
        <div class="flex gap-2 md:col-span-4">
            <label for="sort" class="text-[13px] font-bold text-soft self-center">Urutkan</label>
            <select id="sort" name="sort" class="border-[1.5px] border-line rounded-[10px] px-3 py-2.5 bg-white">
                <option value="">Terbaru</option>
                <option value="murah" @selected(request('sort') === 'murah')>Harga terendah</option>
                <option value="mahal" @selected(request('sort') === 'mahal')>Harga tertinggi</option>
            </select>
        </div>
        <button class="bg-accent hover:bg-accentdark text-white font-bold rounded-[10px] px-6 py-3">Cari Kos</button>
    </form>
</section>

<section id="peta" class="max-w-6xl mx-auto px-5 pt-12">
    <h2 class="text-[30px] font-extrabold">Cari dari peta</h2>
    <p class="text-soft mt-1">Klik penanda di peta untuk melihat kartu kosnya, lalu buka detailnya dari kartu itu.</p>
    <div id="map" class="mt-5 h-[420px] rounded-[20px] border border-line z-0"></div>
</section>

<section class="max-w-6xl mx-auto px-5 py-14">
    <h2 class="text-[30px] font-extrabold">Kos tersedia</h2>
    <p class="text-soft mt-1">{{ $kos->count() }} kos ditemukan. Data kos adalah contoh untuk demo.</p>

    @if ($kos->isEmpty())
        <div class="mt-6 bg-white border-[1.5px] border-dashed border-line rounded-2xl p-10 text-center">
            <h3 class="font-extrabold text-lg">Tidak ada kos yang cocok dengan pencarian itu</h3>
            <p class="text-soft mt-1">Coba longgarkan harga maksimalnya atau ganti kotanya.</p>
            <a href="{{ route('home') }}" class="inline-block mt-4 bg-pine hover:bg-pinedark text-white font-bold rounded-[10px] px-5 py-2.5">Hapus semua filter</a>
        </div>
    @else
        <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($kos as $k)
                <article class="bg-white border border-line rounded-2xl overflow-hidden flex flex-col">
                    <img src="{{ $k->foto_url }}" alt="Foto {{ $k->nama }}" width="900" height="560" loading="lazy" class="w-full aspect-[16/10] object-cover">
                    <div class="p-[18px] flex flex-col gap-2 flex-1">
                        <div class="flex justify-between items-start gap-3">
                            <div>
                                <h3 class="font-extrabold text-lg leading-snug">{{ $k->nama }}</h3>
                                <p class="text-sm text-soft">{{ $k->area }}, {{ $k->kota }}</p>
                            </div>
                            <span class="text-xs font-extrabold bg-[#e7efec] text-pine px-2.5 py-1 rounded-full whitespace-nowrap">{{ ucfirst($k->tipe) }}</span>
                        </div>
                        <p class="text-sm text-soft">{{ implode(' · ', array_slice($k->daftarFasilitas(), 0, 4)) }}</p>
                        <p class="text-sm font-bold {{ $k->kamar_tersedia <= 2 ? 'text-accentdark' : 'text-pine' }}">
                            {{ $k->kamar_tersedia <= 2 ? 'Hampir habis, ' : '' }}sisa {{ $k->kamar_tersedia }} kamar
                        </p>
                        <div class="mt-auto pt-3 border-t border-line flex justify-between items-end gap-3">
                            <p><strong class="text-[19px]">Rp{{ number_format($k->harga, 0, ',', '.') }}</strong><span class="block text-xs text-soft">per bulan</span></p>
                            <a href="{{ route('kos.show', $k) }}" class="bg-pine hover:bg-pinedark text-white font-bold text-sm rounded-[10px] px-4 py-2">Lihat Detail</a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
</section>
@endsection

@push('scripts')
<script>
    const dataKos = @json($kosPeta);

    const map = L.map('map');
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors',
        maxZoom: 19,
    }).addTo(map);

    const formatRupiah = (n) => 'Rp' + n.toLocaleString('id-ID');

    const markers = dataKos.map((k) => {
        const popup = `
            <div style="width:220px">
                <img src="${k.foto}" alt="" style="width:100%;height:110px;object-fit:cover">
                <div style="padding:10px 12px">
                    <strong style="font-size:15px">${k.nama}</strong>
                    <div style="color:#52615c;font-size:13px">${k.area}, ${k.kota}</div>
                    <div style="font-weight:800;margin-top:4px">${formatRupiah(k.harga)}<span style="font-weight:400;color:#52615c;font-size:12px"> /bulan</span></div>
                    <a href="${k.url}" style="display:inline-block;margin-top:8px;background:#0e4f4a;color:#fff;font-weight:700;font-size:13px;padding:6px 12px;border-radius:8px;text-decoration:none">Lihat Detail</a>
                </div>
            </div>`;
        return L.marker([k.lat, k.lng]).addTo(map).bindPopup(popup);
    });

    if (markers.length) {
        map.fitBounds(L.featureGroup(markers).getBounds().pad(0.15));
    } else {
        map.setView([-2.5, 118], 5);
    }
</script>
@endpush
