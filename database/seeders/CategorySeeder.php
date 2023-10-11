<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\Foreach_;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
            'name' => 'Celulares y tablets',
            'slug' => Str::slug('Celulares y tablets'),
            'icon' => '<i class="fa-solid fa-mobile-screen-button"></i>',
            ],
            $categories = [
                'name' => 'TV, Audio y video',
                'slug' => Str::slug('TV, Audio y video'),
                'icon' => '<i class="fa-solid fa-tv"></i>'
            ],
            $categories = [
                'name' => 'Consola y videojuegos',
                'slug' => Str::slug('Consola y videojuegos'),
                'icon' => '<i class="fa-solid fa-gamepad"></i>'
            ],
            $categories = [
                'name' => 'Computacion',
                'slug' => Str::slug('Computacion'),
                'icon' => '<i class="fa-solid fa-laptop"></i>'
            ],
            $categories = [
                'name' => 'Moda',
                'slug' => Str::slug('Moda'),
                'icon' => '<i class="fa-solid fa-shirt"></i>'
            ],
        ];

        foreach ($categories as $category) {
            $category = Category::factory(1)->create($category)->first();

            $brands = Brand::factory(4)->create();

            foreach ($brands as $brand) {
                $brand->categories()->attach($category->id);
            }
        }
    }
}
