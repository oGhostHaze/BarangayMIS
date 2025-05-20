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
        Schema::table('blotters', function (Blueprint $table) {
            $table->foreignId('resident_id')->after('case_number')->nullable()->default(null)->comment('Resident ID');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blotters', function (Blueprint $table) {
            $table->dropForeign(['resident_id']);
            $table->dropColumn('resident_id');
        });
    }
};
