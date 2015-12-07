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
            $table->string('sex');
            $table->string('age_group');
            $table->string('fencing_status');
            $table->integer('fencing_win')->nullable()->default(null);
            $table->integer('fencing_lose')->nullable()->default(null);
            $table->integer('penalty_points_fencing')->nullable()->default(null);
            $table->integer('fencing_points');
            $table->integer('fencing_order');
            $table->string('swimming_status');
            $table->string('swimming_time');
            $table->integer('penalty_points_swimming')->nullable()->default(null);
            $table->integer('swimming_points');
            $table->integer('swimming_order');
            $table->string('riding_status');
            $table->string('riding_point');
            $table->string('riding_time');
            $table->integer('riding_points');
            $table->integer('horse_id')->unsigned()->nullable();
            $table->foreign('horse_id')->references('id')->on('horses');
            $table->integer('riding_order');
            $table->string('ce_status');
            $table->string('ce_time');
            $table->integer('penalty_points_ce')->nullable()->default(null);
            $table->integer('ce_points');
            $table->integer('ce_order');
            $table->integer('total_points');
            $table->integer('total_penalty_points')->nullable()->default(null);
            $table->tinyInteger('dsq_status');
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
