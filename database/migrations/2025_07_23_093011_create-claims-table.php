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
        Schema::create('claims', function (Blueprint $table) {
            $table->uuid('id')->primary();                  // Unique claim ID
            $table->uuid('user_id');                        // Who submitted the claim
            $table->string('domain');                       // Domain they claim to represent (e.g., nytimes.com)
            $table->text('proof');                          // Supporting info (URL, explanation, screenshot)
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Claim status
            $table->timestampsTz();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claims');
    }
};
