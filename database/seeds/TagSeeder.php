<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\Page;
use App\Models\PageTag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $serverDetails = Page::where('title', 'Server Details')->first();
        $serviceList = Page::where('title', 'Service List')->first();
        $sshConfigGenerator = Page::where('title', 'SSH Config Generator')->first();
        $creatingCaseManagers = Page::where('title', 'Creating Case Managers')->first();
        $puttingACarePathwayLive = Page::where('title', 'Putting a Care Pathway Live')->first();
        $signingExportsCertificates = Page::where('title', 'Signing Exports Certificates')->first();
        $typesOfAutomatedTests = Page::where('title', 'Types of Automated Tests')->first();
        $featuresOfValuableTests = Page::where('title', 'Features of Valuable Tests')->first();
        $codeReviewTestingChecklist = Page::where('title', 'Code Review Testing Checklist')->first();
        $whatKindofTestShouldIWrite = Page::where('title', '"What Kind of Test Should I Write?"')->first();
        $workingOnSupportTasks = Page::where('title', 'Working on Support Tasks')->first();
        $webformProcessDiagram = Page::where('title', 'Webform Process Diagram')->first();
        $serverNodeDiagram = Page::where('title', 'Server Node Diagram')->first();
        $sensuProcessDiagram = Page::where('title', 'Sensu Process Diagram')->first();
        $serverMapDiagram = Page::where('title', 'Server Map Diagram')->first();
        $iaptusDictionaryThesaurus = Page::where('title', 'iaptus Dictionary / Thesaurus')->first();
        
        Tag::truncate();
        PageTag::truncate();

        $serverTag = Tag::create([
            'tag' => 'server',
        ]);

        $servicesTag = Tag::create([
            'tag' => 'services',
        ]);

        $sshTag = Tag::create([
            'tag' => 'ssh',
        ]);

        $caseManagerTag = Tag::create([
            'tag' => 'case managers',
        ]);

        $carePathwayTag = Tag::create([
            'tag' => 'care pathway',
        ]);

        $goLiveTag = Tag::create([
            'tag' => 'go live',
        ]);

        $cpTag = Tag::create([
            'tag' => 'cp',
        ]);

        $exportsTag = Tag::create([
            'tag' => 'exports',
        ]);

        $caeTag = Tag::create([
            'tag' => 'CAE',
        ]);

        $certificatesTag = Tag::create([
            'tag' => 'certificates',
        ]);

        $testingTag = Tag::create([
            'tag' => 'testing',
        ]);

        $testsTag = Tag::create([
            'tag' => 'tests',
        ]);

        $reviewTag = Tag::create([
            'tag' => 'code review',
        ]);

        $bambooTag = Tag::create([
            'tag' => 'bamboo',
        ]);

        $jiraTag = Tag::create([
            'tag' => 'jira',
        ]);

        $webformsTag = Tag::create([
            'tag' => 'webforms',
        ]);

        $sensuTag = Tag::create([
            'tag' => 'sensu',
        ]);

        $supportTag = Tag::create([
            'tag' => 'support',
        ]);

        $mapTag = Tag::create([
            'tag' => 'map',
        ]);

        $iaptusTag = Tag::create([
            'tag' => 'iaptus',
        ]);
        
        PageTag::create([
            'tag_id' => $serverTag->id,
            'page_id' => $serverDetails->id,
        ]);
        
        PageTag::create([
            'tag_id' => $servicesTag->id,
            'page_id' => $serviceList->id,
        ]);
        
        PageTag::create([
            'tag_id' => $sshTag->id,
            'page_id' => $sshConfigGenerator->id,
        ]);
        
        PageTag::create([
            'tag_id' => $caseManagerTag->id,
            'page_id' => $creatingCaseManagers->id,
        ]);
        
        PageTag::create([
            'tag_id' => $cpTag->id,
            'page_id' => $puttingACarePathwayLive->id,
        ]);
        
        PageTag::create([
            'tag_id' => $carePathwayTag->id,
            'page_id' => $puttingACarePathwayLive->id,
        ]);
        
        PageTag::create([
            'tag_id' => $goLiveTag->id,
            'page_id' => $puttingACarePathwayLive->id,
        ]);
                
        PageTag::create([
            'tag_id' => $exportsTag->id,
            'page_id' => $signingExportsCertificates->id,
        ]);
                
        PageTag::create([
            'tag_id' => $caeTag->id,
            'page_id' => $signingExportsCertificates->id,
        ]);
        
        PageTag::create([
            'tag_id' => $certificatesTag->id,
            'page_id' => $signingExportsCertificates->id,
        ]);
        
        PageTag::create([
            'tag_id' => $testingTag->id,
            'page_id' => $typesOfAutomatedTests->id,
        ]);
        
        PageTag::create([
            'tag_id' => $testsTag->id,
            'page_id' => $typesOfAutomatedTests->id,
        ]);
        
        PageTag::create([
            'tag_id' => $bambooTag->id,
            'page_id' => $typesOfAutomatedTests->id,
        ]);
        
        PageTag::create([
            'tag_id' => $testingTag->id,
            'page_id' => $featuresOfValuableTests->id,
        ]);
        
        
        PageTag::create([
            'tag_id' => $testsTag->id,
            'page_id' => $featuresOfValuableTests->id,
        ]);
        
        PageTag::create([
            'tag_id' => $bambooTag->id,
            'page_id' => $featuresOfValuableTests->id,
        ]);
        
        PageTag::create([
            'tag_id' => $testingTag->id,
            'page_id' => $codeReviewTestingChecklist->id,
        ]);
              
        PageTag::create([
            'tag_id' => $testsTag->id,
            'page_id' => $codeReviewTestingChecklist->id,
        ]);
        
        PageTag::create([
            'tag_id' => $bambooTag->id,
            'page_id' => $codeReviewTestingChecklist->id,
        ]);
        
        PageTag::create([
            'tag_id' => $testingTag->id,
            'page_id' => $whatKindofTestShouldIWrite->id,
        ]);
              
        PageTag::create([
            'tag_id' => $testsTag->id,
            'page_id' => $whatKindofTestShouldIWrite->id,
        ]);
        
        PageTag::create([
            'tag_id' => $bambooTag->id,
            'page_id' => $whatKindofTestShouldIWrite->id,
        ]);
        
        PageTag::create([
            'tag_id' => $supportTag->id,
            'page_id' => $workingOnSupportTasks->id,
        ]);
        
        PageTag::create([
            'tag_id' => $webformsTag->id,
            'page_id' => $webformProcessDiagram->id,
        ]);
        
        PageTag::create([
            'tag_id' => $sensuTag->id,
            'page_id' => $sensuProcessDiagram->id,
        ]);
        
        PageTag::create([
            'tag_id' => $mapTag->id,
            'page_id' => $serverMapDiagram->id,
        ]);
        
        PageTag::create([
            'tag_id' => $serverTag->id,
            'page_id' => $serverMapDiagram->id,
        ]);
        
        PageTag::create([
            'tag_id' => $iaptusTag->id,
            'page_id' => $iaptusDictionaryThesaurus->id,
        ]);

    }
}
