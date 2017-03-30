<?php

use Illuminate\Database\Seeder;
use App\Models\Chapter;

class ChapterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Chapter::truncate();

        Chapter::create([
            'title' => 'Sample',
            'category_id' => 1,
            'description' => 'Sample pages go here.',
            'slug' => str_slug('Sample'),
            'order' => 1
        ]);
    }
}
