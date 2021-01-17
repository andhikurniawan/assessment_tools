<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeyBehavioursTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('key__behaviours', function (Blueprint $table) {
            $table->increments('id');
            $table->String('level');
            $table->String('description');
            $table->integer('competency_id');
            $table->String('indicator');
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
        Schema::drop('key__behaviours');
    }
}
