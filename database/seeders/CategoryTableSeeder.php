<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'uuid' => Str::uuid(),
            'name' => 'DC'
        ]);
        Category::create([
            'uuid' => Str::uuid(),
            'name' => 'MARVEL'
        ]);
        Category::create([
            'uuid' => Str::uuid(),
            'name' => 'DISNEY'
        ]);
    }
}
