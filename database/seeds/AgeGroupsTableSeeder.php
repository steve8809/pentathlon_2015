<?php

use Illuminate\Database\Seeder;

class AgeGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('age_groups')->insert(array(
            array('age_group' => 'Senior'),
            array('age_group' => 'Felnőtt'),
            array('age_group' => 'Junior'),
            array('age_group' => 'Ifi A'),
            array('age_group' => 'Ifi B'),
            array('age_group' => 'Ifi C'),
            array('age_group' => 'Ifi D'),
            array('age_group' => 'Ifi E'),
            array('age_group' => 'Ifi F'),
        ));
    }
}
