<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->uuid('follower_id');
            $table->uuid('followed_id');
            $table->timestamps();

            // Composite primary key to ensure uniqueness
            $table->primary(['follower_id', 'followed_id']);

            // Foreign key constraints
            $table->foreign('follower_id')
                ->references('id')->on('users')
                ->cascadeOnDelete();

            $table->foreign('followed_id')
                ->references('id')->on('users')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('follows');
    }
};
