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
     * Tests that a call to the method which retrieves the text string the
     * search form uses returns as expected
     *
     * @return void
     */
    public function testSearchResultStringIsCorrect()
    {
        $repository = $this->getUserModelService();

        $expected = 'User: ' . $this->user->name . ' (' . ($this->user->curator ? 'Curator' : 'Contributor') . ')';
        $actual = $repository->searchResultString();

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
        $repository = $this->getUserModelService();

        $expected = '/u/' . $this->user->slug;
        $actual = $repository->searchResultUrl();

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
        $repository = $this->getUserModelService();

        $expected = '<i class="fa fa-user"></i>';
        $actual = $repository->searchResultIcon();

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
