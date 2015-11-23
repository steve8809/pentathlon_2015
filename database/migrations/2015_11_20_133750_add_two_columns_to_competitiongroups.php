<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTwoColumnsToCompetitiongroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('competitiongroups', function(Blueprint $table)
        {
            $table->integer('fencing_bouts');
            $table->integer('entry_closed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('competitiongroups', function(Blueprint $table)
        {
            $table->dropColumn('fencing_bouts');
            $table->dropColumn('entry_closed');
        });
    }
}
