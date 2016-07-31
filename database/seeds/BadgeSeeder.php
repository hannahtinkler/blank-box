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
        $supportChapter = Chapter::where('title', 'Support How-Tos')->first();
        $servicesChapter = Chapter::where('title', 'Services')->first();
        $generalChapter = Chapter::where('title', 'General Information')->first();
        $workflowsChapter = Chapter::where('title', 'Workflows')->first();
        $testingChapter = Chapter::where('title', 'Testing')->first();
        $monitoringChapter = Chapter::where('title', 'Monitoring')->first();


        $pagesSubmittedInChapter = BadgeType::create([
            'name' => 'Pages Submitted In Chapter',
            'metric' => 'pagesSubmittedInChapter',
            'description' => 'Earned for the number of pages submitted in one given chapter'
        ]);

        $codeContributions = BadgeType::create([
            'name' => 'Code Contributions to Black Box',
            'metric' => 'codeContributions',
            'description' => 'Earned for the number of pull requests submitted to the Black Box repository'
        ]);

        $codeBadgeGroup = BadgeGroup::create([
            'badge_type_id' => $codeContributions->id,
            'name' => 'Vermillion City Gym',
            'description' => 'Earned for the number of pages submitted to the Monitoring chapter and approved',
            'metric_entity' => null
        ]);

        $serverBadgeGroup = BadgeGroup::create([
            'badge_type_id' => $pagesSubmittedInChapter->id,
            'name' => 'Faith of the Server',
            'description' => 'Earned for the number of pages submitted to the Servers chapter and approved',
            'metric_entity' => $serverChapter->id
        ]);

        $supportBadgeGroup = BadgeGroup::create([
            'badge_type_id' => $pagesSubmittedInChapter->id,
            'name' => 'Support Squad',
            'description' => 'Earned for the number of pages submitted to the Support chapter and approved',
            'metric_entity' => $supportChapter->id
        ]);

        $servicesBadgeGroup = BadgeGroup::create([
            'badge_type_id' => $pagesSubmittedInChapter->id,
            'name' => 'In Service of the Services',
            'description' => 'Earned for the number of pages submitted to the Services chapter and approved',
            'metric_entity' => $servicesChapter->id
        ]);

        $workflowsBadgeGroup = BadgeGroup::create([
            'badge_type_id' => $pagesSubmittedInChapter->id,
            'name' => 'Workflow Wizard',
            'description' => 'Earned for the number of pages submitted to the Workflows chapter and approved',
            'metric_entity' => $workflowsChapter->id
        ]);

        $testingBadgeGroup = BadgeGroup::create([
            'badge_type_id' => $pagesSubmittedInChapter->id,
            'name' => 'Secret Society of Testers',
            'description' => 'Earned for the number of pages submitted to the Testing chapter and approved',
            'metric_entity' => $testingChapter->id
        ]);

        $generalBadgeGroup = BadgeGroup::create([
            'badge_type_id' => $pagesSubmittedInChapter->id,
            'name' => 'Faculty of Hogwarts',
            'description' => 'Earned for the number of pages submitted to the General Information chapter and approved',
            'metric_entity' => $generalChapter->id
        ]);

        $monitoringBadgeGroup = BadgeGroup::create([
            'badge_type_id' => $pagesSubmittedInChapter->id,
            'name' => 'The Watchmen',
            'description' => 'Earned for the number of pages submitted to the Monitoring chapter and approved',
            'metric_entity' => $monitoringChapter->id
        ]);

        Badge::create([
            'badge_group_id' => $codeBadgeGroup->id,
            'name' => 'Pichu',
            'description' => 'Earned by submitting 1 pull request to the Black Box repository',
            'image' => '/images/badges/code_bronze.png',
            'level' => 1,
            'metric_boundary' => 1
        ]);

        Badge::create([
            'badge_group_id' => $codeBadgeGroup->id,
            'name' => 'Jolteon',
            'description' => 'Earned by submitting 5 pull request to the Black Box repository',
            'image' => '/images/badges/code_silver.png',
            'level' => 2,
            'metric_boundary' => 5
        ]);

        Badge::create([
            'badge_group_id' => $codeBadgeGroup->id,
            'name' => 'Electrode',
            'description' => 'Earned by submitting 10 pull request to the Black Box repository',
            'image' => '/images/badges/code_gold.png',
            'level' => 3,
            'metric_boundary' => 10
        ]);

        Badge::create([
            'badge_group_id' => $codeBadgeGroup->id,
            'name' => 'Zapdos',
            'description' => 'Earned by submitting 15 pull request to the Black Box repository',
            'image' => '/images/badges/code_platinum.png',
            'level' => 4,
            'metric_boundary' => 15
        ]);

        Badge::create([
            'badge_group_id' => $serverBadgeGroup->id,
            'name' => 'Brethren of the Server',
            'description' => 'Earned by submitting 1 pages to the Servers chapter',
            'image' => '/images/badges/server_bronze.png',
            'level' => 1,
            'metric_boundary' => 1
        ]);

        Badge::create([
            'badge_group_id' => $serverBadgeGroup->id,
            'name' => 'Faith Militant of the Server',
            'description' => 'Earned by submitting 5 pages to the Servers chapter',
            'image' => '/images/badges/server_silver.png',
            'level' => 2,
            'metric_boundary' => 5
        ]);

        Badge::create([
            'badge_group_id' => $serverBadgeGroup->id,
            'name' => 'Septon of the Server',
            'description' => 'Earned by submitting 10 pages to the Servers chapter',
            'image' => '/images/badges/server_gold.png',
            'level' => 3,
            'metric_boundary' => 10
        ]);

        Badge::create([
            'badge_group_id' => $serverBadgeGroup->id,
            'name' => 'High Septon of the Server',
            'description' => 'Earned by submitting 15 pages to the Servers chapter',
            'image' => '/images/badges/server_platinum.png',
            'level' => 4,
            'metric_boundary' => 15
        ]);

        Badge::create([
            'badge_group_id' => $supportBadgeGroup->id,
            'name' => 'Support Sidekick',
            'description' => 'Earned by submitting 1 pages to the Support chapter',
            'image' => '/images/badges/support_bronze.png',
            'level' => 1,
            'metric_boundary' => 1
        ]);

        Badge::create([
            'badge_group_id' => $supportBadgeGroup->id,
            'name' => 'Support Maverick',
            'description' => 'Earned by submitting 5 pages to the Support chapter',
            'image' => '/images/badges/support_silver.png',
            'level' => 2,
            'metric_boundary' => 5
        ]);

        Badge::create([
            'badge_group_id' => $supportBadgeGroup->id,
            'name' => 'Support Champion',
            'description' => 'Earned by submitting 10 pages to the Support chapter',
            'image' => '/images/badges/support_gold.png',
            'level' => 3,
            'metric_boundary' => 10
        ]);

        Badge::create([
            'badge_group_id' => $supportBadgeGroup->id,
            'name' => 'Support Superhero',
            'description' => 'Earned by submitting 15 pages to the Support chapter',
            'image' => '/images/badges/support_platinum.png',
            'level' => 4,
            'metric_boundary' => 15
        ]);

        Badge::create([
            'badge_group_id' => $servicesBadgeGroup->id,
            'name' => 'Steward to the Services',
            'description' => 'Earned by submitting 1 pages to the Services chapter',
            'image' => '/images/badges/services_bronze.png',
            'level' => 1,
            'metric_boundary' => 1
        ]);

        Badge::create([
            'badge_group_id' => $servicesBadgeGroup->id,
            'name' => 'Butler to the Services',
            'description' => 'Earned by submitting 5 pages to the Services chapter',
            'image' => '/images/badges/services_silver.png',
            'level' => 2,
            'metric_boundary' => 5
        ]);

        Badge::create([
            'badge_group_id' => $servicesBadgeGroup->id,
            'name' => 'Footman to the Services',
            'description' => 'Earned by submitting 10 pages to the Services chapter',
            'image' => '/images/badges/services_gold.png',
            'level' => 3,
            'metric_boundary' => 10
        ]);

        Badge::create([
            'badge_group_id' => $servicesBadgeGroup->id,
            'name' => 'Grounds Keeper to the Services',
            'description' => 'Earned by submitting 15 pages to the Services chapter',
            'image' => '/images/badges/services_platinum.png',
            'level' => 4,
            'metric_boundary' => 15
        ]);

        Badge::create([
            'badge_group_id' => $generalBadgeGroup->id,
            'name' => 'First Year Student',
            'description' => 'Earned by submitting 1 pages to the General Information chapter',
            'image' => '/images/badges/general_bronze.png',
            'level' => 1,
            'metric_boundary' => 1
        ]);

        Badge::create([
            'badge_group_id' => $generalBadgeGroup->id,
            'name' => 'Keeper of the Keys & Grounds',
            'description' => 'Earned by submitting 5 pages to the General Information chapter',
            'image' => '/images/badges/general_silver.png',
            'level' => 2,
            'metric_boundary' => 5
        ]);

        Badge::create([
            'badge_group_id' => $generalBadgeGroup->id,
            'name' => 'Professor of Muggle Studies',
            'description' => 'Earned by submitting 10 pages to the General Information chapter',
            'image' => '/images/badges/general_gold.png',
            'level' => 3,
            'metric_boundary' => 10
        ]);

        Badge::create([
            'badge_group_id' => $generalBadgeGroup->id,
            'name' => 'Headmaster of Hogwarts',
            'description' => 'Earned by submitting 15 pages to the General Information chapter',
            'image' => '/images/badges/general_platinum.png',
            'level' => 4,
            'metric_boundary' => 15
        ]);

        Badge::create([
            'badge_group_id' => $workflowsBadgeGroup->id,
            'name' => 'Neophyte of the Workflows',
            'description' => 'Earned by submitting 1 pages to the Workflows chapter',
            'image' => '/images/badges/workflows_bronze.png',
            'level' => 1,
            'metric_boundary' => 1
        ]);

        Badge::create([
            'badge_group_id' => $workflowsBadgeGroup->id,
            'name' => 'Apprentice of the Workflows',
            'description' => 'Earned by submitting 5 pages to the Workflows chapter',
            'image' => '/images/badges/workflows_silver.png',
            'level' => 2,
            'metric_boundary' => 5
        ]);

        Badge::create([
            'badge_group_id' => $workflowsBadgeGroup->id,
            'name' => 'Journeyman of the Workflows',
            'description' => 'Earned by submitting 10 pages to the Workflows chapter',
            'image' => '/images/badges/workflows_gold.png',
            'level' => 3,
            'metric_boundary' => 10
        ]);

        Badge::create([
            'badge_group_id' => $workflowsBadgeGroup->id,
            'name' => 'Master of the Workflows',
            'description' => 'Earned by submitting 15 pages to the Workflows chapter',
            'image' => '/images/badges/workflows_platinum.png',
            'level' => 4,
            'metric_boundary' => 15
        ]);

        Badge::create([
            'badge_group_id' => $testingBadgeGroup->id,
            'name' => 'Steward of the SST',
            'description' => 'Earned by submitting 1 pages to the Testing chapter',
            'image' => '/images/badges/testing_bronze.png',
            'level' => 1,
            'metric_boundary' => 1
        ]);

        Badge::create([
            'badge_group_id' => $testingBadgeGroup->id,
            'name' => 'Deacon of the SST',
            'description' => 'Earned by submitting 5 pages to the Testing chapter',
            'image' => '/images/badges/testing_silver.png',
            'level' => 2,
            'metric_boundary' => 5
        ]);

        Badge::create([
            'badge_group_id' => $testingBadgeGroup->id,
            'name' => 'Warden of the SST',
            'description' => 'Earned by submitting 10 pages to the Testing chapter',
            'image' => '/images/badges/testing_gold.png',
            'level' => 3,
            'metric_boundary' => 10
        ]);

        Badge::create([
            'badge_group_id' => $testingBadgeGroup->id,
            'name' => 'Worshipful Master of the SST',
            'description' => 'Earned by submitting 15 pages to the Testing chapter',
            'image' => '/images/badges/testing_platinum.png',
            'level' => 4,
            'metric_boundary' => 15
        ]);

        Badge::create([
            'badge_group_id' => $monitoringBadgeGroup->id,
            'name' => 'The Comedian',
            'description' => 'Earned by submitting 1 pages to the Monitoring chapter',
            'image' => '/images/badges/monitoring_bronze.png',
            'level' => 1,
            'metric_boundary' => 1
        ]);

        Badge::create([
            'badge_group_id' => $monitoringBadgeGroup->id,
            'name' => 'Dr Manhattan',
            'description' => 'Earned by submitting 5 pages to the Monitoring chapter',
            'image' => '/images/badges/monitoring_silver.png',
            'level' => 2,
            'metric_boundary' => 5
        ]);

        Badge::create([
            'badge_group_id' => $monitoringBadgeGroup->id,
            'name' => 'Nite Owl',
            'description' => 'Earned by submitting 10 pages to the Monitoring chapter',
            'image' => '/images/badges/monitoring_gold.png',
            'level' => 3,
            'metric_boundary' => 10
        ]);

        Badge::create([
            'badge_group_id' => $monitoringBadgeGroup->id,
            'name' => 'Silk Spectre',
            'description' => 'Earned by submitting 15 pages to the Monitoring chapter',
            'image' => '/images/badges/monitoring_platinum.png',
            'level' => 4,
            'metric_boundary' => 15
        ]);
    }
}
