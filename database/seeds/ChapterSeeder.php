<?php

use Illuminate\Database\Seeder;
use App\Models\Chapter;
use App\Models\Category;

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
            'order' => 2,
            'slug' => str_slug('Servers')
        ]);

        Chapter::create([
            'category_id' => $mayden->id,
            'title' => 'Workflows',
            'description' => 'Workflows for the various parts/actions of Mayden',
            'order' => 3,
            'slug' => str_slug('Workflows')
        ]);

        Chapter::create([
            'category_id' => $mayden->id,
            'title' => 'Testing',
            'description' => 'An overview of the how to test Mayden products as a developer.',
            'order' => 4,
            'slug' => str_slug('Testing')
        ]);

        Chapter::create([
            'category_id' => $mayden->id,
            'title' => 'Monitoring',
            'description' => 'An overview of the monitoring systems used by Mayden, including Sensu, PCTI etc.',
            'order' => 5,
            'slug' => str_slug('Monitoring')
        ]);

        Chapter::create([
            'category_id' => $iaptus->id,
            'title' => 'General Information',
            'description' => 'General resources that would be helpful for all iaptus developers to know.',
            'order' => 1,
            'slug' => str_slug('General Information')
        ]);


        Chapter::create([
            'category_id' => $iaptus->id,
            'title' => 'Services',
            'description' => 'Overview of the services subscribed with iaptus, including relevent details regarding them.',
            'order' => 2,
            'slug' => str_slug('Services')
        ]);

        Chapter::create([
            'category_id' => $iaptus->id,
            'title' => 'Support How-Tos',
            'description' => 'Guides for completing tasks that often come up during developer support time.',
            'order' => 3,
            'slug' => str_slug('Support How-Tos')
        ]);

        Chapter::create([
            'category_id' => $iaptusIntegrations->id,
            'title' => 'Prism',
            'description' => 'Prism is used to send and receive clinical contacts to/from online providers.',
            'order' => 4,
            'slug' => str_slug('Prism')
        ]);

        Chapter::create([
            'category_id' => $iaptusIntegrations->id,
            'title' => 'ITK',
            'description' => 'ITK is used to look up NHS numbers based on personal info, and personal info based on NHS numbers.',
            'order' => 1,
            'slug' => str_slug('ITK')
        ]);

        Chapter::create([
            'category_id' => $iaptusIntegrations->id,
            'title' => 'Mikkom',
            'description' => 'Mikkom is used to allow patients to self refer into IAPT care',
            'order' => 3,
            'slug' => str_slug('Mikkom')
        ]);

        Chapter::create([
            'category_id' => $iaptusIntegrations->id,
            'title' => 'SMS',
            'description' => 'The iaptus SMS system is used to allow services to communicate via text messaging with their patients through iaptus',
            'order' => 5,
            'slug' => str_slug('SMS')
        ]);

        Chapter::create([
            'category_id' => $iaptusIntegrations->id,
            'title' => 'MIG and PCTI',
            'description' => 'MIG and PCTI are used to allow services to send electronic letters to patients via their GP practices',
            'order' => 2,
            'slug' => str_slug('MIG and PCTI')
        ]);

        Chapter::create([
            'category_id' => $iaptusIntegrations->id,
            'title' => 'Webforms',
            'description' => 'The Mayden Webforms system allows services to customise forms hey require patients to fill in online and pull the data into iaptus',
            'order' => 6,
            'slug' => str_slug('Webforms')
        ]);
    }
}
