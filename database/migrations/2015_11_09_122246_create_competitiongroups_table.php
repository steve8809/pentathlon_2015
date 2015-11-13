<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitiongroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competitiongroups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('competition');
            $table->string('name');
            $table->date('date');
            $table->string('type');
            $table->string('age_group');
            $table->string('sex');
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
        Schema::drop('competitiongroups');
    }
}
