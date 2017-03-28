<?php

namespace App\Repositories;

use App\Models\Page;
use App\Models\SuggestedEdit;

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

    public function updatorsString()
    {
        return SuggestedEdit::with('creator')
            ->where('page_id', $this->page->id)
            ->where('approved', 1)
            ->groupBy('created_by')
            ->get()
            ->map(function ($edit) {
                return '<strong><a href="/u/' . $edit->creator->slug . '">' . $edit->creator->name . '</a></strong>';
            })
            ->implode(', ');
    }

    /**
     * @return int
     */
    public function hasEdits()
    {
        return SuggestedEdit::where('page_id', $this->page->id)
            ->where('approved', 1)
            ->count();
    }
}
