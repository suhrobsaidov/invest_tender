<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users');
            $table->unsignedBigInteger('anouncements_id');
            $table->foreign('anouncements_id')->references('id')->on('anouncements');
            $table->enum('response_security_submited' ,['yes','no']);
            $table->integer('lot_number');
            $table->float('currency_somoni');
            $table->float('vat_somoni');
            $table->float('currency_dollar');
            $table->float('vat_dollar');
            $table->float('currency_euro');
            $table->float('vat_euro');
            $table->float('grand_total_euro');
            $table->float('grand_total_dolar');
            $table->float('total_amount');
            $table->float('vat_amount');
            $table->float('grand_total_including_VAT');
            $table->float('grand_total_excluding_discount');

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
        Schema::dropIfExists('orders');
    }
}
