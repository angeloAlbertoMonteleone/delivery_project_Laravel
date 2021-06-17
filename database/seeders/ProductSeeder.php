<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Str;
use App\Models\Backoffice\Product;
use App\Models\Backoffice\ProductCategory;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $products = [
            ['title' => 'Pizza Margherita', 'description' => 'Lorem ipsum dolor sit amet.', 'slug' => Str::slug('Pizza Margherita'), 'visible' => true, 'price' => 9],
            ['title' => 'Pizza Capricciosa', 'description' => 'Lorem ipsum dolor sit amet.', 'slug' => Str::slug('Pizza Capricciosa'), 'visible' => false, 'price' => 10],
            ['title' => 'Pizza Viennese', 'description' => 'Lorem ipsum dolor sit amet.', 'slug' => Str::slug('Pizza Viennese'), 'visible' => false, 'price' => 9],
            ['title' => 'Pizza Diavola', 'description' => 'Lorem ipsum dolor sit amet.', 'slug' => Str::slug('Pizza Diavola'), 'visible' => true, 'price' => 7],
            ['title' => 'Pizza 4 formaggi', 'description' => 'Lorem ipsum dolor sit amet.', 'slug' => Str::slug('Pizza 4 formaggi'), 'visible' => true, 'price' => 12],
            ['title' => 'Pizza tonno e cipolla', 'description' => 'Lorem ipsum dolor sit amet.', 'slug' => Str::slug('Pizza tonno e cipolla'), 'visible' => true, 'price' => 13],
            ['title' => 'Pizza tonno e olive', 'description' => 'Lorem ipsum dolor sit amet.', 'slug' => Str::slug('Pizza tonno e olive'), 'visible' => true, 'price' => 9],
            ['title' => 'Pizza salsiccia', 'description' => 'Lorem ipsum dolor sit amet.', 'slug' => Str::slug('Pizza salsiccia'), 'visible' => true, 'price' => 8],
        ];


        $productCategory = ProductCategory::find(1);

        foreach ($products as $product) {
          $model = new Product($product);

          $model->productCategory()->associate($productCategory);
          $model->save();
        }
    }
}
