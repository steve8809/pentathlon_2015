<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSwimmingCeRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('swimming_ce_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('age_group');
            $table->string('swimming_time');
            $table->string('swimming_dist');
            $table->string('ce_time');
            $table->string('ce_dist');
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
        Schema::drop('swimming_ce_rules');
    }
}
