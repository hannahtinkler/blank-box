<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\BadgeGroup::truncate();
        App\Models\BadgeType::truncate();
        App\Models\Badge::truncate();
        App\Models\Bookmark::truncate();
        App\Models\Category::truncate();
        App\Models\Chapter::truncate();
        App\Models\Contributor::truncate();
        App\Models\FeedEventType::truncate();
        App\Models\FeedEvent::truncate();
        App\Models\PageDraft::truncate();
        App\Models\PageTag::truncate();
        App\Models\Page::truncate();
        App\Models\SlugForwardingSetting::truncate();
        App\Models\SuggestedEdit::truncate();
        App\Models\Tag::truncate();
        App\Models\UserBadge::truncate();
        App\Models\User::truncate();

        $this->call(CategorySeeder::class);
        $this->call(BadgeSeeder::class);
        $this->call(FeedSeeder::class);
    }
}
