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
        Schema::create('certificate_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resident_id')->constrained('residents')->onDelete('cascade'); // Link to Resident
            $table->string('certificate_type'); // Type of certificate (Barangay Clearance, Indigency, etc.)
            $table->text('purpose')->nullable(); // Purpose of request
            $table->string('status')->default('Pending'); // Pending, Approved, Rejected, Released
            $table->dateTime('requested_at')->useCurrent(); // Request date
            $table->dateTime('approved_at')->nullable(); // Approval date
            $table->dateTime('released_at')->nullable(); // Release date
            $table->foreignId('processed_by')->nullable()->constrained('users')->onDelete('set null'); // Admin who processed the request
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificate_requests');
    }
};