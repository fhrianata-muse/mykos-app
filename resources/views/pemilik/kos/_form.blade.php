<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label for="nama" class="block text-[13px] font-bold text-soft mb-1.5">Nama kos</label>
        <input id="nama" name="nama" required value="{{ old('nama', $kos->nama) }}" class="w-full border-[1.5px] border-line rounded-[10px] px-3 py-2.5">
    </div>
    <div>
        <label for="kota" class="block text-[13px] font-bold text-soft mb-1.5">Kota</label>
        <input id="kota" name="kota" required value="{{ old('kota', $kos->kota) }}" placeholder="cth: Depok" class="w-full border-[1.5px] border-line rounded-[10px] px-3 py-2.5">
    </div>
    <div>
        <label for="area" class="block text-[13px] font-bold text-soft mb-1.5">Area / patokan</label>
        <input id="area" name="area" required value="{{ old('area', $kos->area) }}" placeholder="cth: Margonda, 600 m dari UI" class="w-full border-[1.5px] border-line rounded-[10px] px-3 py-2.5">
    </div>
    <div>
        <label for="alamat" class="block text-[13px] font-bold text-soft mb-1.5">Alamat lengkap</label>
        <input id="alamat" name="alamat" required value="{{ old('alamat', $kos->alamat) }}" class="w-full border-[1.5px] border-line rounded-[10px] px-3 py-2.5">
    </div>
    <div>
        <label for="tipe" class="block text-[13px] font-bold text-soft mb-1.5">Tipe kos</label>
        <select id="tipe" name="tipe" class="w-full border-[1.5px] border-line rounded-[10px] px-3 py-2.5 bg-white">
            @foreach (['putra', 'putri', 'campur'] as $t)
                <option value="{{ $t }}" @selected(old('tipe', $kos->tipe) === $t)>{{ ucfirst($t) }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="harga" class="block text-[13px] font-bold text-soft mb-1.5">Harga per bulan (Rp)</label>
        <input type="number" id="harga" name="harga" required min="10000" value="{{ old('harga', $kos->harga) }}" class="w-full border-[1.5px] border-line rounded-[10px] px-3 py-2.5">
    </div>
    <div>
        <label for="kamar_tersedia" class="block text-[13px] font-bold text-soft mb-1.5">Kamar tersedia</label>
        <input type="number" id="kamar_tersedia" name="kamar_tersedia" required min="0" value="{{ old('kamar_tersedia', $kos->kamar_tersedia ?? 1) }}" class="w-full border-[1.5px] border-line rounded-[10px] px-3 py-2.5">
    </div>
    <div>
        <label for="foto_url" class="block text-[13px] font-bold text-soft mb-1.5">URL foto kos (opsional)</label>
        <input type="url" id="foto_url" name="foto_url" value="{{ old('foto_url', $kos->foto_url) }}" placeholder="https://..." class="w-full border-[1.5px] border-line rounded-[10px] px-3 py-2.5">
    </div>
    <div>
        <label for="latitude" class="block text-[13px] font-bold text-soft mb-1.5">Latitude (titik peta)</label>
        <input type="text" inputmode="decimal" id="latitude" name="latitude" required value="{{ old('latitude', $kos->latitude) }}" placeholder="cth: -6.3607" class="w-full border-[1.5px] border-line rounded-[10px] px-3 py-2.5">
    </div>
    <div>
        <label for="longitude" class="block text-[13px] font-bold text-soft mb-1.5">Longitude (titik peta)</label>
        <input type="text" inputmode="decimal" id="longitude" name="longitude" required value="{{ old('longitude', $kos->longitude) }}" placeholder="cth: 106.8272" class="w-full border-[1.5px] border-line rounded-[10px] px-3 py-2.5">
    </div>
    <p class="text-[13px] text-soft md:col-span-2">Cara ambil titik peta: buka Google Maps, klik kanan lokasi kosmu, salin dua angka koordinatnya ke dua kolom di atas. Titik ini yang muncul sebagai penanda di peta MyKos.</p>
    <div class="md:col-span-2">
        <label for="fasilitas" class="block text-[13px] font-bold text-soft mb-1.5">Fasilitas (pisahkan dengan koma)</label>
        <input id="fasilitas" name="fasilitas" required value="{{ old('fasilitas', $kos->fasilitas) }}" placeholder="AC, WiFi, Kamar mandi dalam, Parkir motor" class="w-full border-[1.5px] border-line rounded-[10px] px-3 py-2.5">
    </div>
    <div class="md:col-span-2">
        <label for="deskripsi" class="block text-[13px] font-bold text-soft mb-1.5">Deskripsi (opsional)</label>
        <textarea id="deskripsi" name="deskripsi" rows="3" class="w-full border-[1.5px] border-line rounded-[10px] px-3 py-2.5">{{ old('deskripsi', $kos->deskripsi) }}</textarea>
    </div>
    <div class="md:col-span-2">
        <label for="aturan" class="block text-[13px] font-bold text-soft mb-1.5">Aturan dan biaya tambahan (opsional)</label>
        <textarea id="aturan" name="aturan" rows="2" class="w-full border-[1.5px] border-line rounded-[10px] px-3 py-2.5">{{ old('aturan', $kos->aturan) }}</textarea>
    </div>
</div>
