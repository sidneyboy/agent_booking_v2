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
        Schema::create('sales_order_new_customers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sales_order_id');
            $table->string('store_name');
            $table->string('kob');
            $table->string('contact_person');
            $table->string('contact_number');
            $table->string('location');
            $table->string('location_id');
            $table->string('detailed_address');
            $table->string('longitude');
            $table->string('latitude');
            $table->string('status');
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
        Schema::dropIfExists('sales_order_new_customers');
    }
};
