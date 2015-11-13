<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);

        //$this->call(CountriesTableSeeder::class);

        //$this->call(AgeGroupsTableSeeder::class);

        //$this->call(CategoriesTableSeeder::class);

        //$this->call(CompetitorTableSeeder::class);

        //$this->call(SwimmingCeRulesTableSeeder::class);

        $this->call(FencingRulesTableSeeder::class);
        Model::reguard();
    }
}
