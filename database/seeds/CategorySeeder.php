<?php

use Illuminate\Database\Seeder;
use App\Library\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();

        Category::create([
            'title' => 'Mayden',
            'description' => 'Chapters involving the company as a whole and its resources.',
            'slug' => str_slug('Mayden'),
            'order' => 1
        ]);

        Category::create([
            'title' => 'Iaptus',
            'description' => 'Chapters involving iaptus in general.',
            'slug' => str_slug('iaptus'),
            'order' => 2
        ]);

        Category::create([
            'title' => 'Iaptus Integrations',
            'description' => 'Chapters involving external services that integrate with iaptus like APIs, monitoring etc',
            'slug' => str_slug('Iaptus Integrations'),
            'order' => 3
        ]);

    }
}
