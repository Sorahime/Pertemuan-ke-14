<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Item;

class ItemSeeder extends Seeder
{
    public function run()
    {
        Item::create([
            'name' => 'Mikroskop',
            'description' => 'Alat melihat objek kecil',
            'stock' => 5,
            'category_id' => 3
        ]);
    }
}

