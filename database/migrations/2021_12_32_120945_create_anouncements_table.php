<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()    
    {
        Schema::create('anouncements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users');
            $table->string('files')->nuallable();
            $table->string('name');
            $table->integer('number_of_lots');
            $table->unsignedBigInteger('projects_id');
            $table->foreign('projects_id')->references('id')->on('projects');
            $table->string('project_center_anouncement_id');
            $table->enum('type_of_procurement', ['work','goods','consulting'])->default('work');
            $table->string('procurement_method');
            $table->string('tender_owner');
            $table->string('tender_title');
            $table->float('price')->default('0');
            $table->date('open_date');
            $table->string('description');
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
        Schema::dropIfExists('anouncements');
    }
}
