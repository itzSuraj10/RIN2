<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersData = array(
            [ 'id' => 1, 'name'=> 'Suraj Suri', 'email' => 'surajsuri444@gmail.com'],
            [ 'id' => 2, 'name'=> 'Gautam Tyagi', 'email' => 'gautam.tyagi@peoplefone.com'],
            [ 'id' => 3, 'name'=> 'Danette Beaud', 'email' => 'danette.beaud@peoplefone.com'],
            [ 'id' => 4, 'name'=> 'Luca Marchesi', 'email' => 'luca.marchesi@peoplefone.com'],
        );

        for ($i = 0; $i < count($usersData); $i++)
        {
            $users[] = array(
                'id' => $usersData[$i]['id'],
                'name' => $usersData[$i]['name'],
                'email' => $usersData[$i]['email'],
                'password' => Hash::make('password'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            );
        }

        DB::table('users')->insert($users);
    }
}
