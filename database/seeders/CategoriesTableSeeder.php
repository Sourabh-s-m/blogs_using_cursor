<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Technology',
            'Travel',
            'Food',
            'Lifestyle'
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category], // criteria for finding existing record
                ['name' => $category]  // data to update or create
            );
        }
    }
}
