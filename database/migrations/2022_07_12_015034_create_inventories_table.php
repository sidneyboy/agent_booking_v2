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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('sku_code');
            $table->string('description');
            $table->string('sku_type');
            $table->BigInteger('principal_id')->unsigned()->index();
            $table->foreign('principal_id')->references('id')->on('principals');
            $table->Integer('running_balance');
            $table->decimal('price_1',15,4);
            $table->decimal('price_2',15,4);
            $table->decimal('price_3',15,4);
            $table->decimal('price_4',15,4);
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
        Schema::dropIfExists('inventories');
    }
};
