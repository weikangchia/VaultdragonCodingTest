<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectsValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objects_values', function (Blueprint $table) {
            $table->increments('id');
            $table->string('value');
            $table->unsignedInteger('object_id');
            $table->integer('created_at');
            $table->integer('updated_at');

            $table->foreign('object_id')->references('id')->on('objects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('objects_values');
    }
}
