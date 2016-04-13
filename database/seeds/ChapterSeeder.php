<?php

use Illuminate\Database\Seeder;
use App\Library\Models\Chapter;

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
            'title' => 'Mayden Servers',
            'order' => 1,
            'slug' => str_slug('Mayden Servers')
        ]);

        Chapter::create([
            'title' => 'Mayden Vagrant Boxes',
            'order' => 2,
            'slug' => str_slug('Mayden Vagrant Boxes')
        ]);

        Chapter::create([
            'title' => 'Iaptus Services',
            'order' => 3,
            'slug' => str_slug('Iaptus Services')
        ]);
    }
}
