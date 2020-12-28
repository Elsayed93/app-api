<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
        // \App\Models\User::factory(10)->create();
        $array = [
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789')
        ];
        \App\Models\User::create($array);
    }
}
