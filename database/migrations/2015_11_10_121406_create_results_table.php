<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('competitiongroup_id')->unsigned();
            $table->foreign('competitiongroup_id')->references('id')->on('competitiongroups');
            $table->integer('competitor_id')->unsigned();
            $table->foreign('competitor_id')->references('id')->on('competitors');
            $table->integer('fencing_win');
            $table->integer('fencing_lose');
            $table->integer('fencing_points');
            $table->integer('fencing_order');
            $table->string('swimming_time');
            $table->integer('swimming_points');
            $table->integer('swimming_order');
            $table->integer('riding_points');
            $table->integer('horse_id')->unsigned()->nullable();
            $table->foreign('horse_id')->references('id')->on('horses');
            $table->integer('riding_order');
            $table->string('ce_time');
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
        Schema::drop('results');
    }
}
