<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::table('reconciliations', function (Blueprint $table) {
        $table->integer('match_count')->default(0)->after('status');
        $table->integer('mismatch_count')->default(0)->after('match_count');
        $table->integer('sap_only_count')->default(0)->after('mismatch_count');
        $table->integer('icrm_only_count')->default(0)->after('sap_only_count');
        $table->integer('total_count')->default(0)->after('icrm_only_count');
    });
}

public function down(): void
{
    Schema::table('reconciliations', function (Blueprint $table) {
        $table->dropColumn([
            'match_count', 'mismatch_count', 
            'sap_only_count', 'icrm_only_count', 'total_count'
        ]);
    });
}
};
