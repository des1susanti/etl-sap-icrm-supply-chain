<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // REVISI 1: Tambah kolom mismatch_count yang belum ada
        Schema::table('reconciliations', function (Blueprint $table) {
            $table->integer('mismatch_count')->default(0)->after('match_count');
        });

        // REVISI 2: Ubah enum status reconciliations tambah 'failed'
        // (MySQL tidak bisa alter enum langsung, pakai DB statement)
        DB::statement("ALTER TABLE reconciliations MODIFY COLUMN status 
            ENUM('draft','processing','completed','failed') DEFAULT 'draft'");

        // REVISI 3: Ubah enum status reconciliation_results tambah 'mismatch'
        // karena controller menyimpan status 'mismatch' tapi enum tidak ada
        DB::statement("ALTER TABLE reconciliation_results MODIFY COLUMN status 
            ENUM('match','mismatch','sap_only','icrm_only')");
    }

    public function down(): void
    {
        Schema::table('reconciliations', function (Blueprint $table) {
            $table->dropColumn('mismatch_count');
        });

        DB::statement("ALTER TABLE reconciliations MODIFY COLUMN status 
            ENUM('draft','processing','completed') DEFAULT 'draft'");

        DB::statement("ALTER TABLE reconciliation_results MODIFY COLUMN status 
            ENUM('match','sap_only','icrm_only')");
    }
};