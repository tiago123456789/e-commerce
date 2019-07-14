<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProductsCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("product_id")->unsigned();
            $table->integer("category_id")->unsigned();
            $table->foreign("product_id")->references("id")
                ->on("products")->onDelete("cascade");
            $table->foreign("category_id")->references("id")
                ->on("categories")->onDelete("cascade");
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
        Schema::dropIfExists('table_products_categories');
    }
}
