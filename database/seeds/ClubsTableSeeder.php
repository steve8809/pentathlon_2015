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
            array('name' => 'Klub1', 'country' => 'Magyarország', 'town' => 'Budapest', 'in_competition' => 1),
            array('name' => 'Klub2', 'country' => 'Magyarország', 'town' => 'Pécs', 'in_competition' => 1),
            array('name' => 'Klub3', 'country' => 'Magyarország', 'town' => 'Debrecen', 'in_competition' => 1),
            array('name' => 'Klub4', 'country' => 'Magyarország', 'town' => 'Budapest', 'in_competition' => 1),
            array('name' => 'Klub5', 'country' => 'Magyarország', 'town' => 'Eger', 'in_competition' => 1),
            array('name' => 'Klub6', 'country' => 'Magyarország', 'town' => 'Székesfehérvár', 'in_competition' => 1),
        ));
    }
}
