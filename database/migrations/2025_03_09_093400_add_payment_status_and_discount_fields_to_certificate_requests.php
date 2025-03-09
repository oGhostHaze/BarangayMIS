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
            $table->string('payment_status')->default('unpaid')->after('is_paid');
            $table->timestamp('payment_submitted_at')->nullable()->after('payment_status');
            $table->timestamp('payment_verified_at')->nullable()->after('payment_submitted_at');
            $table->string('discount_type')->default('None')->after('payment_verified_at');
            $table->string('discount_id_number')->nullable()->after('discount_type');
            $table->decimal('discount_amount', 8, 2)->default(0)->after('discount_id_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('certificate_requests', function (Blueprint $table) {
            $table->dropColumn([
                'payment_status',
                'payment_submitted_at',
                'payment_verified_at',
                'discount_type',
                'discount_id_number',
                'discount_amount'
            ]);
        });
    }
};