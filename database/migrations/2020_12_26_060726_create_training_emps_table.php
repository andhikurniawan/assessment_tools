<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingEmpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_emps', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->unsignedBigInteger('id_training');
            $table->string('status', 100);
            $table->string('type', 100);
            $table->string('recommended_by', 100);
            $table->string('reason', 100);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('training_emps', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('user')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('id_training')->references('id')->on('training')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training_emps');
    }
}
