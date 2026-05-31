<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('icrm_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('upload_log_id')->nullable();
            $table->integer('no')->nullable();
            $table->string('petugas')->nullable();
            $table->string('nama_mitra')->nullable();
            $table->string('tanggal_bawa')->nullable();
            $table->string('durasi_bawa')->nullable();
            $table->string('serial_number')->nullable()->index();
            $table->string('brand')->nullable();
            $table->string('category')->nullable();
            $table->string('material_number')->nullable();
            $table->string('nama_material')->nullable();
            $table->string('unit')->nullable();
            $table->string('jumlah')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('icrm_data');
    }
};