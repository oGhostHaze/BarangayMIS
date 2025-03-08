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
        Schema::table('certificate_requests', function (Blueprint $table) {
            $table->string('payment_method')->nullable();
            $table->timestamp('pickup_datetime')->nullable();
            $table->string('receipt_path')->nullable();
            $table->boolean('is_paid')->default(false)->after('receipt_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('certificate_requests', function (Blueprint $table) {
           $table->dropColumn('payment_method', 'pickup_datetime', 'receipt_path', 'is_paid');
        });
    }
};