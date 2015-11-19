<?php

use Illuminate\Database\Seeder;

class ClubsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clubs')->insert(array(
            array('name' => 'Klub1', 'country' => 'Magyarország', 'town' => 'Budapest'),
            array('name' => 'Klub2', 'country' => 'Magyarország', 'town' => 'Pécs'),
            array('name' => 'Klub3', 'country' => 'Magyarország', 'town' => 'Debrecen'),
            array('name' => 'Klub4', 'country' => 'Magyarország', 'town' => 'Budapest'),
            array('name' => 'Klub5', 'country' => 'Magyarország', 'town' => 'Eger'),
            array('name' => 'Klub6', 'country' => 'Magyarország', 'town' => 'Székesfehérvár'),
        ));
    }
}
