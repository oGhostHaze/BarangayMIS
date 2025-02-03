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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('excerpt')->nullable(); // Short preview text
            $table->longText('content'); // Full announcement details
            $table->string('category')->nullable(); // News, Advisory, Updates, etc.
            $table->string('image')->nullable(); // Featured image URL/path
            $table->string('status')->default('draft'); // draft, published, archived
            $table->timestamp('published_at')->nullable(); // Publish date and time
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Author reference
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};