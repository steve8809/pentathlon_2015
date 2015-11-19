<?php

use Illuminate\Database\Seeder;

class CompetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('competitions')->insert(array(
            array('name' => 'Verseny 1', 'country_id' => 135, 'town' => 'Budapest', 'host' => 'Honvéd', 'start_date' => Carbon\Carbon::now(), 'end_date' => Carbon\Carbon::now(), 'category' => 'Kupa'),
            array('name' => 'Verseny 2', 'country_id' => 135, 'town' => 'Székesfehérvár', 'host' => 'Alba Volán', 'start_date' => Carbon\Carbon::now(), 'end_date' => Carbon\Carbon::now(), 'category' => 'Kupa'),
            array('name' => 'Verseny 3', 'country_id' => 135, 'town' => 'Eger', 'host' => 'Eger', 'start_date' => Carbon\Carbon::now(), 'end_date' => Carbon\Carbon::now(), 'category' => 'Kupa'),
        ));

        DB::table('competitiongroups')->insert(array(
            array('competition_id' => 1, 'name' => 'Felnőtt Férfi', 'date' => Carbon\Carbon::now(), 'type' => 'Döntő', 'age_group' => 'Felnőtt', 'sex' => 'Férfi'),
            array('competition_id' => 1, 'name' => 'Felnőtt Női', 'date' => Carbon\Carbon::now(), 'type' => 'Döntő', 'age_group' => 'Felnőtt', 'sex' => 'Nő'),
            array('competition_id' => 2, 'name' => 'Junior Férfi', 'date' => Carbon\Carbon::now(), 'type' => 'Döntő', 'age_group' => 'Felnőtt', 'sex' => 'Férfi'),
            array('competition_id' => 2, 'name' => 'Junior Női', 'date' => Carbon\Carbon::now(), 'type' => 'Döntő', 'age_group' => 'Felnőtt', 'sex' => 'Nő'),
        ));

    }
}