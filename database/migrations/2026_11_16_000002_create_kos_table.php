<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('nama');
            $table->string('kota');
            $table->string('area');
            $table->string('alamat');
            $table->enum('tipe', ['putra', 'putri', 'campur']);
            $table->unsignedInteger('harga');
            $table->unsignedInteger('kamar_tersedia')->default(1);
            $table->text('fasilitas');
            $table->text('deskripsi')->nullable();
            $table->text('aturan')->nullable();
            $table->string('foto_url')->nullable();
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kos');
    }
};
