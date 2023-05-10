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
        Schema::table('Inventory_draft_details', function (Blueprint $table) {
            $table->Integer('delivered_quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Inventory_draft_details', function (Blueprint $table) {
            $table->dropColumn('delivered_quantity');
        });
    }
};
