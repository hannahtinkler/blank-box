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
            'description' => 'An overview of servers running Mayden products, and details required to interact with them.',
            'order' => 1,
            'slug' => str_slug('Mayden Servers')
        ]);

        Chapter::create([
            'title' => 'Mayden Vagrant Boxes',
            'description' => 'An overview of the Mayden produced Vagrant boxes required to work on Mayden products.',
            'order' => 3,
            'slug' => str_slug('Mayden Vagrant Boxes')
        ]);

        Chapter::create([
            'title' => 'Mayden Monitoring',
            'description' => 'An overview of the monitoring systems used by Mayden, including Sensu, PCTI etc.',
            'order' => 2,
            'slug' => str_slug('Mayden Monitoring')
        ]);

        Chapter::create([
            'title' => 'Iaptus Services',
            'description' => 'Overview of the services subscribed with iaptus, including relevent details regarding them.',
            'order' => 3,
            'slug' => str_slug('Iaptus Services')
        ]);
    }
}
