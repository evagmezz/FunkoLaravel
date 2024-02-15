<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Funko;
use Illuminate\Database\Seeder;

class FunkoTableSeeder extends Seeder
{
    public function run(): void
    {

        Funko::create([
            'name' => 'Batman',
            'price' => 30,
            'stock' => 10,
            'image' => 'batman.png',
            'category_id' => Category::where('name', 'DC')->first()->id,
            'is_deleted' => false
        ]);

        Funko::create([
            'name' => 'Merida',
            'price' => 30,
            'stock' => 10,
            'image' => 'merida.jpg',
            'category_id' => Category::where('name', 'DISNEY')->first()->id,
            'is_deleted' => false
        ]);

        Funko::create([
            'name' => 'Spiderman',
            'price' => 30,
            'stock' => 10,
            'image' => 'spiderman.jpg',
            'category_id' => Category::where('name', 'MARVEL')->first()->id,
            'is_deleted' => false
        ]);
    }
}
