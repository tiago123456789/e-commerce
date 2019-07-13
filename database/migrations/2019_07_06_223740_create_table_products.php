<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("description", 60);
            $table->decimal("price", 10, 2);
            $table->decimal("width", 10, 2);
            $table->decimal("height", 10, 2);
            $table->decimal("length", 10, 2);
            $table->decimal("weight", 10, 2);
            $table->decimal("url_image", 10, 2);
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
}
