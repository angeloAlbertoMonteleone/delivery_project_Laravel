<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Backoffice\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
              ['title' => 'Pizze', 'description' => 'Lorem ipsum dolor sit amet.', 'slug' => Str::slug('Pizze'), 'visible' => true],
          ];

        foreach ($categories as $category) {
          $category = ProductCategory::create($category);
        }
    }
}
