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
        Schema::create('inventory_drafts', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('customer_id');
            $table->string('principal_id');
            $table->string('sku_type');
            $table->BigInteger('sales_register_id');
            $table->string('date_delivered');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('inventory_drafts');
    }
};
