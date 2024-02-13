<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Funko;
use Illuminate\Database\Seeder;

class FunkoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void

    {
        $DC = Category::where('name', 'DC')->first();
        $MARVEL = Category::where('name', 'MARVEL')->first();
        $DISNEY = Category::where('name', 'DISNEY')->first();

        Funko::create([
            'name' => 'Batman',
            'price' => 30,
            'stock' => 10,
            'image' => asset('storage/app/public/funko/batman.png'),
            'category_id' => $DC->id,
            'is_deleted' => false
        ]);

        Funko::create([
            'name' => 'Merida',
            'price' => 30,
            'stock' => 10,
            'image' => asset('storage/app/public/funko/merida.jpg'),
            'category_id' => $DISNEY->id,
            'is_deleted' => false
        ]);

        Funko::create([
            'name' => 'Spiderman',
            'price' => 30,
            'stock' => 10,
            'image' => asset('storage/app/public/funko/spiderman.jpg'),
            'category_id' => $MARVEL->id,
            'is_deleted' => false
        ]);
    }
}
