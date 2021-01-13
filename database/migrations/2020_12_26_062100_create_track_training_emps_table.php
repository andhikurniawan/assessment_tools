<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackTrainingEmpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('track_training_emps', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name', 100);
            $table->string('host', 100);
            $table->integer('duration');
            $table->date('start_date');
            $table->date('end_date');
            $table->longText('description');
            $table->longText('reason_associated_work');
            $table->string('certificate');
            $table->string('link');
            $table->string('status');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('track_training_emps', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('user')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('track_training_emps');
    }
}
