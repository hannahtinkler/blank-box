<?php

use Illuminate\Database\Seeder;

use App\Models\Page;
use App\Models\Badge;
use App\Models\FeedEvent;
use App\Models\FeedEventType;

class FeedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FeedEventType::truncate();
        FeedEvent::truncate();

        $pageFeedEvent = FeedEventType::create([
            'name' => 'Page Added',
            'text' => "%s added a new page to the '%s' chapter:<br /><br /><strong>'%s'</strong>"
        ]);

        $badgeFeedEvent = FeedEventType::create([
            'name' => 'Badge Earned',
            'text' => "%s just earned the <strong>'%s'</strong> badge!"
        ]);
    }
}
