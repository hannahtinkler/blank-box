<?php

use App\Models\User;
use App\Services\ModelServices\UserModelService;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserModelServiceTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * The current user being used in the test
     * @var object User
     */
    public $user;

    /**
     * Tests that a call to the method which retrieves the user type works for
     * a curator and returns the expected value
     *
     * @return void
     */
    public function testItCanGetUserTypeForCurator()
    {
        $curator = factory(App\Models\User::class)->create(['curator' => true]);

        $modelService = new UserModelService($curator);
        
        $actual = $modelService->getUserType();
        $expected = 'Curator / This loser has no badges';

        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests that a call to the method which retrieves the user type works for
     * a contributor and returns the expected value
     *
     * @return void
     */
    public function testItCanGetUserTypeForContributor()
    {
        $contributor = factory(App\Models\User::class)->create();
        factory(App\Models\Page::class)->create(['created_by' => $contributor->id]);

        $modelService = new UserModelService($contributor);
        
        $actual = $modelService->getUserType();
        $expected = 'This loser has no badges';

        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests that a call to the method which retrieves the user type works for
     * a reader and returns the expected value
     *
     * @return void
     */
    public function testItCanGetUserTypeForReader()
    {
        $reader = factory(App\Models\User::class)->create();

        $modelService = new UserModelService($reader);
        
        $actual = $modelService->getUserType();
        $expected = 'This loser has no badges';

        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests that a call to the method which retrieves the text string the
     * search form uses returns as expected
     *
     * @return void
     */
    public function testSearchResultStringIsCorrect()
    {
        $modelService = $this->getUserModelService();

        $expected = 'User: ' . $this->user->name . ' (This loser has no badges)';
        $actual = $modelService->searchResultString();

        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests that a call to the method which retrieves the URL string the
     * search form uses returns as expected
     *
     * @return void
     */
    public function testSearchResultUrlIsCorrect()
    {
        $modelService = $this->getUserModelService();

        $expected = '/u/' . $this->user->slug;
        $actual = $modelService->searchResultUrl();

        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests that a call to the method which retrieves the icon html the
     * search form uses returns as expected
     *
     * @return void
     */
    public function testSearchResultIconIsCorrect()
    {
        $modelService = $this->getUserModelService();

        $expected = '<i class="fa fa-user"></i>';
        $actual = $modelService->searchResultIcon();

        $this->assertEquals($expected, $actual);
    }

    /**
     * Create instance of UserModelService class
     *
     * @return void
     */
    private function getUserModelService()
    {
        $this->user = factory(User::class)->create();
        return new UserModelService($this->user);
    }
}
