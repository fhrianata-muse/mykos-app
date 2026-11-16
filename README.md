# MyKos (Aplikasi Laravel)

Platform pencarian dan booking kos online, dibangun dengan Laravel. Konsepnya mengikuti platform booking perjalanan (cari, bandingkan, booking, terima kode booking), diterapkan untuk sewa kos bulanan. Ini kelanjutan versi statis MyKos (HTML/CSS/JS) yang sekarang menjadi aplikasi web penuh dengan login dan database.

## Tujuan

Mempermudah orang mencari kos: ada katalog yang bisa disaring, ada peta dengan penanda lokasi kos (klik penanda untuk melihat kartu kosnya), dan ada alur booking yang tercatat. Pemilik kos mendapat panel sendiri untuk memasang dan mengelola kosnya, dan admin mendapat panel gaya CRM untuk mengelola customer, listing, dan booking di seluruh platform.

## Teknologi

- PHP 8.3 dan Laravel 13
- Database SQLite (file lokal, tidak perlu memasang MySQL untuk menjalankan demo)
- Blade untuk tampilan, Tailwind CSS lewat CDN
- Leaflet dan OpenStreetMap lewat CDN untuk peta (gratis, tanpa API key)
- Font Plus Jakarta Sans

## Tiga peran pengguna

| Peran | Cara dapat akun | Yang bisa dilakukan |
|---|---|---|
| Penyewa (user) | Daftar sendiri, pilih peran Penyewa | Cari kos dari daftar dan peta, booking, melihat booking saya dan kode booking |
| Pemilik kos (pemilik) | Daftar sendiri, pilih peran Pemilik Kos | Panel pemilik: tambah, edit, hapus kos miliknya (termasuk titik peta), menerima atau menolak booking masuk, stok kamar berkurang otomatis saat booking diterima |
| Admin | Dibuat dari seeder, tidak bisa didaftarkan dari formulir | Panel CRM: ringkasan platform, kelola semua user, mengaktifkan/menonaktifkan listing, mengubah status semua booking |

## Akun demo (untuk presentasi)

Semua password: `password`

| Peran | Email |
|---|---|
| Admin | admin@mykos.test |
| Pemilik kos | pemilik@mykos.test |
| Pemilik kos kedua | sari@mykos.test |
| Penyewa | user@mykos.test |
| Penyewa kedua | rina@mykos.test |

Seeder juga mengisi 9 kos contoh di 7 kota (dengan koordinat peta) dan 3 booking contoh berstatus menunggu, diterima, dan ditolak. Data ini contoh untuk demo, bukan data asli.

## Cara menjalankan

Syarat: PHP 8.2 atau lebih baru dan Composer.

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Buka http://127.0.0.1:8000 di browser.

## Alur demo untuk presentasi

1. Buka halaman utama sebagai tamu: tunjukkan pencarian, filter kota/tipe/harga, lalu peta. Klik salah satu penanda di peta, kartu kos muncul, klik Lihat Detail.
2. Masuk sebagai penyewa (user@mykos.test): dari halaman detail kos, isi tanggal masuk dan durasi, kirim booking. Buka menu Booking Saya, tunjukkan kode booking dan status Menunggu.
3. Keluar, masuk sebagai pemilik (pemilik@mykos.test): buka Booking Masuk, terima booking tadi. Tunjukkan stok kamar kos berkurang satu. Tunjukkan juga Tambah Kos dengan pengisian titik latitude/longitude untuk peta.
4. Keluar, masuk sebagai admin (admin@mykos.test): tunjukkan ringkasan CRM, daftar user, lalu ubah status booking di Kelola Booking dan nonaktifkan satu listing di Kelola Kos. Kembali ke halaman utama sebagai tamu untuk menunjukkan listing itu hilang dari katalog.
5. Tutup dengan menunjukkan pengujian otomatis di bawah ini.

## Pengujian

```bash
php artisan test
```

Ada 7 pengujian fitur di `tests/Feature/MyKosTest.php` yang memeriksa: katalog dan peta untuk tamu, pendaftaran peran pemilik, larangan memilih peran admin saat daftar, pemisahan panel sesuai peran, pemilik hanya bisa mengubah kos miliknya, alur booking sampai diterima (termasuk stok berkurang), dan admin menonaktifkan kos.

## Struktur penting

- `routes/web.php` : semua rute, dikelompokkan per peran dengan middleware `role`.
- `app/Http/Controllers/` : `KosController` (publik), `BookingController` (penyewa), `Pemilik/` (panel pemilik), `Admin/` (panel CRM), `AuthController` (login dan daftar).
- `app/Models/` : `User` (dengan peran), `Kos`, `Booking`.
- `database/migrations/` dan `database/seeders/` : skema dan data contoh.
- `resources/views/` : tampilan Blade, termasuk peta Leaflet di `home.blade.php` dan `kos/show.blade.php`.

## Catatan batasan

Proyek ini dibuat sebatas kebutuhan tugas dan presentasi mahasiswa: belum ada pembayaran online sungguhan (booking berhenti di kode booking dan status), belum ada unggah foto (foto kos memakai URL), dan belum ada notifikasi WhatsApp atau email. Ketiganya adalah pengembangan lanjutan yang paling masuk akal setelah fitur inti ini.
