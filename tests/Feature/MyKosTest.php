<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Kos;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MyKosTest extends TestCase
{
    use RefreshDatabase;

    private function buatKos(User $pemilik, array $override = []): Kos
    {
        return Kos::create(array_merge([
            'user_id' => $pemilik->id,
            'nama' => 'Kos Uji',
            'kota' => 'Depok',
            'area' => 'Margonda',
            'alamat' => 'Jl. Uji No. 1',
            'tipe' => 'campur',
            'harga' => 1000000,
            'kamar_tersedia' => 3,
            'fasilitas' => 'WiFi, AC',
            'latitude' => -6.3607,
            'longitude' => 106.8272,
        ], $override));
    }

    public function test_tamu_bisa_melihat_katalog_dan_peta(): void
    {
        $pemilik = User::factory()->create(['role' => 'pemilik']);
        $this->buatKos($pemilik);

        $this->get('/')
            ->assertOk()
            ->assertSee('Kos Uji')
            ->assertSee('-6.3607', false);
    }

    public function test_daftar_sebagai_pemilik_masuk_ke_panel_pemilik(): void
    {
        $this->post('/register', [
            'name' => 'Pemilik Baru',
            'email' => 'baru@mykos.test',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'pemilik',
        ])->assertRedirect(route('pemilik.dashboard'));

        $this->assertDatabaseHas('users', ['email' => 'baru@mykos.test', 'role' => 'pemilik']);
    }

    public function test_daftar_tidak_bisa_memilih_role_admin(): void
    {
        $this->post('/register', [
            'name' => 'Calon Admin',
            'email' => 'nakal@mykos.test',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'admin',
        ])->assertSessionHasErrors('role');

        $this->assertDatabaseMissing('users', ['email' => 'nakal@mykos.test']);
    }

    public function test_panel_terpisah_sesuai_role(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $pemilik = User::factory()->create(['role' => 'pemilik']);
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($user)->get('/pemilik')->assertForbidden();
        $this->actingAs($user)->get('/admin')->assertForbidden();
        $this->actingAs($pemilik)->get('/admin')->assertForbidden();
        $this->actingAs($pemilik)->get('/pemilik')->assertOk();
        $this->actingAs($admin)->get('/admin')->assertOk();
    }

    public function test_pemilik_hanya_bisa_mengubah_kos_miliknya(): void
    {
        $pemilik = User::factory()->create(['role' => 'pemilik']);
        $orangLain = User::factory()->create(['role' => 'pemilik']);
        $kosOrang = $this->buatKos($orangLain);

        $this->actingAs($pemilik)->get("/pemilik/kos/{$kosOrang->id}/edit")->assertForbidden();

        $this->actingAs($pemilik)->post('/pemilik/kos', [
            'nama' => 'Kos Saya Sendiri',
            'kota' => 'Depok',
            'area' => 'Margonda',
            'alamat' => 'Jl. Saya No. 2',
            'tipe' => 'putra',
            'harga' => 800000,
            'kamar_tersedia' => 5,
            'fasilitas' => 'WiFi',
            'latitude' => -6.36,
            'longitude' => 106.82,
        ])->assertRedirect(route('pemilik.kos.index'));

        $this->assertDatabaseHas('kos', ['nama' => 'Kos Saya Sendiri', 'user_id' => $pemilik->id]);
    }

    public function test_alur_booking_sampai_diterima_pemilik(): void
    {
        $pemilik = User::factory()->create(['role' => 'pemilik']);
        $penyewa = User::factory()->create(['role' => 'user']);
        $kos = $this->buatKos($pemilik);

        $this->actingAs($penyewa)->post("/kos/{$kos->id}/booking", [
            'tanggal_masuk' => now()->addDays(5)->toDateString(),
            'durasi_bulan' => 3,
        ])->assertRedirect(route('bookings.index'));

        $booking = Booking::firstOrFail();
        $this->assertSame('menunggu', $booking->status);
        $this->assertSame(3000000, $booking->total_harga);
        $this->assertStringStartsWith('MK-', $booking->kode_booking);

        $this->actingAs($pemilik)->patch("/pemilik/booking/{$booking->id}/status", [
            'status' => 'diterima',
        ])->assertSessionHas('success');

        $this->assertSame('diterima', $booking->fresh()->status);
        $this->assertSame(2, $kos->fresh()->kamar_tersedia);
    }

    public function test_admin_bisa_menonaktifkan_kos_dari_katalog(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $pemilik = User::factory()->create(['role' => 'pemilik']);
        $kos = $this->buatKos($pemilik);

        $this->actingAs($admin)->patch("/admin/kos/{$kos->id}/toggle");

        $this->assertFalse($kos->fresh()->is_active);
        $this->get("/kos/{$kos->id}")->assertNotFound();
    }
}
