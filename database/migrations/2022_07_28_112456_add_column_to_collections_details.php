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
        Schema::table('Collection_details', function (Blueprint $table) {
            $table->double('cash', 15, 4);
            $table->double('cash_add_refer', 15, 4);
            $table->double('cheque', 15, 4);
            $table->double('cheque_add_refer', 15, 4);
            $table->double('less_refer', 15, 4);
            $table->string('specify')->nullable();
            $table->string('remarks')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Collection_details', function (Blueprint $table) {
            $table->dropColumn('cash', 15, 4);
            $table->dropColumn('cash_add_refer', 15, 4);
            $table->dropColumn('cheque', 15, 4);
            $table->dropColumn('cheque_add_refer', 15, 4);
            $table->dropColumn('less_refer', 15, 4);
            $table->dropColumn('specify', 15, 4);
            $table->dropColumn('remarks', 15, 4);
            $table->dropColumn('cash', 15, 4);
            $table->dropColumn('cash', 15, 4);
        });
    }
};
