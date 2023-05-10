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
        Schema::create('customer_exports', function (Blueprint $table) {
            $table->id();
            $table->string('store_name');
            $table->string('contact_person');
            $table->string('contact_number');
            $table->string('location');
            $table->string('location_id');
            $table->string('detailed_address');
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
        Schema::dropIfExists('customer_exports');
    }
};
