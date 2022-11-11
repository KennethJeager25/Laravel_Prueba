<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\user;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'kenneth',
            'email' => 'kenneth25@gmail.com',
            'password' => bcrypt('123456'),
            'rol_id' => 1,
        ]);
    }
}
