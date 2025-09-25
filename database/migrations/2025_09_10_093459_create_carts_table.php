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
        // Supprimer l'ancienne table si elle existe
        Schema::dropIfExists('carts');

        // Créer la nouvelle table
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->unsignedBigInteger('client_id');
            $table->string('product_title');
            $table->string('product_reference');
            $table->decimal('unit_price', 10, 2);
            $table->integer('quantity');
            $table->decimal('total', 10, 2);
            $table->string('image')->nullable();
            $table->timestamps();

            // Optionnel : clé étrangère si tu as une table clients
             $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
              $table->foreign('product_reference')->references('reference')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
