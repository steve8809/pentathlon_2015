<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFencingResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fencing_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('competitiongroup_id')->unsigned();
            $table->foreign('competitiongroup_id')->references('id')->on('competitiongroups');
            $table->integer('competitor1_id')->unsigned();
            $table->foreign('competitor1_id')->references('id')->on('competitors');
            $table->integer('competitor2_id')->unsigned();
            $table->foreign('competitor2_id')->references('id')->on('competitors');
            $table->integer('competitor1_bouts');
            $table->integer('competitor2_bouts');
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
        Schema::drop('fencing_results');
    }
}
