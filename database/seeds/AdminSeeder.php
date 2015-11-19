<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(array(
            array('name' => 'Admin', 'email' => 'steve8809@gmail.com', 'password' => bcrypt('tester'), 'created_at' => Carbon\Carbon::now(), 'updated_at' => Carbon\Carbon::now()),
            array('name' => 'Felhasználó1', 'email' => 'felhasznalo1@email.com', 'password' => bcrypt('tester'), 'created_at' => Carbon\Carbon::now(), 'updated_at' => Carbon\Carbon::now()),
            array('name' => 'Felhasználó2', 'email' => 'felhasznalo2@email.com', 'password' => bcrypt('tester'), 'created_at' => Carbon\Carbon::now(), 'updated_at' => Carbon\Carbon::now()),
            array('name' => 'Felhasználó3', 'email' => 'felhasznalo3@email.com', 'password' => bcrypt('tester'), 'created_at' => Carbon\Carbon::now(), 'updated_at' => Carbon\Carbon::now())
        ));

        DB::table('roles')->insert(array(
            array('name' => 'admin', 'display_name' => 'Admin', 'description' => 'Az admin felület kezelője'),
            array('name' => 'felhasználó', 'display_name' => 'Felhasználó', 'description' => 'Az oldal felhasználója')

        ));

        DB::table('role_user')->insert(array(
            array('user_id' => 1, 'role_id' => 1),
            array('user_id' => 2, 'role_id' => 2),
            array('user_id' => 3, 'role_id' => 2),
            array('user_id' => 4, 'role_id' => 2)
        ));
    }
}
