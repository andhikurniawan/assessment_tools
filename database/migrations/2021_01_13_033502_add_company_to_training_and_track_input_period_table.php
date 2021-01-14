<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyToTrainingAndTrackInputPeriodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('training', function (Blueprint $table) {
            $table->integer('company_id');
            $table->foreign('company_id')->references('id')->on('company')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });
        Schema::table('track_input_period', function (Blueprint $table) {
            $table->integer('company_id');
            $table->foreign('company_id')->references('id')->on('company')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
