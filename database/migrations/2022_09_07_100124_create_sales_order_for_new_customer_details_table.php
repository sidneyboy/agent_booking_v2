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
        Schema::create('sales_order_for_new_customer_details', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('sales_order_new_id');
            $table->BigInteger('inventory_id');
            $table->Integer('quantity');
            $table->double('unit_price',15,4);
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
        Schema::dropIfExists('sales_order_for_new_customer_details');
    }
};
