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
        Schema::create('sales_registers', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('customer_id')->unsigned()->index();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->BigInteger('principal_id')->unsigned()->index();
            $table->foreign('principal_id')->references('id')->on('principals');
            $table->string('export_code')->nullable();
            $table->decimal('total_amount',15,2)->nullable();
            $table->string('dr')->nullable();
            $table->string('sku_type')->nullable();
            $table->string('date_delivered')->nullable();
            $table->string('status',20)->nullable();
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
        Schema::dropIfExists('sales_registers');
    }
};
