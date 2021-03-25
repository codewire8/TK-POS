<?php

namespace Database\Seeders;

use App\Models\Flavor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FlavorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('flavors')->truncate();

        DB::table('flavors')->insert(array (
            0 => array(
                'id' => 1,
                'name' => 'Caramel',
                'category_id' => 1
            ),
            1 => array(
                'id' => 2,
                'name' => 'Chocolate Strawberry',
                'category_id' => 1
            ),
            2 => array(
                'id' => 3,
                'name' => 'Chocolate Kisses',
                'category_id' => 1
            ),
            3 => array(
                'id' => 4,
                'name' => 'Cookies & Cream',
                'category_id' => 1
            ),
            4 => array(
                'id' => 5,
                'name' => 'Hersheys',
                'category_id' => 1
            ),
            5 => array(
                'id' => 6,
                'name' => 'Matcha',
                'category_id' => 1
            ),
            6 => array(
                'id' => 7,
                'name' => 'Okinawa',
                'category_id' => 1
            ),
            7 => array(
                'id' => 8,
                'name' => 'Red Velvet',
                'category_id' => 1
            ),
            8 => array(
                'id' => 9,
                'name' => 'Taro',
                'category_id' => 1
            ),
            9 => array(
                'id' => 10,
                'name' => 'Ube',
                'category_id' => 1
            ),
            10 => array(
                'id' => 11,
                'name' => 'Wintermelon',
                'category_id' => 1
            ),
            11 => array(
                'id' => 12,
                'name' => 'Lychee',
                'category_id' => 2
            ),
            12 => array(
                'id' => 13,
                'name' => 'Strawberry',
                'category_id' => 2
            )
        ));
    }
}
