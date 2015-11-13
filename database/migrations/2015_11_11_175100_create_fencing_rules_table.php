<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFencingRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fencing_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bouts');
            $table->integer('victory_points');
            $table->integer('bouts_250');
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
        Schema::drop('fencing_rules');
    }
}
