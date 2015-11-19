<?php

use Illuminate\Database\Seeder;

class HorsesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colours = array('Sárga', 'Fekete', 'Pej', 'Szürke', 'Fakó');
        $sexes = array('Kanca', 'Mén', 'Herélt');
        for ($n = 1; $n < 21; ++$n) {
            $sex = $sexes[array_rand($sexes, 1)];
            $colour = $colours[array_rand($colours, 1)];
            $age = rand(1,15);
            DB::table('horses')->insert(
                array('name' => 'Ló '.$n,
                    'sex' => $sex,
                    'colour' => $colour,
                    'age' => $age
                )
            );
        }
    }
}
