<?php

use App\Repositories\PageRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PageControllerTest extends TestCase
{
    use DatabaseTransactions;

    public $user;

    public function testPageCreate()
    {
        $this->logInAsUser();

        $this->visit('/page/create')
            ->seePageIs('/page/create')
            ->see('Create New Page');
    }

    public function testPageEdit()
    {
        // $this->logInAsUser();

        // $page = factory(App\Models\Page::class)->create();

        // $this->visit('/page/edit/' . $page->id)
        //     ->seePageIs('/page/edit/' . $page->id)
        //     ->see('Create Page');
    }

    public function testPagePreview()
    {
    }

    public function testPagePreviewSave()
    {
    }

    public function testPageSave()
    {
    }

    public function testPageUpdate()
    {
    }

    public function testPageDestroy()
    {
    }

    public function logInAsUser($overrides = [])
    {
        $this->user = factory(App\Models\User::class)->create($overrides);
        $this->be($this->user);
    }
}
