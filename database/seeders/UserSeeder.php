<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(3)->create();

        User::factory()->create([
            'email' => 'aryaadi229@gmail.com',
            'username' => 'arya',
            'name' => 'Arya',
            'password' => '11111111'
        ]);
    }
}
