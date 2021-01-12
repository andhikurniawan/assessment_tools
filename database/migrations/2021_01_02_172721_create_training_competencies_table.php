<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingCompetenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_competencies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_training');
            $table->integer('id_competency');
            $table->timestamps();
        });
        Schema::table('training_competencies', function (Blueprint $table) {
            $table->foreign('id_training')->references('id')->on('training')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('id_competency')->references('id')->on('competency')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training_competencies');
    }
}
