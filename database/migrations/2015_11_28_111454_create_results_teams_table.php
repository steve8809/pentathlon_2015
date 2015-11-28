<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results_teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('competitiongroup_id')->unsigned();
            $table->foreign('competitiongroup_id')->references('id')->on('competitiongroups');
            $table->integer('competitor1_id')->unsigned();
            $table->foreign('competitor1_id')->references('id')->on('competitors');
            $table->integer('competitor2_id')->unsigned();
            $table->foreign('competitor2_id')->references('id')->on('competitors');
            $table->integer('competitor3_id')->unsigned();
            $table->foreign('competitor3_id')->references('id')->on('competitors');
            $table->integer('fencing_points');
            $table->integer('fencing_order');
            $table->integer('swimming_points');
            $table->integer('swimming_order');
            $table->integer('riding_points');
            $table->integer('riding_order');
            $table->integer('ce_points');
            $table->integer('ce_order');
            $table->integer('total_points');
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
        Schema::drop('results_teams');
    }
}
