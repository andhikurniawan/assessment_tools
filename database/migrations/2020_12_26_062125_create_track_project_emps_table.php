<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackProjectEmpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('track_project_emps', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name', 100);
            $table->string('platform', 100);
            $table->string('position');
            $table->string('status');
            $table->date('start_date');
            $table->date('end_date');
            $table->longText('description');
            $table->string('time_performance');
            $table->string('cost_performance');
            $table->string('quality_performance');
            $table->longText('reason_failed');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('track_project_emps', function (Blueprint $table) {
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
        Schema::dropIfExists('track_project_emps');
    }
}
