<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntegersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('integers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('original_number')->unsigned();
            $table->string('roman_number')->nullable(false);
            $table->integer('nr_frequency')->unsigned();
            $table->integer('created')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('integers');
    }
}
