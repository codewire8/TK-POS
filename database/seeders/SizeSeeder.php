<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sizes')->truncate();

        DB::table('sizes')->insert(array (
            0 => array(
                'id' => 1,
                'name' => 'Small'
            ),
            1 => array(
                'id' => 2,
                'name' => 'Medium'
            ),
            2 => array(
                'id' => 3,
                'name' => 'Large'
            ),
            3 => array(
                'id' => 4,
                'name' => 'Twin Cup'
            ),
            4 => array(
                'id' => 5,
                'name' => '1 Liter'
            )
        ));
    }
}
