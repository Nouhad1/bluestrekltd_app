<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->string('reference')->primary();
        $table->string('description')->nullable();
        $table->string('image')->nullable();
        $table->unsignedBigInteger('id_category');
        $table->integer('quantity')->default(0);
        $table->decimal('price', 10, 2)->nullable();
        $table->decimal('discount_price', 10, 2)->nullable();
        $table->timestamps();

        // Clé étrangère
        $table->foreign('id_category')->references('id')->on('catagories')->onDelete('cascade');
    });
}

public function down()
{
    Schema::dropIfExists('products');
}

};
