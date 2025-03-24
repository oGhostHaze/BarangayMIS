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
        Schema::table('residents', function (Blueprint $table) {
            $table->boolean('4ps_member')->default(false)->after('source_of_income');
            $table->boolean('nhts_indigent')->default(false)->after('4ps_member');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('residents', function (Blueprint $table) {
            $table->dropColumn('4ps_member');
            $table->dropColumn('nhts_indigent');
        });
    }
};
