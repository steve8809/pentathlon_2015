<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(array(
            array('category' => 'Világkupa'),
            array('category' => 'Európa-bajnokság'),
            array('category' => 'Világbajnokság'),
            array('category' => 'Országos verseny'),
            array('category' => 'Felkészülési verseny'),
            array('category' => 'Olimpia'),
            array('category' => 'Egyéb'),
            array('category' => 'Kupa'),
        ));
    }
}
