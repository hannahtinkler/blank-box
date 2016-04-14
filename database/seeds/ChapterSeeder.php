<?php

use Illuminate\Database\Seeder;
use App\Library\Models\Chapter;
use App\Library\Models\Category;

class ChapterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mayden = Category::where('title', 'Mayden')->first();
        $iaptus = Category::where('title', 'Iaptus')->first();
        $iaptusIntegrations = Category::where('title', 'Iaptus Integrations')->first();

        Chapter::truncate();

        Chapter::create([
            'category_id' => $mayden->id,
            'title' => 'Servers',
            'description' => 'An overview of servers running Mayden products, and details required to interact with them.',
            'order' => 1,
            'slug' => str_slug('Servers')
        ]);

        Chapter::create([
            'category_id' => $mayden->id,
            'title' => 'Vagrant Boxes',
            'description' => 'An overview of the Mayden produced Vagrant boxes required to work on Mayden products.',
            'order' => 3,
            'slug' => str_slug('Vagrant Boxes')
        ]);

        Chapter::create([
            'category_id' => $mayden->id,
            'title' => 'Monitoring',
            'description' => 'An overview of the monitoring systems used by Mayden, including Sensu, PCTI etc.',
            'order' => 2,
            'slug' => str_slug('Monitoring')
        ]);

        Chapter::create([
            'category_id' => $iaptus->id,
            'title' => 'Services',
            'description' => 'Overview of the services subscribed with iaptus, including relevent details regarding them.',
            'order' => 3,
            'slug' => str_slug('Services')
        ]);
    }
}
