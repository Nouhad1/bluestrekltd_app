<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            // Référence comme clé primaire
            $table->string('reference')->primary();

            $table->string('description')->nullable();
            $table->string('image')->nullable();

            // Foreign key vers categories
            $table->unsignedBigInteger('id_category');
            $table->foreign('id_category')->references('id')->on('catagories')->onDelete('cascade');

            $table->integer('quantity')->default(0);
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('discount_price', 10, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
