<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ktps', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ktp');
            $table->string('nik_ktp');
            $table->foreignId('provinsi_id')->constrained('provinsis')->cascadeOnDelete();
            $table->foreignId('kota_id')->constrained('kotas')->cascadeOnDelete();
            $table->foreignId('kecamatan_id')->constrained('kecamatans')->cascadeOnDelete();
            $table->foreignId('kelurahan_id')->constrained('kelurahans')->cascadeOnDelete();
            $table->string('alamat_ktp');
            $table->string('arsip_ktp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ktps');
    }
};
