<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('upload_logs', function (Blueprint $table) {
            $table->string('filename')->nullable()->after('user_id');
            $table->string('type')->nullable()->after('filename');
            $table->string('status')->default('success')->after('type');
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('upload_logs', function (Blueprint $table) {
            $table->dropColumn(['filename', 'type', 'status', 'updated_at']);
        });
    }
};