<?php

use App\Models\Tag;
use App\Models\Page;
use App\Models\PageTag;
use App\Services\ControllerServices\PageTagControllerService;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PageTagControllerServiceTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * The current user being worked on behalf of in the test
     * @var object User
     */
    private $user;

    /**
     * An instance of the PageTagControllerService class under test
     * @var object
     */
    private $controllerService;

    /**
     * An array of fields which should be used for comparison purposes when
     * using assertEquals()
     *
     * @var array
     */
    public $comparableFields = array(
        'tag_id',
        'page_id'
    );

    /**
     * Runs the parent setUp operations and then creates and new user.
     * Instantiates an instance of the PageTagControllerService class under test
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->user = factory(App\Models\User::class)->create();

        $prophet = new Prophecy\Prophet;
        $prophecy = $prophet->prophesize('Illuminate\Http\Request');
        $prophecy->user()->willReturn($this->user);

        $this->controllerService = new PageTagControllerService($prophecy->reveal());
    }

    public function testItCanStoreTagsForAPage()
    {
        $page = factory(App\Models\Page::class)->create();

        $this->controllerService->storeTagsForAPage(
            $page,
            [
                'tag1',
                'tag2'
            ]
        );

        $pageTags = $page->pageTags;
        $this->assertCount(2, $pageTags);
        
        $tag = $page->pageTags->first()->page;
        $this->assertTrue($page instanceof Page);
    }

    public function testItCanStoreTagsThatDontExistAndReturnTagIds()
    {
        $tag1 = factory(App\Models\Tag::class)->create(['tag' => 'tag1']);

        $tags = [
            'tag1',
            'tag2',
            'tag3',
            'tag4',
            'tag5'
        ];

        $actual = $this->controllerService->storeTagsThatDontExistAndReturnTagIds($tags);
        $expected = [
            0 => $tag1->id + 0,
            1 => $tag1->id + 1,
            2 => $tag1->id + 2,
            3 => $tag1->id + 3,
            4 => $tag1->id + 4
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testItCanStoreANewTag()
    {
        $tag = $this->controllerService->storeANewTag('taggy');

        $lookup = Tag::where('tag', 'taggy')->get();
        $this->assertTrue(is_object($lookup));
    }

    public function testItCanRemoveDeletedPageTags()
    {
        $page = factory(App\Models\Page::class)->create();
        
        $tag1 = factory(App\Models\Tag::class)->create();
        $tag2 = factory(App\Models\Tag::class)->create();
        $tag3 = factory(App\Models\Tag::class)->create();

        $pageTag1 = factory(App\Models\PageTag::class)->create(['tag_id' => $tag1->id, 'page_id' => $page->id]);
        $pageTag2 = factory(App\Models\PageTag::class)->create(['tag_id' => $tag2->id, 'page_id' => $page->id]);
        $pageTag3 = factory(App\Models\PageTag::class)->create(['tag_id' => $tag3->id, 'page_id' => $page->id]);

        $this->controllerService->removeDeletedPageTags($page->id, [$tag1->id]);

        $this->assertCount(1, $page->pageTags);
    }

    public function testItCanStoreMultipleAddedPageTags()
    {
        $page = factory(App\Models\Page::class)->create();
        
        $tag1 = factory(App\Models\Tag::class)->create();
        $tag2 = factory(App\Models\Tag::class)->create();

        $this->controllerService->storeMultipleAddedPageTags($page->id, [$tag1->id, $tag2->id]);

        $this->assertCount(2, $page->pageTags);
    }

    public function testItCanStoreANewPageTag()
    {
        $page = factory(App\Models\Page::class)->create();
        $tag = factory(App\Models\Tag::class)->create();

        $this->controllerService->storeANewPageTag($page->id, $tag->id);

        $lookup = PageTag::where('tag_id', $tag->id)
            ->where('page_id', $page->id)
            ->first();

        $this->assertTrue(is_object($lookup));
    }
}
