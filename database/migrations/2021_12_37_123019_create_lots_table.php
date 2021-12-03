<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orders_id');
            $table->foreign('orders_id')->references('id')->on('orders');
            $table->string('title');
            $table->integer('lot_number');
            $table->float('vat_amount');
            $table->float('grand_total_amount');
            $table->float('total_somoni');
            $table->float('total_dollar');
            $table->float('total_euro');
            $table->float('vat_somoni');
            $table->float('vat_dollar');
            $table->float('vat_euro');

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
        Schema::dropIfExists('lots');
    }
}
