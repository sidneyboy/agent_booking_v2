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
        Schema::create('inventory_draft_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('inventory_draft_id');
            $table->bigInteger('inventory_id');
            $table->Integer('remaining_quantity');
            $table->string('bo');
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
        Schema::dropIfExists('inventory_draft_details');
    }
};
