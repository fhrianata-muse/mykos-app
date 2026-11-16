# Dokumentasi Aturan Desain Frontend: Pola MyKos

Dokumen ini ditulis agar bisa dipelajari dan dijalankan oleh AI lain (atau developer manusia) tanpa konteks tambahan. Isinya adalah aturan desain yang dipakai untuk membangun MyKos, sebuah platform pencarian dan booking kos online, lengkap dengan alasan, angka, dan daftar periksa. Salin seluruh dokumen ini ke proyek baru, lalu minta AI membaca dan mematuhinya sebelum menulis kode.

---

## 0. Konteks: apa yang dibangun dan kenapa aturan ini ada

- Produk contoh: **MyKos**, marketplace kos dua sisi. Sisi penyewa mencari, membandingkan, dan memesan kos. Sisi pemilik memasang listing agar kosnya ditemukan.
- Konsep produk meniru platform booking perjalanan (pola Traveloka): cari, bandingkan, booking, bayar, terima kode booking. Yang ditiru adalah **konsep alurnya, bukan tampilan atau layout platform tersebut**. Setiap produk wajib punya identitas visual sendiri.
- Masalah yang dicegah aturan ini: hasil desain generik buatan AI (sering disebut AI slop), yaitu halaman yang terlihat rapi sekilas tetapi tanpa identitas, tanpa alasan di balik pilihan warnanya, penuh tombol yang tidak berfungsi, dan berisi data palsu yang dikemas seolah nyata.
- Prinsip penutup yang menjadi ujian akhir: **kalau logo dan nama produk ditukar, apakah desainnya masih terasa khas? Kalau tidak, desainnya terlalu generik dan harus diulang.**

Cara memakai dokumen ini ada tiga tahap:

1. **Sebelum membangun:** baca Bagian 1 sampai 5, lalu tulis satu baris Design Read (format ada di Bagian 1.3).
2. **Saat membangun:** patuhi token di Bagian 3, 4, 5 dan spesifikasi komponen di Bagian 6.
3. **Sebelum menyerahkan:** jalankan daftar periksa di Bagian 11. Satu saja jawaban gagal berarti belum boleh diserahkan.

---

## 1. Prinsip inti

### 1.1 Setiap keputusan harus punya alasan tertulis

Sebelum selesai, AI wajib bisa menulis alasan satu kalimat untuk tiap keputusan besar: kenapa warna ini, kenapa layout ini, kenapa font ini, kenapa pakai kartu, kenapa jarak sebesar ini. Kalau alasannya tidak bisa ditulis, keputusannya tidak sah dan harus dipikir ulang. Teknik visual apa pun (gradien, blur, bayangan, animasi) hanya boleh dipakai kalau ada tujuannya: hierarki, identitas, atau keterbacaan. Teknik tanpa tujuan harus dibuang.

### 1.2 Struktur mengikuti isi, bukan template

Setiap bagian halaman harus ada karena isi produk membutuhkannya, bukan karena semua halaman buatan AI biasanya punya bagian itu. Urutan bagian mengikuti cerita produk, bukan urutan bawaan template (hero, fitur, testimoni, harga, FAQ). Bagian yang hanya mengisi template harus dihapus. Halaman yang lebih pendek tetapi semua bagiannya bertujuan lebih baik daripada halaman panjang hasil template.

### 1.3 Design Read: satu baris sebelum mulai

Sebelum menulis kode, AI wajib menyatakan satu baris:

> Membaca ini sebagai: `<jenis halaman>` untuk `<audiens>`, dengan bahasa visual `<gaya>`, dial `<ENERGY / RHYTHM / MOTION>`.

Contoh dari MyKos:

> Membaca ini sebagai: marketplace booking dua sisi untuk penyewa dan pemilik kos di Indonesia, dengan bahasa visual lokal yang hangat dan tenang, dial ENERGY 2 / RHYTHM 2 / MOTION 1.

Tiga dial, masing-masing skala 1 sampai 3:

| Dial | 1 (tenang) | 2 (seimbang) | 3 (berani) | Menjawab pertanyaan |
|---|---|---|---|---|
| ENERGY | sangat kalem, seperti situs layanan publik | menyapa dengan jelas, tidak berteriak | sangat ekspresif, seperti portofolio agensi | Seberapa keras desain ini menyapa? |
| RHYTHM | seragam dan mudah ditebak | konsisten dengan beberapa variasi | asimetris, komposisi berganti-ganti | Seberapa banyak bagian berubah antar satu sama lain? |
| MOTION | hanya efek hover | transisi dan reveal saat scroll | koreografi gerak penuh | Seberapa banyak gerakan, dan untuk apa? |

Untuk marketplace dan produk transaksional, pakai ENERGY 2 / RHYTHM 2 / MOTION 1: cukup hidup untuk terasa khas, cukup tenang untuk dipercaya saat orang mengeluarkan uang. Nilai dial harus konsisten dari bagian pertama sampai terakhir.

### 1.4 Satu titik fokus per layar

Di setiap layar hanya boleh ada satu elemen yang paling menonjol. Di MyKos, titik fokus halaman utama adalah panel pencarian, karena keputusan utama pengguna di sana adalah mencari kos. Elemen lain harus mengalah: lebih kecil, lebih pucat, atau lebih jauh.

### 1.5 Satu aksen yang disengaja

Satu warna aksen dipakai hemat, hanya di momen kunci. Di MyKos aksen oranye bata hanya muncul di tombol aksi utama (Cari Kos, Booking, kirim formulir pemilik) dan dua kata pada logo. Nol aksen membuat desain terasa steril. Aksen di mana-mana membuat aksen kehilangan arti.

---

## 2. Identitas visual MyKos (contoh yang sudah terbukti)

Identitas ini contoh konkret. Proyek lain boleh mengganti palet dan font, asalkan penggantinya dipilih dengan alasan tertulis dan memenuhi batasan di Bagian 3 dan 4.

- **Karakter:** hangat, lokal, tenang, dapat dipercaya. Bukan teknologi dingin, bukan kemewahan palsu.
- **Motif identitas:** hijau pinus tua dipasangkan krem hangat. Kombinasi ini mengingatkan pada rumah dan lingkungan tinggal, sesuai produk tempat tinggal, dan jelas berbeda dari biru korporat yang dipakai hampir semua platform booking.
- **Font:** Plus Jakarta Sans. Alasannya: typeface ini dirancang di Indonesia untuk identitas kota Jakarta, karakternya humanis dan bersih, cocok untuk produk lokal Indonesia, dan gratis dipakai. Font tidak boleh dipilih hanya karena itu bawaan favorit model AI.

---

## 3. Aturan warna

### 3.1 Token warna (salin apa adanya untuk MyKos)

```css
:root{
  --ink:#1c2a27;        /* teks utama */
  --ink-soft:#52615c;   /* teks sekunder */
  --pine:#0e4f4a;       /* warna utama: tombol gelap, tautan, penanda aktif */
  --pine-dark:#09322f;  /* latar bagian pemilik dan footer */
  --cream:#faf7f1;      /* latar halaman */
  --paper:#ffffff;      /* latar kartu dan panel */
  --line:#e4ddd0;       /* garis batas */
  --accent:#e4572e;     /* aksen: hanya aksi utama */
  --accent-dark:#c7431f;/* aksen saat hover */
  --gold:#b07d2b;       /* hanya untuk angka rating */
}
```

### 3.2 Batasan yang wajib dipatuhi

1. Palet aktif maksimal 2 sampai 3 warna inti ditambah 1 aksen. Warna netral (putih, hitam, abu) tidak dihitung. Lima warna atau lebih tanpa sistem yang jelas adalah pelanggaran.
2. Aksen hanya untuk aksi utama dan momen kunci. Aksen tidak boleh menyebar ke ikon, garis, latar, lencana, dan teks sekaligus.
3. Dilarang memakai gradien biru ke ungu, biru ke cyan, atau ungu ke pink sebagai perlakuan warna utama. Itu perlakuan warna paling umum pada hasil AI dan langsung menandai halaman sebagai generik. Gradien hanya boleh kalau menjadi bagian identitas merek yang sudah ditetapkan atau memisahkan satu tingkat hierarki, dan alasannya ditulis.
4. Dilarang tema gelap hanya karena terlihat teknologi. Tema dipilih dari identitas produk dan audiensnya. Produk yang isinya dibaca dan dibandingkan (marketplace, konten) umumnya terang.
5. Dilarang cahaya mengambang (glow) di banyak elemen. Glow maksimal untuk 1 sampai 2 elemen fokus, atau tidak sama sekali. MyKos memakai nol glow.
6. Kontras teks wajib memenuhi WCAG AA: teks normal minimal rasio 4,5 banding 1, teks besar (18px ke atas) minimal 3 banding 1. Dilarang teks abu muda di atas latar abu, dan teks putih di atas gradien yang sebagian areanya terang.

---

## 4. Aturan tipografi

### 4.1 Skala teks (angka pasti)

| Peran | Ukuran | Bobot | Catatan |
|---|---|---|---|
| Judul utama (H1) | 42px desktop, 32px mobile | 800 | line-height 1,2, letter-spacing -0,01em |
| Judul bagian (H2) | 30px desktop, 25px mobile | 800 | selalu diikuti subjudul penjelas |
| Judul kartu (H3) | 17 sampai 19px | 800 | |
| Isi hero | 18px | 400 | lebar maksimal sekitar 520px |
| Teks isi | 16px | 400 | line-height 1,55 |
| Teks kecil dan keterangan | 13 sampai 15px | 400 sampai 700 | untuk label, meta, catatan kaki |
| Harga pada kartu | 19px | 800 | satuan (per bulan) ditulis kecil 12,5px di bawahnya |
| Harga total di dialog | 22px | 800 | |

### 4.2 Batasan yang wajib dipatuhi

1. Hanya tiga tingkat hierarki teks yang aktif: judul, isi, keterangan. Penekanan memakai bobot (tebal), bukan warna-warni dan bukan ukuran acak.
2. Bobot yang dipakai hanya 400, 600, 700, 800 dari satu keluarga font yang sama.
3. Dilarang judul monospace besar dan label huruf kapital dengan jarak huruf ekstrem sebagai gaya bawaan. Itu jalan pintas untuk terlihat teknis tanpa kerja tipografi yang nyata.
4. Setiap font harus dipilih dengan alasan karakter merek, dan alasannya ditulis di dokumen proyek, seperti contoh Plus Jakarta Sans di Bagian 2.
5. Baris teks isi jangan terlalu panjang: batasi lebar kontainer teks sekitar 520 sampai 640px untuk paragraf penjelas.

---

## 5. Aturan jarak, layout, radius, dan bayangan

### 5.1 Sistem jarak kelipatan 8

- Semua jarak memakai kelipatan 8: 8, 16, 24, 32, 40, 48, 72. Tidak ada jarak asal tebak. Inilah penyebab utama halaman terasa rapi.
- Lebar konten maksimal 1160px, margin samping 20px di semua ukuran layar.
- Jarak antar bagian (padding vertikal section): 72px desktop, 48px mobile.
- Celah grid kartu: 24px. Celah di dalam kartu: 8 sampai 18px bertingkat.

### 5.2 Pola layout per jenis bagian

Ritme halaman harus bervariasi sesuai dial RHYTHM 2: komposisi tidak boleh sama persis di semua bagian. Pola yang dipakai MyKos:

| Bagian | Komposisi |
|---|---|
| Hero | dua kolom: teks di kiri, foto nyata produk di kanan |
| Panel pencarian | satu panel penuh selebar kontainer, menempel di bawah hero |
| Katalog | kepala bagian rata kiri-kanan (judul di kiri, pengurut di kanan), chip filter, lalu grid kartu 3 kolom |
| Cara booking | 4 langkah sejajar, masing-masing di kartu sendiri |
| Area populer | dua kolom: penjelasan di kiri, daftar baris yang bisa diklik di kanan |
| Pemilik kos | latar gelap penuh, dua kolom: argumen di kiri, formulir di kanan |
| FAQ | satu kolom sempit maksimal 760px, memakai elemen details bawaan |
| Footer | dua kolom saja: merek dan tautan yang benar-benar ada |

### 5.3 Radius, garis, bayangan (dosis dibatasi)

- Radius hanya tiga nilai: 10px untuk tombol dan input, 16px untuk kartu, 20px untuk panel besar dan dialog. Dilarang semua elemen berbentuk pil. Bentuk pil hanya untuk chip filter dan lencana kecil yang memang berfungsi sebagai penanda.
- Garis batas 1 sampai 1,5px warna `--line` untuk memisahkan, bukan bayangan.
- Bayangan hanya untuk elemen yang memang melayang di atas halaman: panel pencarian (satu bayangan lembut) dan dialog. Kartu biasa duduk rata tanpa bayangan besar. Kalau semua elemen berbayangan, tidak ada lagi hierarki ketinggian.
- Kaca buram (glassmorphism) maksimal 1 sampai 2 elemen, atau tidak sama sekali. MyKos memakai nol.

---

## 6. Spesifikasi komponen

### 6.1 Header

- Lengket di atas (sticky), latar sama dengan halaman, garis bawah tipis.
- Isi: logo teks (nama produk, satu kata diwarnai aksen), navigasi ke bagian yang benar-benar ada, dua tombol maksimal (satu ghost untuk segmen sekunder, satu gelap untuk masuk).
- Di mobile, navigasi tengah disembunyikan. Dilarang menu hamburger yang membuka menu kosong atau tidak berfungsi.

### 6.2 Panel pencarian (komponen inti marketplace)

- Bidang pencarian meniru konsep booking perjalanan, disesuaikan ke produknya. Untuk kos: kota atau area, tipe kos, tanggal masuk, durasi sewa, harga maksimal.
- Setiap bidang wajib punya label yang terlihat. Placeholder bukan pengganti label.
- Satu tombol aksi aksen di ujung panel, kata kerjanya spesifik: "Cari Kos", bukan "Cari" saja dan bukan "Mulai".
- Mengirim formulir harus benar-benar menyaring katalog dan menggulir ke hasil. Tombol pencarian yang tidak melakukan apa pun adalah cacat, bukan dekorasi.

### 6.3 Kartu listing

Setiap kartu wajib memuat, dengan urutan tetap:

1. Foto dengan rasio tetap 16 banding 10 dan atribut width/height atau aspect-ratio agar layout tidak bergeser saat foto dimuat.
2. Nama listing dan lokasi spesifik (area dan patokan jarak, contoh: 600 m dari kampus).
3. Lencana tipe yang informatif (untuk kos: Putra, Putri, Campur).
4. Rating dan jumlah ulasan.
5. Fasilitas utama, dipisah titik tengah, maksimal satu baris ringkas.
6. Ketersediaan dengan bahasa yang jujur terhadap urgensi: sisa kamar ditulis apa adanya, penanda "hampir habis" hanya kalau sisa 2 atau kurang.
7. Harga dengan satuan yang eksplisit (per bulan), dan tombol detail yang membuka detail beneran.

Kartu dalam satu grid boleh seragam karena isinya memang setara. Yang dilarang adalah kartu fitur yang identik untuk isi yang bobotnya berbeda-beda.

### 6.4 Chip filter

- Berbentuk pil, dua keadaan yang jelas: tidak aktif (putih, garis tipis) dan aktif (latar warna utama, teks putih).
- Mengklik chip langsung mengubah hasil tanpa perlu tombol tambahan.
- Harus ada jalan keluar: tombol hapus semua filter, yang muncul bersama keadaan kosong.

### 6.5 Dialog detail dan booking

- Memakai elemen dialog bawaan. Bisa ditutup dengan tombol tutup, klik di luar, dan tombol Escape.
- Isi: foto besar, meta (lokasi, tipe, rating, sisa kamar), fasilitas lengkap, aturan dan biaya tambahan secara eksplisit, total harga dengan rincian durasi, satu tombol booking aksen.
- Setelah booking ditekan, tampilkan umpan balik tertulis di dalam dialog. Jangan biarkan pengguna menebak apakah aksinya tercatat.

### 6.6 Formulir pemilik (sisi kedua marketplace)

- Marketplace dua sisi wajib memberi ruang nyata untuk sisi penawaran, bukan hanya sisi pembeli.
- Formulir minimal: nama usaha, kota, jumlah unit, kontak. Setiap bidang berlabel.
- Setelah kirim, tampilkan pesan berhasil yang menjelaskan langkah berikutnya.
- Kalau formulir masih demo, tulis itu di catatan formulir. Jangan berpura-pura data terkirim ke server kalau belum.

### 6.7 Keadaan kosong

- Kalau filter menghasilkan nol hasil, tampilkan keadaan kosong yang menyebut penyebabnya dan memberi satu tindakan pemulihan (tombol hapus filter). Dilarang layar kosong tanpa penjelasan, dan dilarang teks "tidak ada data" tanpa tindakan lanjutan.

---

## 7. Aturan konsep marketplace (yang ditiru dari platform booking)

Bagian ini memisahkan konsep dari tampilan. Konsep boleh ditiru dari platform yang sudah terbukti, tampilan tidak boleh.

1. **Pencarian adalah pintu utama.** Pengguna datang dengan kebutuhan spesifik (kota, tanggal, bujet), jadi formulir pencarian diletakkan paling atas dan paling menonjol, bukan disembunyikan di halaman lain.
2. **Bandingkan di satu layar.** Semua listing memakai struktur informasi yang sama persis agar bisa dibandingkan: harga, rating, fasilitas, jarak, ketersediaan. Struktur yang berubah-ubah antar listing merusak fungsi perbandingan.
3. **Transparansi sebelum transaksi.** Aturan, biaya tambahan, dan syarat harus terbaca sebelum pengguna membayar, bukan sesudahnya. Kepercayaan marketplace dibangun dari sini.
4. **Ketersediaan yang hidup.** Jumlah sisa unit ditampilkan dan menjadi bagian keputusan. Di versi produksi angka ini wajib datang dari data pemilik yang diperbarui, bukan angka statis.
5. **Alur transaksi tertutup.** Cari, cek detail, booking, bayar, terima bukti (kode booking atau e-voucher), tunjukkan bukti saat tiba. Setiap langkah punya status yang bisa dilihat pengguna di riwayat transaksinya.
6. **Perlindungan dua arah dijelaskan.** Mekanisme seperti dana ditahan sampai check-in terkonfirmasi melindungi pembeli dari listing palsu dan melindungi penjual dari pembatalan sepihak. Jelaskan mekanisme ini di FAQ dengan bahasa produk sendiri.
7. **Sisi penawaran diberi janji yang spesifik.** Untuk pemilik: kelola harga dan ketersediaan dari satu dasbor, pembayaran tercatat, gratis memasang dan biaya hanya dari transaksi berhasil. Janji harus berupa mekanisme nyata, bukan kata sifat kosong.

---

## 8. Aturan interaksi dan fungsi

1. Setiap elemen interaktif wajib berfungsi: tautan menuju bagian atau halaman yang ada, tombol melakukan aksinya, formulir memberi umpan balik. Elemen mati harus dihapus, bukan dibiarkan.
2. Setiap tautan navigasi wajib punya tujuan nyata di halaman yang sama atau halaman lain yang benar-benar dibuat. Dilarang tautan ke bagian yang tidak ada.
3. Penyaringan, pengurutan, dan perubahan keadaan harus terjadi langsung saat pengguna mengubah kontrol, tanpa memuat ulang halaman, kecuali ada alasan teknis yang ditulis.
4. Semua kontrol bisa dioperasikan dengan keyboard: Tab dan Shift+Tab mengikuti urutan visual, Enter atau Space mengaktifkan, Escape menutup dialog. Indikator fokus harus terlihat jelas dan tidak boleh dihapus tanpa pengganti.
5. Semua gambar punya teks alt yang menjelaskan isinya. Semua bidang formulir punya label yang terlihat. Tombol ikon saja wajib punya aria-label.
6. Ukuran target sentuh minimal 44px. Tidak ada teks yang keluar kontainer, tidak ada scroll horizontal, tidak ada kartu yang terpotong di mobile.
7. Gerakan hanya untuk tujuan pengalaman pengguna yang ditulis. Dilarang animasi berputar tanpa henti, dan dilarang menumpuk banyak jenis animasi pada semua elemen sekaligus. Hormati pengaturan prefers-reduced-motion.

---

## 9. Aturan konten dan kejujuran data

1. Dilarang mengarang statistik (jumlah pengguna, persentase keberhasilan, cakupan kota) tanpa sumber nyata. Kalau data nyata belum ada, angka itu tidak ditampilkan.
2. Dilarang testimoni palsu: nama acak, foto avatar buatan, jabatan rekaan. Kalau belum ada testimoni nyata, bagian testimoni tidak dibuat sama sekali.
3. Data contoh pada halaman demo wajib dilabeli sebagai contoh, di tempat yang terlihat pengguna, contohnya di subjudul katalog dan catatan kaki. Melabeli data contoh bukan kelemahan, itu syarat kejujuran.
4. Klaim keamanan, kepatuhan, atau performa dilarang ditulis tanpa bukti. Tulis mekanisme nyatanya, bukan labelnya.
5. FAQ hanya boleh berisi pertanyaan yang benar-benar relevan dengan produk itu. Untuk kos: apakah harga termasuk listrik dan air, bagaimana kalau kamar tidak sesuai foto, apakah bisa survei dulu, kapan pemilik menerima uang. Dilarang FAQ template generik.
6. Kata pada tombol harus spesifik terhadap aksinya: "Cari Kos", "Lihat Detail", "Booking Kamar Ini", "Minta Dihubungi Tim MyKos". Dilarang kata bawaan generik seperti "Mulai Sekarang", "Pelajari Lebih Lanjut", "Jelajahi".
7. Dilarang kata-kata pemasaran kosong: revolusioner, generasi berikutnya, tanpa hambatan, super canggih, terbaik, dan sejenisnya. Tulis manfaat spesifiknya sebagai gantinya.
8. Bahasa mengikuti bahasa pengguna produk. Untuk produk Indonesia, seluruh antarmuka berbahasa Indonesia yang wajar, bukan terjemahan kaku dari bahasa Inggris.

---

## 10. Aturan responsif dan performa

### 10.1 Titik henti (breakpoint) yang dipakai

| Lebar layar | Perubahan layout |
|---|---|
| Di atas 1000px | grid katalog 3 kolom, langkah booking 4 kolom, panel pencarian satu baris |
| 1000px ke bawah | grid katalog 2 kolom, langkah booking 2 kolom, panel pencarian 2 kolom dengan tombol selebar panel |
| 760px ke bawah | hero, area, pemilik, footer menjadi 1 kolom, navigasi tengah disembunyikan, ukuran H1 turun ke 32px, padding bagian turun ke 48px |
| 560px ke bawah | grid katalog dan langkah menjadi 1 kolom, panel pencarian 1 kolom |

### 10.2 Performa

1. Setiap gambar wajib punya width dan height atau aspect-ratio agar tidak menggeser layout saat dimuat.
2. Gambar hero adalah elemen img di HTML dengan fetchpriority="high" dan tidak boleh lazy loading. Gambar di bawah lipatan pertama boleh loading="lazy".
3. Tidak ada script pihak ketiga yang memblokir render di head. Script sendiri diletakkan di akhir body atau memakai defer.
4. Font dimuat dengan display=swap agar teks tetap tampil saat font belum tiba.
5. Dilarang melaporkan angka performa (skor Lighthouse, Web Vitals) yang tidak benar-benar diukur. Kalau tidak diukur, tulis "tidak diukur".

---

## 11. Daftar periksa sebelum menyerahkan (Delivery Gate)

AI wajib memeriksa semua butir ini dan melaporkannya sebagai LULUS atau GAGAL beserta buktinya. Satu GAGAL berarti perbaiki dulu, periksa ulang, baru serahkan.

**Kejujuran dan fungsi**

- [ ] Tidak ada statistik, testimoni, atau klaim tanpa sumber nyata. Data contoh sudah dilabeli sebagai contoh.
- [ ] Tidak ada tautan navigasi ke bagian atau halaman yang tidak ada.
- [ ] Setiap tombol, dropdown, chip, dialog, dan formulir sudah diklik atau diuji satu per satu dan benar-benar bekerja, termasuk keadaan kosong hasil filter.
- [ ] Halaman sudah dijalankan (dibuka dari server lokal atau alamat online) dan alamat finalnya sudah diverifikasi merespons 200, bukan hanya repositorinya yang ada.

**Identitas dan tujuan**

- [ ] Design Read satu baris sudah ditulis dan dialnya konsisten di semua bagian.
- [ ] Alasan satu kalimat tersedia untuk warna, font, layout, radius, dan bayangan.
- [ ] Palet tidak melebihi 3 warna inti ditambah 1 aksen. Aksen hanya di momen kunci.
- [ ] Tidak ada gradien biru-ungu bawaan, tidak ada glow menyebar, tidak ada glassmorphism massal, tidak ada latar pola grid tanpa tujuan.
- [ ] Uji tukar logo: dengan nama produk diganti, desain masih terasa khas.

**Struktur dan konten**

- [ ] Setiap bagian ada karena isi produk membutuhkannya. Tidak ada bagian pengisi template.
- [ ] Komposisi antar bagian bervariasi sesuai RHYTHM, tidak semua bagian berpola judul tengah ditambah grid kartu yang sama.
- [ ] Kata tombol spesifik terhadap aksi. Tidak ada kata pemasaran kosong.
- [ ] FAQ spesifik terhadap produk, atau tidak ada FAQ sama sekali.

**Aksesibilitas, responsif, performa**

- [ ] Kontras teks memenuhi WCAG AA (4,5 banding 1 untuk teks normal).
- [ ] Semua kontrol bisa dijangkau keyboard dan indikator fokus terlihat. Dialog tertutup dengan Escape.
- [ ] Tidak ada overflow horizontal dan tidak ada teks terpotong di lebar 390px, 760px, dan 1280px.
- [ ] Semua gambar berdimensi, hero tidak lazy, tidak ada script pemblokir di head.

---

## 12. Ringkasan larangan (pola yang harus langsung dikenali dan ditolak)

1. Gradien biru ke ungu atau ungu ke pink sebagai warna utama.
2. Semua elemen berbentuk pil, semua kartu berbayangan besar, semua permukaan kaca buram.
3. Lencana pil kecil di atas judul utama yang isinya mengulang judul itu sendiri.
4. Titik status berwarna yang berdenyut tanpa menandai keadaan nyata apa pun.
5. Ikon generik (kilau, bintang, petir, robot) yang tidak berhubungan dengan isinya.
6. Emoji sebagai dekorasi di judul, tombol, dan daftar fitur.
7. Panah di hampir semua tombol sebagai dekorasi.
8. Garis warna tipis di tepi kiri kartu yang tidak membawa informasi.
9. Barisan logo "dipercaya oleh" tanpa pelanggan nyata.
10. Tiga kolom harga dengan kolom tengah selalu disorot, tanpa alasan dari struktur harga sebenarnya.
11. Footer empat kolom template yang isinya setengah kosong.
12. Angka statistik, testimoni, dan ulasan yang dikarang agar halaman terlihat ramai.
13. Tombol dan tautan yang tidak melakukan apa pun.
14. Animasi yang berputar selamanya tanpa pemicu pengguna.

---

## 13. Instruksi siap tempel untuk AI lain

Blok di bawah ini bisa disalin persis sebagai instruksi kepada AI mana pun yang akan membangun halaman frontend:

```text
Sebelum menulis kode, baca dokumen aturan desain ini seluruhnya.
1. Tulis satu baris Design Read: jenis halaman, audiens, bahasa visual, dan dial ENERGY/RHYTHM/MOTION. Untuk marketplace atau produk transaksional gunakan 2/2/1.
2. Tetapkan identitas dulu: maksimal 3 warna inti + 1 aksen, satu keluarga font dengan alasan tertulis, sistem jarak kelipatan 8, radius 10/16/20, bayangan hanya untuk elemen yang melayang.
3. Susun struktur halaman mengikuti isi produk, bukan template. Setiap bagian harus bisa kamu jelaskan tujuannya dalam satu kalimat.
4. Tiru konsep produk referensi hanya pada alurnya (cari, bandingkan, transaksi, bukti), jangan pernah meniru tampilan dan layoutnya.
5. Setiap elemen interaktif harus berfungsi nyata. Setiap data contoh harus dilabeli sebagai contoh. Dilarang mengarang statistik dan testimoni.
6. Setelah selesai, jalankan Delivery Gate di dokumen ini butir demi butir dan laporkan LULUS/GAGAL dengan bukti, termasuk verifikasi alamat online final. Jangan menyerahkan hasil yang masih punya GAGAL.
```

---

## 14. Lampiran: token CSS MyKos

```css
:root{
  --ink:#1c2a27;
  --ink-soft:#52615c;
  --pine:#0e4f4a;
  --pine-dark:#09322f;
  --cream:#faf7f1;
  --paper:#ffffff;
  --line:#e4ddd0;
  --accent:#e4572e;
  --accent-dark:#c7431f;
  --gold:#b07d2b;
  --radius-s:10px;
  --radius-m:16px;
  --radius-l:20px;
}
body{
  font-family:"Plus Jakarta Sans",system-ui,-apple-system,"Segoe UI",sans-serif;
  font-size:16px;
  line-height:1.55;
  color:var(--ink);
  background:var(--cream);
}
.wrap{max-width:1160px;margin:0 auto;padding:0 20px}
```

Dokumen versi 1, dibuat 16 November 2026 dari pembangunan MyKos (repo fhrianata-muse/mykos, live di GitHub Pages). Aturan di dokumen ini berlaku sebagai arah desain (DESIGN.md) dan dipakai bersama saringan anti-slop: arah memberi jiwa, saringan menolak yang generik.
