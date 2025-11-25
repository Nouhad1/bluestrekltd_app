<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();

            // Infos client
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');

            // Client ID
            $table->unsignedBigInteger('client_id');

            // Infos produit
            $table->string('product_title');
            $table->string('product_reference');
            $table->decimal('unit_price', 10, 2);

            // Quantité + total
            $table->integer('quantity');
            $table->decimal('total', 10, 2);

            // Image
            $table->string('image')->nullable();

            $table->timestamps();

            // Foreign key (même si dans SQL ce n'est pas défini)
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('carts');
    }
};
