<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("carts", function(Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("session_id");
            $table->bigInteger("address_id")->nullable(true);
            $table->bigInteger("user_id")->nullable(true);
            $table->bigInteger("freight")->nullable(true);
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
        //
    }
}
