<?php

use Illuminate\Database\Seeder;

class FencingRulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fencing_rules')->insert(array(
            array('bouts' => '60', 'victory_points' => '4', 'bouts_250' => '42'),
            array('bouts' => '59', 'victory_points' => '4', 'bouts_250' => '41'),
            array('bouts' => '58', 'victory_points' => '4', 'bouts_250' => '41'),
            array('bouts' => '57', 'victory_points' => '4', 'bouts_250' => '40'),
            array('bouts' => '56', 'victory_points' => '4', 'bouts_250' => '39'),
            array('bouts' => '55', 'victory_points' => '4', 'bouts_250' => '39'),
            array('bouts' => '54', 'victory_points' => '4', 'bouts_250' => '38'),
            array('bouts' => '53', 'victory_points' => '4', 'bouts_250' => '37'),
            array('bouts' => '52', 'victory_points' => '4', 'bouts_250' => '36'),
            array('bouts' => '51', 'victory_points' => '4', 'bouts_250' => '36'),
            array('bouts' => '50', 'victory_points' => '4', 'bouts_250' => '35'),
            array('bouts' => '49', 'victory_points' => '4', 'bouts_250' => '34'),
            array('bouts' => '48', 'victory_points' => '4', 'bouts_250' => '34'),
            array('bouts' => '47', 'victory_points' => '5', 'bouts_250' => '33'),
            array('bouts' => '46', 'victory_points' => '5', 'bouts_250' => '32'),
            array('bouts' => '45', 'victory_points' => '5', 'bouts_250' => '32'),
            array('bouts' => '44', 'victory_points' => '5', 'bouts_250' => '31'),
            array('bouts' => '43', 'victory_points' => '5', 'bouts_250' => '30'),
            array('bouts' => '42', 'victory_points' => '5', 'bouts_250' => '29'),
            array('bouts' => '41', 'victory_points' => '5', 'bouts_250' => '29'),
            array('bouts' => '40', 'victory_points' => '5', 'bouts_250' => '28'),
            array('bouts' => '39', 'victory_points' => '6', 'bouts_250' => '27'),
            array('bouts' => '38', 'victory_points' => '6', 'bouts_250' => '27'),
            array('bouts' => '37', 'victory_points' => '6', 'bouts_250' => '26'),
            array('bouts' => '36', 'victory_points' => '6', 'bouts_250' => '25'),
            array('bouts' => '35', 'victory_points' => '6', 'bouts_250' => '25'),
            array('bouts' => '34', 'victory_points' => '6', 'bouts_250' => '24'),
            array('bouts' => '33', 'victory_points' => '7', 'bouts_250' => '23'),
            array('bouts' => '32', 'victory_points' => '7', 'bouts_250' => '22'),
            array('bouts' => '31', 'victory_points' => '7', 'bouts_250' => '22'),
            array('bouts' => '30', 'victory_points' => '7', 'bouts_250' => '21'),
            array('bouts' => '29', 'victory_points' => '8', 'bouts_250' => '20'),
            array('bouts' => '28', 'victory_points' => '8', 'bouts_250' => '20'),
            array('bouts' => '27', 'victory_points' => '8', 'bouts_250' => '19'),
            array('bouts' => '26', 'victory_points' => '8', 'bouts_250' => '18'),
            array('bouts' => '25', 'victory_points' => '8', 'bouts_250' => '18'),
            array('bouts' => '24', 'victory_points' => '8', 'bouts_250' => '17'),
            array('bouts' => '23', 'victory_points' => '8', 'bouts_250' => '16'),
            array('bouts' => '22', 'victory_points' => '9', 'bouts_250' => '15'),
            array('bouts' => '21', 'victory_points' => '9', 'bouts_250' => '15'),
            array('bouts' => '20', 'victory_points' => '9', 'bouts_250' => '14'),
            array('bouts' => '19', 'victory_points' => '9', 'bouts_250' => '13'),
            array('bouts' => '18', 'victory_points' => '', 'bouts_250' => ''),
            array('bouts' => '17', 'victory_points' => '', 'bouts_250' => ''),
            array('bouts' => '16', 'victory_points' => '', 'bouts_250' => ''),
            array('bouts' => '15', 'victory_points' => '', 'bouts_250' => ''),
            array('bouts' => '14', 'victory_points' => '', 'bouts_250' => ''),
            array('bouts' => '13', 'victory_points' => '', 'bouts_250' => ''),
            array('bouts' => '12', 'victory_points' => '', 'bouts_250' => ''),
            array('bouts' => '11', 'victory_points' => '', 'bouts_250' => ''),
            array('bouts' => '10', 'victory_points' => '', 'bouts_250' => ''),
            array('bouts' => '9', 'victory_points' => '', 'bouts_250' => ''),
            array('bouts' => '8', 'victory_points' => '', 'bouts_250' => ''),
        ));
    }
}
