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
        Schema::create('bad_order_details', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('bad_order_id')->unsigned()->index();
            $table->foreign('bad_order_id')->references('id')->on('bad_orders');
            $table->BigInteger('inventory_id')->unsigned()->index();
            $table->foreign('inventory_id')->references('id')->on('inventories');
            $table->Integer('quantity');
            $table->Double('unit_price', 15, 4);
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
        Schema::dropIfExists('bad_order_details');
    }
};
