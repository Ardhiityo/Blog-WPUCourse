<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            [
                'name' => 'web development',
                'slug' => 'web-development'
            ],
            [
                'name' => 'artificial intelligent',
                'slug' => 'artificial-intelligent'
            ],
            [
                'name' => 'mobile development',
                'slug' => 'mobile-development'
            ]
        ]);
    }
}
