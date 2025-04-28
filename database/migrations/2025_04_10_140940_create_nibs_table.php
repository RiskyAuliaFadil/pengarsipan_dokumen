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
        Schema::create('nibs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nib');
            $table->string('no_nib');
            $table->string('kode_kbli');
            $table->string('alamat_nib');
            $table->string('arsip_nib');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nibs');
    }
};
