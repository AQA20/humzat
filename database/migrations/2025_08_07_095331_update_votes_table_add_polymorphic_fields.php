<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('votes', function (Blueprint $table) {
            // Drop foreign key and column 'post_id'
            $table->dropForeign(['post_id']);
            $table->dropUnique(['user_id', 'post_id']);
            $table->dropColumn('post_id');

            // Add polymorphic columns
            $table->uuid('votable_id')->after('user_id');
            $table->string('votable_type')->after('votable_id');

            // Add unique index on user_id + votable_id + votable_type
            $table->unique(['user_id', 'votable_id', 'votable_type']);
        });
    }

    public function down(): void
    {
        Schema::table('votes', function (Blueprint $table) {
            // Drop new unique index and polymorphic columns
            $table->dropUnique(['user_id', 'votable_id', 'votable_type']);
            $table->dropColumn(['votable_id', 'votable_type']);

            // Add back post_id column and foreign key
            $table->uuid('post_id')->after('user_id');
            $table->unique(['user_id', 'post_id']);
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }
};
