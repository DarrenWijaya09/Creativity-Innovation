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
        Schema::table('providers', function (Blueprint $table) {
            $table->string('category')->nullable();
            $table->enum('type', ['online', 'offline'])->default('online');

            // STEP 2 (professional)
            $table->text('experience')->nullable();
            $table->text('portfolio')->nullable();
            $table->integer('base_price')->nullable();

            // STEP 3 (status system)
            $table->enum('verification_status', ['pending', 'verified', 'rejected'])
                ->default('pending');

            $table->boolean('is_active')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('providers', function (Blueprint $table) {
            //
        });
    }
};
