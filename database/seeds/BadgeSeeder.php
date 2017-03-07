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
        $pagesSubmittedInChapter = BadgeType::create([
            'name' => 'Pages Submitted In Chapter',
            'metric' => 'pagesSubmittedInChapter',
            'description' => 'Earned for the number of pages submitted in one given chapter'
        ]);

        // $codeBadgeGroup = BadgeGroup::create([
        //     'badge_type_id' => $codeContributions->id,
        //     'name' => 'Vermillion City Gym',
        //     'description' => 'Earned for the number of pages submitted to the Monitoring chapter and approved',
        //     'metric_entity' => null
        // ]);

        // Badge::create([
        //     'badge_group_id' => $codeBadgeGroup->id,
        //     'name' => 'Peruser of Pichus',
        //     'description' => 'Earned by submitting 1 pull request to the Blank Box repository',
        //     'image' => '/images/badges/code_bronze.png',
        //     'level' => 1,
        //     'metric_boundary' => 1
        // ]);
    }
}
