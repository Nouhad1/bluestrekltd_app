<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('fiche_technique', function (Blueprint $table) {
            $table->id();

            // Correspond à product_reference VARCHAR(255)
            $table->string('product_reference');

            // Dimensions
            $table->double('longueur', 8, 2)->nullable();
            $table->double('largeur', 8, 2)->nullable();
            $table->double('profondeur', 8, 2)->nullable();

            // Colors JSON
            $table->json('colors')->nullable();

            // Image VARCHAR(200)
            $table->string('image', 200)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('fiche_technique');
    }
};
