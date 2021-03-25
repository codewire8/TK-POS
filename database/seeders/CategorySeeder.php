<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('categories')->truncate();

       DB::table('categories')->insert(array (
            0 => array(
                'id' => 1,
                'name' => 'Milk Tea'
            ),
            1 => array(
                'id' => 2,
                'name' => 'Fruit Tea'
            )
       ));
    }
}
