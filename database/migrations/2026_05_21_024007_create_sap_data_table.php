<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sap_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('upload_log_id')->nullable();
            $table->string('material')->nullable();
            $table->string('description')->nullable();
            $table->string('batch')->nullable();
            $table->string('plant')->nullable();
            $table->string('stor_location')->nullable();
            $table->string('serial_number')->nullable()->index();
            $table->string('created_by')->nullable();
            $table->string('system_status')->nullable();
            $table->string('changed_on')->nullable();
            $table->string('created_on')->nullable();
            $table->string('changed_by')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sap_data');
    }
};