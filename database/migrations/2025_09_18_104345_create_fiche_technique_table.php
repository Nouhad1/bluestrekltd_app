<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fiche_technique', function (Blueprint $table) {
            $table->id();
            $table->string('product_reference'); // Référence produit
            $table->float('longueur')->nullable();
            $table->float('largeur')->nullable();
            $table->float('profondeur')->nullable();
            $table->json('colors')->nullable();
            $table->timestamps();

            // Clé étrangère vers products.reference
            $table->foreign('product_reference')
                  ->references('reference')
                  ->on('products')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fiche_technique');
    }
};
