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
        Schema::create('customer_export_details', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('customer_export_id')->nullable();
            $table->BigInteger('customer_id')->nullable();
            $table->BigInteger('principal_id')->nullable();
            $table->string('price_level')->nullable();
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
        Schema::dropIfExists('customer_export_details');
    }
};
