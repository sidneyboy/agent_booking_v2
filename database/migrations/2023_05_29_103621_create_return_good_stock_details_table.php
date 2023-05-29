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
        Schema::create('return_good_stock_details', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('rgs_id')->unsigned()->index();
            $table->foreign('rgs_id')->references('id')->on('return_good_stocks');
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
        Schema::dropIfExists('return_good_stock_details');
    }
};
