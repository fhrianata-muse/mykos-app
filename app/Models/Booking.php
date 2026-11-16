<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'user_id', 'kos_id', 'kode_booking', 'tanggal_masuk',
        'durasi_bulan', 'total_harga', 'status', 'catatan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_masuk' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kos(): BelongsTo
    {
        return $this->belongsTo(Kos::class);
    }
}
