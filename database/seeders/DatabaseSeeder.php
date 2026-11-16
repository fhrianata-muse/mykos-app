<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Kos;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Akun demo untuk presentasi. Semua password: "password".
        $admin = User::create([
            'name' => 'Admin MyKos',
            'email' => 'admin@mykos.test',
            'password' => 'password',
            'role' => User::ROLE_ADMIN,
            'phone' => '081200000001',
        ]);

        $pemilik = User::create([
            'name' => 'Budi Santoso',
            'email' => 'pemilik@mykos.test',
            'password' => 'password',
            'role' => User::ROLE_PEMILIK,
            'phone' => '081200000002',
        ]);

        $pemilik2 = User::create([
            'name' => 'Sari Wulandari',
            'email' => 'sari@mykos.test',
            'password' => 'password',
            'role' => User::ROLE_PEMILIK,
            'phone' => '081200000003',
        ]);

        $penyewa = User::create([
            'name' => 'Andi Pratama',
            'email' => 'user@mykos.test',
            'password' => 'password',
            'role' => User::ROLE_USER,
            'phone' => '081200000004',
        ]);

        $penyewa2 = User::create([
            'name' => 'Rina Amelia',
            'email' => 'rina@mykos.test',
            'password' => 'password',
            'role' => User::ROLE_USER,
            'phone' => '081200000005',
        ]);

        // Data kos contoh. Koordinat mengikuti area kampus atau kawasan yang disebut.
        $daftarKos = [
            [$pemilik, 'Kos Griya Asri', 'Depok', 'Margonda, 600 m dari UI', 'Jl. Margonda Raya No. 88, Depok', 'campur', 1450000, 4, 'AC, Kamar mandi dalam, WiFi, Parkir motor, Dapur bersama', 'Kos terang dekat gerbang UI, ada ruang belajar bersama.', 'Jam tamu sampai 22.00. Listrik token ditanggung penyewa, air dan WiFi termasuk.', 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=900&q=70', -6.3607, 106.8272],
            [$pemilik, 'Kos Putri Melati 88', 'Yogyakarta', 'Seturan, 800 m dari UGM', 'Jl. Seturan Raya No. 88, Sleman', 'putri', 950000, 2, 'WiFi, Kamar mandi dalam, Dapur bersama, Laundry', 'Khusus putri, lingkungan tenang dekat kampus dan tempat makan.', 'Khusus putri. Tamu lawan jenis hanya di ruang tamu sampai 21.00.', 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?auto=format&fit=crop&w=900&q=70', -7.7702, 110.3776],
            [$pemilik, 'Dago Living', 'Bandung', 'Dago, 500 m dari ITB', 'Jl. Ir. H. Juanda No. 120, Bandung', 'campur', 1750000, 6, 'AC, Kamar mandi dalam, WiFi, Parkir motor, Laundry', 'Kos modern di Dago, akses kartu 24 jam.', 'Bebas jam pulang dengan akses kartu. Semua utilitas termasuk.', 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=900&q=70', -6.8915, 107.6107],
            [$pemilik2, 'Kos Tebet Garden', 'Jakarta', 'Tebet, 1,2 km dari Stasiun Tebet', 'Jl. Tebet Timur Dalam No. 5, Jakarta Selatan', 'putri', 2100000, 3, 'AC, Kamar mandi dalam, WiFi, Dapur bersama', 'Untuk mahasiswi dan karyawati, dekat stasiun dan kawasan kuliner Tebet.', 'Listrik token, air termasuk.', 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?auto=format&fit=crop&w=900&q=70', -6.2383, 106.8527],
            [$pemilik2, 'Kos Putra Barokah', 'Surabaya', 'Gebang, 700 m dari ITS', 'Jl. Arief Rahman Hakim No. 30, Surabaya', 'putra', 900000, 8, 'WiFi, Parkir motor, Dapur bersama', 'Kos putra sederhana dekat ITS, harga mahasiswa.', 'Air dan WiFi termasuk, listrik iuran flat Rp50 ribu.', 'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=900&q=70', -7.2822, 112.7952],
            [$pemilik, 'Semarang Atas Residence', 'Semarang', 'Tembalang, 400 m dari Undip', 'Jl. Banjarsari No. 17, Tembalang, Semarang', 'campur', 1200000, 5, 'AC, WiFi, Parkir motor, Laundry, Dapur bersama', 'Selangkah ke Undip, kamar mandi luar dibersihkan setiap hari.', 'Semua biaya utilitas termasuk.', 'https://images.unsplash.com/photo-1566665797739-1674de7a421a?auto=format&fit=crop&w=900&q=70', -7.0510, 110.4420],
            [$pemilik2, 'Kos Eksklusif Kemang Pratama', 'Jakarta', 'Kemang, dekat kawasan kantor dan kuliner', 'Jl. Kemang Raya No. 21, Jakarta Selatan', 'campur', 2850000, 2, 'AC, Kamar mandi dalam, WiFi, Parkir motor, Laundry', 'Untuk profesional, termasuk pembersihan kamar seminggu sekali.', 'Listrik token. Maksimal 1 orang per kamar.', 'https://images.unsplash.com/photo-1493809842364-78817add7ffb?auto=format&fit=crop&w=900&q=70', -6.2607, 106.8133],
            [$pemilik, 'Kos Mahasiswa Lowokwaru', 'Malang', 'Lowokwaru, 900 m dari UB', 'Jl. MT Haryono No. 45, Malang', 'putra', 700000, 10, 'WiFi, Parkir motor, Dapur bersama', 'Kos putra harga mahasiswa dekat Universitas Brawijaya.', 'Harga termasuk air, listrik pemakaian wajar, dan WiFi.', 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?auto=format&fit=crop&w=900&q=70', -7.9530, 112.6140],
            [$pemilik2, 'Paviliun Putri Sagan', 'Yogyakarta', 'Sagan, 1 km dari UGM dan pusat kota', 'Jl. Sagan No. 9, Yogyakarta', 'putri', 1350000, 1, 'AC, Kamar mandi dalam, WiFi, Laundry', 'Paviliun kecil dan tenang di tengah kota Jogja.', 'Semua utilitas termasuk kecuali laundry.', 'https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?auto=format&fit=crop&w=900&q=70', -7.7456, 110.3789],
        ];

        $kos = [];
        foreach ($daftarKos as $d) {
            $kos[] = Kos::create([
                'user_id' => $d[0]->id,
                'nama' => $d[1],
                'kota' => $d[2],
                'area' => $d[3],
                'alamat' => $d[4],
                'tipe' => $d[5],
                'harga' => $d[6],
                'kamar_tersedia' => $d[7],
                'fasilitas' => $d[8],
                'deskripsi' => $d[9],
                'aturan' => $d[10],
                'foto_url' => $d[11],
                'latitude' => $d[12],
                'longitude' => $d[13],
            ]);
        }

        // Booking contoh dengan tiga status berbeda, untuk demo panel pemilik dan admin.
        Booking::create([
            'user_id' => $penyewa->id,
            'kos_id' => $kos[0]->id,
            'kode_booking' => 'MK-DEMO0001',
            'tanggal_masuk' => now()->addDays(7),
            'durasi_bulan' => 3,
            'total_harga' => $kos[0]->harga * 3,
            'status' => 'menunggu',
            'catatan' => 'Saya mahasiswa baru, masuk sesuai tanggal wisuda kakak.',
        ]);
        Booking::create([
            'user_id' => $penyewa2->id,
            'kos_id' => $kos[2]->id,
            'kode_booking' => 'MK-DEMO0002',
            'tanggal_masuk' => now()->addDays(3),
            'durasi_bulan' => 6,
            'total_harga' => $kos[2]->harga * 6,
            'status' => 'diterima',
        ]);
        Booking::create([
            'user_id' => $penyewa->id,
            'kos_id' => $kos[3]->id,
            'kode_booking' => 'MK-DEMO0003',
            'tanggal_masuk' => now()->addDays(14),
            'durasi_bulan' => 1,
            'total_harga' => $kos[3]->harga,
            'status' => 'ditolak',
            'catatan' => 'Booking untuk teman perempuan saya.',
        ]);
    }
}
