<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kos extends Model
{
    protected $table = 'kos';

    protected $fillable = [
        'user_id', 'nama', 'kota', 'area', 'alamat', 'tipe', 'harga',
        'kamar_tersedia', 'fasilitas', 'deskripsi', 'aturan', 'foto_url',
        'latitude', 'longitude', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'latitude' => 'float',
            'longitude' => 'float',
        ];
    }

    public function pemilik(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function daftarFasilitas(): array
    {
        return array_filter(array_map('trim', explode(',', $this->fasilitas)));
    }
}
