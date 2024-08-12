<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StoreOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_orders', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->unsignedBigInteger('shops_id');
        $table->unsignedBigInteger('order_id');
        $table->unsignedBigInteger('deliver_id');
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('product_id');
        $table->string('status');
        $table->integer('quantity');
        $table->string('time_to_deliver');
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
