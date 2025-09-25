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
    Schema::create('entries', function (Blueprint $table) {
        $table->id();
        $table->string('product_reference'); // référence du produit
        $table->integer('quantity')->default(0); // quantité ajoutée
        $table->timestamps();

        $table->foreign('product_reference')->references('reference')->on('products')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entries');
    }
};
