<?php

use Illuminate\Database\Seeder;
use App\Models\BadgeType;
use App\Models\BadgeGroup;
use App\Models\Badge;
use App\Models\UserBadge;
use App\Models\Chapter;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BadgeType::truncate();
        BadgeGroup::truncate();
        Badge::truncate();
        UserBadge::truncate();

        $serverChapter = Chapter::where('title', 'Servers')->first();


        $pagesSubmittedInChapter = BadgeType::create([
            'name' => 'Pages Submitted In Chapter',
            'metric' => 'pagesSubmittedInChapter',
            'description' => 'Awarded based on the number of pages submitted in one given chapter'
        ]);

        $badgeGroup = BadgeGroup::create([
            'badge_type_id' => $pagesSubmittedInChapter->id,
            'name' => 'Faith of the Server',
            'description' => 'Awarded on based on the number of pages submitted to the Servers chapter and approved',
            'metric_entity' => $serverChapter->id
        ]);

        Badge::create([
            'badge_group_id' => $badgeGroup->id,
            'name' => 'Brethren of the Server',
            'description' => 'Awarded on submitting 1 pages to the Server chapter',
            'level' => 1,
            'metric_boundary' => 1
        ]);

        Badge::create([
            'badge_group_id' => $badgeGroup->id,
            'name' => 'Faith Militant of the Server',
            'description' => 'Awarded on submitting 5 pages to the Server chapter',
            'level' => 2,
            'metric_boundary' => 5
        ]);

        Badge::create([
            'badge_group_id' => $badgeGroup->id,
            'name' => 'Septon of the Server',
            'description' => 'Awarded on submitting 10 pages to the Server chapter',
            'level' => 3,
            'metric_boundary' => 10
        ]);

        Badge::create([
            'badge_group_id' => $badgeGroup->id,
            'name' => 'High Septon of the Server',
            'description' => 'Awarded on submitting 15 pages to the Server chapter',
            'level' => 4,
            'metric_boundary' => 15
        ]);
    }
}
