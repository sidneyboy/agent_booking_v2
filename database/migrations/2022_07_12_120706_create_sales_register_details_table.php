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
        Schema::create('sales_register_details', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('sales_register_id')->unsigned()->index();
            $table->foreign('sales_register_id')->references('id')->on('sales_registers');
            $table->BigInteger('inventory_id')->unsigned()->index();
            $table->foreign('inventory_id')->references('id')->on('inventories');
            $table->Integer('delivered_quantity');
            $table->Double('unit_price', 15, 4)->nullable();
            $table->string('sku_type');
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
        Schema::dropIfExists('sales_register_details');
    }
};
