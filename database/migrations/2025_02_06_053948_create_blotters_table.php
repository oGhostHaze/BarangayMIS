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
        Schema::create('blotters', function (Blueprint $table) {
            $table->id();
            $table->string('case_number')->unique();
            $table->string('complainant_name');
            $table->string('complainant_address')->nullable();
            $table->string('complainant_contact')->nullable();
            $table->string('respondent_name');
            $table->string('respondent_address')->nullable();
            $table->string('respondent_contact')->nullable();
            $table->string('witnesses')->nullable(); // Store multiple witness names
            $table->text('incident_details');
            $table->dateTime('incident_date');
            $table->string('location')->nullable();
            $table->enum('status', ['Pending', 'Resolved', 'Dismissed'])->default('Pending');
            $table->text('remarks')->nullable();
            $table->foreignId('recorded_by')->constrained('users')->onDelete('cascade'); // Barangay officer who recorded the case
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blotters');
    }
};
