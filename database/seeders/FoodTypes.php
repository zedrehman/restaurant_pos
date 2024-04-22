<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FoodType;

class FoodTypes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['type' => 'Veg'],
            ['type' => 'Non Veg'],
            ['type' => 'Eggetarian'],
            ['type' => 'Not Speccified']
        ];
        FoodType::insert($data);
    }
}
