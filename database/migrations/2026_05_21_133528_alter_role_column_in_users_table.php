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
    Schema::table('users', function (Blueprint $table) {
        // Mengubah kolom role menjadi string dengan batas 50 karakter
        $table->string('role', 50)->change(); 
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('role', 10)->change(); // sesuaikan dengan panjang sebelumnya
    });
}};
