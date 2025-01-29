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
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('suffix')->nullable();
            $table->string('prefix')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('sitio')->nullable();
            $table->date('date_of_birth');
            $table->string('gender');
            $table->string('civil_status');
            $table->string('philhealth_id')->nullable();
            $table->string('sss_id')->nullable();
            $table->string('gsis_id')->nullable();
            $table->string('social_pension_id')->nullable();
            $table->boolean('is_pwd')->default(false);
            $table->string('pwd_id')->nullable();
            $table->string('type_of_disability')->nullable();
            $table->string('illness')->nullable();
            $table->boolean('is_solo_parent')->default(false);
            $table->string('solo_parent_id')->nullable();
            $table->boolean('is_senior_citizen')->default(false);
            $table->string('senior_citizen_id')->nullable();
            $table->string('educational_attainment')->nullable();
            $table->string('source_of_income')->nullable();
            $table->decimal('monthly_income', 10, 2)->nullable();
            $table->enum('income_type', ['Regular', 'Irregular'])->nullable();
            $table->boolean('is_ofw')->default(false);
            $table->string('ofw_country')->nullable();
            $table->boolean('ofw_is_domestic_helper')->default(false);
            $table->boolean('ofw_professional')->default(false);
            $table->timestamps();
        });
        Schema::create('medications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resident_id')->constrained()->onDelete('cascade');
            $table->string('medication_name');
            $table->text('dosage')->nullable();
            $table->text('instructions')->nullable();
            $table->date('prescribed_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};