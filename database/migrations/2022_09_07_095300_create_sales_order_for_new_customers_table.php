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
        Schema::create('sales_order_for_new_customers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('principal_id');
            $table->bigInteger('agent_id');
            $table->string('mode_of_transaction');
            $table->string('sku_type');
            $table->string('status');
            $table->string('exported')->nullable();
            $table->string('sales_order_number');
            $table->double('total_amount',15,4);
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
        Schema::dropIfExists('sales_order_for_new_customers');
    }
};
