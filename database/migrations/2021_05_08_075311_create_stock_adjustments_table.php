<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockAdjustmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_adjustments', function (Blueprint $table) {
            $table->id();
            $table->string('refno');
            $table->integer('qty');
            $table->string('action');
            $table->string('remarks');
            $table->date('adjustment_date');
            $table->foreignId('flavor_id');
            $table->string('user');
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
        Schema::dropIfExists('stock_adjustments');
    }
}
