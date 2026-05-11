<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('forum_threads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('category_id')
                ->constrained('forum_categories')
                ->cascadeOnDelete();

            $table->string('title');
            $table->string('slug')->unique();

            $table->longText('content');

            $table->unsignedInteger('views_count')->default(0);
            $table->unsignedInteger('upvotes_count')->default(0);
            $table->unsignedInteger('replies_count')->default(0);

            $table->boolean('is_pinned')->default(false);

            $table->enum('status', [
                'published',
                'hidden',
                'archived',
            ])->default('published');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forum_threads');
    }
};
