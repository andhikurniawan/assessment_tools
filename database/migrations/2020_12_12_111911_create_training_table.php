<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('training_name', 100);
            $table->string('training_host', 100);
            $table->string('training_link', 100);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('training_status');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('training', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training');
    }
}
