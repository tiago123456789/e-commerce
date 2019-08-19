<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CartProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("carts_products", function(Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedInteger("cart_id");
            $table->unsignedInteger("product_id");
            $table->integer("quantity");

            $table->foreign("cart_id")->references("id")->on("carts")
                ->onDelete("cascade");
            $table->foreign("product_id")->references("id")->on("products")
                ->onDelete("cascade");

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
        Schema::dropIfExists("carts_products");
    }
}
