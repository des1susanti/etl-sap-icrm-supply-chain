<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tambah kolom statistik saja (periode, approved_by, approved_at sudah ada)
        Schema::table('reconciliations', function (Blueprint $table) {
            $table->integer('sap_count')->default(0)->after('periode');
            $table->integer('icrm_count')->default(0)->after('sap_count');
            $table->integer('match_count')->default(0)->after('icrm_count');
            $table->integer('sap_only_count')->default(0)->after('match_count');
            $table->integer('icrm_only_count')->default(0)->after('sap_only_count');
            $table->integer('total_count')->default(0)->after('icrm_only_count');
        });

        // Buat tabel hasil rekonsiliasi
        Schema::create('reconciliation_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reconciliation_id');
            $table->string('serial_number')->nullable();
            $table->enum('status', ['match', 'sap_only', 'icrm_only']);
            // Kolom SAP
            $table->string('sap_material')->nullable();
            $table->string('sap_description')->nullable();
            $table->string('sap_batch')->nullable();
            $table->string('sap_plant')->nullable();
            $table->string('sap_location')->nullable();
            $table->string('sap_system_status')->nullable();
            // Kolom ICRM
            $table->string('icrm_material')->nullable();
            $table->string('icrm_nama_material')->nullable();
            $table->string('icrm_petugas')->nullable();
            $table->string('icrm_mitra')->nullable();
            $table->string('icrm_tanggal_bawa')->nullable();
            $table->string('icrm_durasi_bawa')->nullable();
            $table->timestamps();

            $table->foreign('reconciliation_id')
                  ->references('id')
                  ->on('reconciliations')
                  ->onDelete('cascade');
            $table->index(['reconciliation_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reconciliation_results');
        Schema::table('reconciliations', function (Blueprint $table) {
            $table->dropColumn([
                'sap_count', 'icrm_count', 'match_count',
                'sap_only_count', 'icrm_only_count', 'total_count',
            ]);
        });
    }
};