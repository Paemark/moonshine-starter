<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Technology', 'description' => 'Latest tech news and tutorials'],
            ['name' => 'Business', 'description' => 'Business strategies and insights'],
            ['name' => 'Lifestyle', 'description' => 'Health, wellness, and lifestyle tips'],
            ['name' => 'Education', 'description' => 'Learning resources and educational content'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['slug' => Str::slug($category['name'])],
                [
                    'name' => $category['name'],
                    'description' => $category['description'],
                ]
            );
        }
    }
}
