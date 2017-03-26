<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

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
            'title' => 'General',
            'description' => 'General chapters go here.',
            'slug' => str_slug('General'),
            'order' => 1
        ]);
    }
}
