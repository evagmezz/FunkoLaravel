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
            'price' => 37,
            'stock' => 40,
            'image' => 'batman.png',
            'category_id' => Category::where('name', 'DC')->first()->id,
            'is_deleted' => false
        ]);

        Funko::create([
            'name' => 'Merida',
            'price' => 27,
            'stock' => 50,
            'image' => 'merida.png',
            'category_id' => Category::where('name', 'DISNEY')->first()->id,
            'is_deleted' => false
        ]);

        Funko::create([
            'name' => 'Spiderman',
            'price' => 40,
            'stock' => 56,
            'image' => 'spiderman.jpg',
            'category_id' => Category::where('name', 'MARVEL')->first()->id,
            'is_deleted' => false
        ]);

        Funko::create([
            'name' => 'Ironman',
            'price' => 46,
            'stock' => 80,
            'image' => 'ironmaan.png',
            'category_id' => Category::where('name', 'MARVEL')->first()->id,
            'is_deleted' => false
        ]);

        Funko::create([
            'name' => 'Miercoles Addams',
            'price' => 35,
            'stock' => 40,
            'image' => 'miercolesAddams.png',
            'category_id' => Category::where('name', 'DISNEY')->first()->id,
            'is_deleted' => false
        ]);

        Funko::create([
            'name' => 'PIKACHU',
            'price' => 30,
            'stock' => 60,
            'image' => 'pikachu.jpg',
            'category_id' => Category::where('name', 'SONY')->first()->id,
            'is_deleted' => false
        ]);
    }
}
