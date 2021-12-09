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
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name');
            $table->integer('number_of_lots');
            $table->unsignedBigInteger('projects_id')->nullable();
            $table->foreign('projects_id')->references('id')->on('projects')->onDelete('cascade');
            $table->string('project_center_anouncement_id');
            $table->string('type_of_procurement');
            $table->string('procurement_method')->nullable();
            $table->string('tender_owner')->nullable();
            $table->string('tender_title')->nullable();
            $table->float('price')->default('0');
            $table->date('open_date');
            $table->string('file');
          
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
