<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoryTableSeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'DC'
        ]);
        Category::create([
            'name' => 'MARVEL'
        ]);
        Category::create([
            'name' => 'DISNEY'
        ]);
        Category::create([
            'name' => 'SONY'
        ]);
    }
}
