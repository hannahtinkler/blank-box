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
        Badge::truncate();

        BadgeType::create([
            'name' => 'Pages Submitted',
            'metric' => 'pagesSubmitted',
            'description' => 'Earned for the number of pages submitted',
        ]);
        
        BadgeType::create([
            'name' => 'Pages Edited',
            'metric' => 'pagesEdited',
            'description' => 'Earned for the number of pages submitted',
        ]);

        Badge::create([
            'badge_type_id' => '1',
            'name' => 'Rank 1',
            'description' => 'Earned by submitting 1 page',
            'image' => '/images/badges/code_bronze.png',
            'level' => '1',
            'metric_boundary' => '1',
            'created_at' => '2016-09-30 14:47:33',
            'updated_at' => '2016-09-30 14:47:33',
        ]);

        Badge::create([
            'badge_type_id' => '1',
            'name' => 'Rank 2',
            'description' => 'Earned by submitting 10 pages',
            'image' => '/images/badges/code_silver.png',
            'level' => '2',
            'metric_boundary' => '10',
            'created_at' => '2016-09-30 14:47:33',
            'updated_at' => '2016-09-30 14:47:33',
        ]);

        Badge::create([
            'badge_type_id' => '1',
            'name' => 'Rank 3',
            'description' => 'Earned by submitting 30 pages',
            'image' => '/images/badges/code_gold.png',
            'level' => '3',
            'metric_boundary' => '30',
            'created_at' => '2016-09-30 14:47:33',
            'updated_at' => '2016-09-30 14:47:33',
        ]);

        Badge::create([
            'badge_type_id' => '1',
            'name' => 'Rank 4',
            'description' => 'Earned by submitting 50 pages',
            'image' => '/images/badges/code_platinum.png',
            'level' => '4',
            'metric_boundary' => '50',
            'created_at' => '2016-09-30 14:47:33',
            'updated_at' => '2016-09-30 14:47:33',
        ]);

        Badge::create([
            'badge_type_id' => '2',
            'name' => 'Rank 1',
            'description' => 'Earned by editing 1 page',
            'image' => '/images/badges/code_bronze.png',
            'level' => '1',
            'metric_boundary' => '1',
            'created_at' => '2016-09-30 14:47:33',
            'updated_at' => '2016-09-30 14:47:33',
        ]);

        Badge::create([
            'badge_type_id' => '2',
            'name' => 'Rank 2',
            'description' => 'Earned by editing 10 pages',
            'image' => '/images/badges/code_silver.png',
            'level' => '2',
            'metric_boundary' => '10',
            'created_at' => '2016-09-30 14:47:33',
            'updated_at' => '2016-09-30 14:47:33',
        ]);

        Badge::create([
            'badge_type_id' => '2',
            'name' => 'Rank 3',
            'description' => 'Earned by editing 30 pages',
            'image' => '/images/badges/code_gold.png',
            'level' => '3',
            'metric_boundary' => '30',
            'created_at' => '2016-09-30 14:47:33',
            'updated_at' => '2016-09-30 14:47:33',
        ]);

        Badge::create([
            'badge_type_id' => '2',
            'name' => 'Rank 4',
            'description' => 'Earned by editing 50 pages',
            'image' => '/images/badges/code_platinum.png',
            'level' => '4',
            'metric_boundary' => '50',
            'created_at' => '2016-09-30 14:47:33',
            'updated_at' => '2016-09-30 14:47:33'
        ]);
    }
}
