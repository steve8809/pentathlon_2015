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
            array('name' => 'Verseny 1', 'country_id' => 135, 'town' => 'Budapest', 'host' => 'Honvéd', 'date' => Carbon\Carbon::now(), 'category' => 'Kupa', 'in_competition' => 1),
            array('name' => 'Verseny 2', 'country_id' => 135, 'town' => 'Székesfehérvár', 'host' => 'Alba Volán', 'date' => Carbon\Carbon::now()->addDays(-1), 'category' => 'Kupa', 'in_competition' => 1),
            array('name' => 'Verseny 3', 'country_id' => 135, 'town' => 'Eger', 'host' => 'Eger', 'date' => Carbon\Carbon::now()->addDays(-2), 'category' => 'Kupa', 'in_competition' => 1),
        ));

        DB::table('competitiongroups')->insert(array(
            array('competition_id' => 1, 'name' => 'Felnőtt Férfi Döntő', 'date' => Carbon\Carbon::now(), 'type' => 'Döntő', 'age_group' => 'Felnőtt', 'sex' => 'Férfi'),
            array('competition_id' => 1, 'name' => 'Felnőtt Nő Döntő', 'date' => Carbon\Carbon::now(), 'type' => 'Döntő', 'age_group' => 'Felnőtt', 'sex' => 'Nő'),
            array('competition_id' => 2, 'name' => 'Junior Férfi Döntő', 'date' => Carbon\Carbon::now()->addDays(-1), 'type' => 'Döntő', 'age_group' => 'Felnőtt', 'sex' => 'Férfi'),
            array('competition_id' => 2, 'name' => 'Junior Nő Döntő', 'date' => Carbon\Carbon::now()->addDays(-1), 'type' => 'Döntő', 'age_group' => 'Felnőtt', 'sex' => 'Nő'),
            array('competition_id' => 3, 'name' => 'Ifi E Nő Döntő', 'date' => Carbon\Carbon::now()->addDays(-2), 'type' => 'Döntő', 'age_group' => 'Ifi E', 'sex' => 'Nő'),
            array('competition_id' => 3, 'name' => 'Ifi E Férfi Döntő', 'date' => Carbon\Carbon::now()->addDays(-2), 'type' => 'Döntő', 'age_group' => 'Ifi E', 'sex' => 'Férfi'),
        ));

    }
}
