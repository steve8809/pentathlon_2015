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

        $this->call(CountriesTableSeeder::class);

        $this->call(AgeGroupsTableSeeder::class);

        $this->call(ClubsTableSeeder::class);

        $this->call(CategoriesTableSeeder::class);

        $this->call(CompetitorTableSeeder::class);

        $this->call(SwimmingCeRulesTableSeeder::class);

        $this->call(FencingRulesTableSeeder::class);

        $this->call(AdminSeeder::class);

        $this->call(HorsesTableSeeder::class);

        $this->call(CompetitionSeeder::class);

        Model::reguard();
    }
}
