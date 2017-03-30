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
            'order' => 1,
            'created_at' => "2017-03-26 17:47:11",
            'updated_at' => "2017-03-26 17:47:11",  
        ]);
    }
}
