<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('client_id')
                  ->constrained('clients')
                  ->onDelete('cascade');

            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();

            $table->string('product_title');
            $table->string('product_id')->nullable(); // dans ta DB c'est varchar, pas bigint
            $table->string('image')->nullable();

            $table->decimal('price', 10, 2)->nullable();
            $table->integer('quantity');
            $table->decimal('total_price', 10, 2);

            $table->string('payment_status')->default('pending');
            $table->string('delivery_status')->default('processing');

            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void {
        Schema::dropIfExists('orders');
    }
};
