<?php

namespace App\Repositories;

use App\Models\Page;

class PageRepository
{
    /**
     * @var Page
     */
    private $page;
    
    /**
     * @param Page $page
     */
    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    /**
     * @return string
     */
    public function searchResultString()
    {
        return 'Page: ' . $this->page->title;
    }

    /**
     * @return string
     */
    public function searchResultUrl()
    {
        return sprintf(
            '/p/%s/%s/%s',
            $this->page->chapter->category->slug,
            $this->page->chapter->slug,
            $this->page->slug
        );
    }

    /**
     * @return string
     */
    public function searchResultIcon()
    {
        return '<i class="fa fa-file-o"></i>';
    }
}
