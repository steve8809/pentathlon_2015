<?php

use Illuminate\Database\Seeder;

class SwimmingCeRulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('swimming_ce_rules')->insert(array(
            array('type' => 'Egyéni', 'age_group' => 'Ifi F', 'swimming_time' => '00:45.00', 'swimming_dist' => '50 m', 'ce_time' => '04:00.00', 'ce_dist' => '400 m'),
            array('type' => 'Egyéni', 'age_group' => 'Ifi E', 'swimming_time' => '00:45.00', 'swimming_dist' => '50 m', 'ce_time' => '04:00.00', 'ce_dist' => '400 m'),
            array('type' => 'Egyéni', 'age_group' => 'Ifi D', 'swimming_time' => '01:20.00', 'swimming_dist' => '100 m', 'ce_time' => '05:20.00', 'ce_dist' => '800 m'),
            array('type' => 'Egyéni', 'age_group' => 'Ifi C', 'swimming_time' => '01:20.00', 'swimming_dist' => '100 m', 'ce_time' => '07:40.00', 'ce_dist' => '1600 m'),
            array('type' => 'Egyéni', 'age_group' => 'Ifi B', 'swimming_time' => '02:30.00', 'swimming_dist' => '200 m', 'ce_time' => '10:30.00', 'ce_dist' => '2400 m'),
            array('type' => 'Egyéni', 'age_group' => 'Ifi A', 'swimming_time' => '02:30.00', 'swimming_dist' => '200 m', 'ce_time' => '13:20.00', 'ce_dist' => '3200 m'),
            array('type' => 'Egyéni', 'age_group' => 'Junior', 'swimming_time' => '02:30.00', 'swimming_dist' => '200 m', 'ce_time' => '13:20.00', 'ce_dist' => '3200 m'),
            array('type' => 'Egyéni', 'age_group' => 'Felnőtt', 'swimming_time' => '02:30.00', 'swimming_dist' => '200 m', 'ce_time' => '13:20.00', 'ce_dist' => '3200 m'),
            array('type' => 'Egyéni', 'age_group' => 'Senior', 'swimming_time' => '02:30.00', 'swimming_dist' => '200 m', 'ce_time' => '13:20.00', 'ce_dist' => '3200 m'),
            array('type' => 'Váltó', 'age_group' => 'Ifi F', 'swimming_time' => '00:45.00', 'swimming_dist' => '2*25 m', 'ce_time' => '05:20.00', 'ce_dist' => '800 m'),
            array('type' => 'Váltó', 'age_group' => 'Ifi E', 'swimming_time' => '00:45.00', 'swimming_dist' => '2*25 m', 'ce_time' => '05:20.00', 'ce_dist' => '800 m'),
            array('type' => 'Váltó', 'age_group' => 'Ifi D', 'swimming_time' => '01:20.00', 'swimming_dist' => '2*50 m', 'ce_time' => '05:20.00', 'ce_dist' => '800 m'),
            array('type' => 'Váltó', 'age_group' => 'Ifi C', 'swimming_time' => '01:20.00', 'swimming_dist' => '2*50 m', 'ce_time' => '07:40.00', 'ce_dist' => '1600 m'),
            array('type' => 'Váltó', 'age_group' => 'Ifi B', 'swimming_time' => '02:30.00', 'swimming_dist' => '2*100 m', 'ce_time' => '13:20.00', 'ce_dist' => '3200 m'),
            array('type' => 'Váltó', 'age_group' => 'Ifi A', 'swimming_time' => '02:30.00', 'swimming_dist' => '2*100 m', 'ce_time' => '13:20.00', 'ce_dist' => '3200 m'),
            array('type' => 'Váltó', 'age_group' => 'Junior', 'swimming_time' => '02:30.00', 'swimming_dist' => '2*100 m', 'ce_time' => '13:20.00', 'ce_dist' => '3200 m'),
            array('type' => 'Váltó', 'age_group' => 'Felnőtt', 'swimming_time' => '02:30.00', 'swimming_dist' => '2*100 m', 'ce_time' => '13:20.00', 'ce_dist' => '3200 m'),
            array('type' => 'Váltó', 'age_group' => 'Senior', 'swimming_time' => '02:30.00', 'swimming_dist' => '2*100 m', 'ce_time' => '13:20.00', 'ce_dist' => '3200 m'),
        ));
    }
}
