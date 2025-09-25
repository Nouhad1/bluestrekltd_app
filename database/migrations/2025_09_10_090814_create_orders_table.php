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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Lien vers la table clients
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');

            // Infos client au moment de la commande
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();

            // Infos produit
            $table->string('product_title');
            $table->string('product_id')->nullable();
            $table->string('image')->nullable();

            // Prix et quantité
            $table->decimal('price', 10, 2);
            $table->integer('quantity');
            $table->decimal('total_price', 10, 2);

            // Statuts
            $table->string('payment_status')->default('pending');
            $table->string('delivery_status')->default('processing');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
