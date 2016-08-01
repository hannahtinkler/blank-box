<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\User;
use App\Models\Page;
use App\Models\SuggestedEdit;
use App\Models\UserBadge;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Tests that a call to the pages relationship returns a collection
     * object containing instances of the Page class
     *
     * @return void
     */
    public function testPagesRelationshipReturnsPages()
    {
        $user = factory(User::class)->create();
        factory(App\Models\Page::class, 2)->create(['created_by' => $user->id]);

        $this->assertTrue($user->pages->first() instanceof Page);
    }

    /**
     * Tests that a call to the suggestedEdits relationship returns a collection
     * object containing instances of the SuggestedEdit class
     *
     * @return void
     */
    public function testSuggestedEditsRelationshipReturnsSuggestedEdits()
    {
        $user = factory(User::class)->create();
        factory(App\Models\SuggestedEdit::class, 2)->create(['created_by' => $user->id]);

        $this->assertTrue($user->suggestedEdits->first() instanceof SuggestedEdit);
    }
    
    /**
     * Tests that a call to the userBadges relationship returns a collection
     * object containing instances of the UserBadge class
     *
     * @return void
     */
    public function testUserBadgesRelationshipReturnsUserBadges()
    {
        $user = factory(User::class)->create();
        factory(App\Models\UserBadge::class, 2)->create(['user_id' => $user->id]);

        $this->assertTrue($user->userBadges->first() instanceof UserBadge);
    }

    /**
     * Tests that a call to the method that returns the search result string
     * for a given record works as expected
     *
     * @return void
     */
    public function testSearchResultStringIsCorrect()
    {
        $user = factory(User::class)->create();

        $expected = 'User: ' . $user->name . ' (Reader)';
        $actual = $user->searchResultString();

        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests that a call to the method that returns the search result url
     * for a given record works as expected
     *
     * @return void
     */
    public function testSearchResultUrlIsCorrect()
    {
        $user = factory(User::class)->create();

        $expected = '/u/' . $user->slug;
        $actual = $user->searchResultUrl();

        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests that a call to the method that returns the search result icon
     * for a given record works as expected
     *
     * @return void
     */
    public function testSearchResultIconIsCorrect()
    {
        $user = factory(User::class)->create();

        $expected = '<i class="fa fa-user"></i>';
        $actual = $user->searchResultIcon();

        $this->assertEquals($expected, $actual);
    }
}
