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
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            // BUYER
            $table->foreignId('buyer_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // SELLER
            $table->foreignId('seller_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // OPTIONAL SERVICE CONTEXT
            $table->foreignId('service_id')
                ->nullable()
                ->constrained('services')
                ->nullOnDelete();

            // PREVENT DUPLICATE CONVERSATION
            $table->unique([
                'buyer_id',
                'seller_id',
                'service_id'
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};
