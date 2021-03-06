<?php

use Illuminate\Database\Seeder;

class CompetitorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sexes = array('Férfi', 'Nő');
        $start = strtotime("1 January 1980");
        $end = strtotime("31 December 1996");
        for ($n = 1; $n < 81; ++$n) {
            $rand_date = mt_rand($start, $end);
            $birthday = date("Y-m-d", $rand_date);
            $sex = $sexes[array_rand($sexes, 1)];
            $country_id = rand(1,238);
            $club = rand(1,6);
            $full_name = 'Versenyző '.$n;
            DB::table('competitors')->insert(
                array('last_name' => 'Versenyző',
                    'first_name' => $n,
                    'sex' => $sex,
                    'birthday' => $birthday,
                    'country_id' => $country_id,
                    'club_id' => $club,
                    'full_name' => $full_name
                    )
            );
        }
    }

}

