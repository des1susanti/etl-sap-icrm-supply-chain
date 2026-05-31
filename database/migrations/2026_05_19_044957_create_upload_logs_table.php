<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
    Schema::create('upload_logs', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');

    $table->string('filename')->nullable();
    $table->string('file_name');

    $table->string('type');
    $table->enum('file_type', ['sap', 'icrm']);

    $table->string('status')->default('processing');

    $table->integer('row_count')->default(0);
    $table->string('periode', 7);

    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('upload_logs');
    }
};