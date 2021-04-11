<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        DB::table('users')->insert(array (
            0 => array(
                'id' => 1,
                'name' => 'Juan Dela Cruz',
                'email' => 'admin@me.com',
                'password' => bcrypt('password'),
                'role' => 'admin'
            ),
            1 => array(
                'id' => 2,
                'name' => 'Cashier',
                'email' => 'cashier@me.com',
                'password' => bcrypt('12345'),
                'role' => 'cashier'
            )
        ));

    }
}
