<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Page;
use Themsaid\Forge\Forge;
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
        $type = $this->page->chapter->projects_chapter ? 'Project' : 'Page';

        return $type . ': ' . $this->page->title;
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
        return $this->page->chapter->projects_chapter ? '<i class="fa fa-inbox"></i>' : '<i class="fa fa-file-o"></i>';;
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

    public function forgeSites()
    {
        return $this->page->forgeLinks->map(function ($link) {
            $site = app(Forge::class)->site($link->server_id, $link->site_id);
            $site->internalId = $link->id;

            $log = app(Forge::class)->siteDeploymentLog($link->server_id, $link->site_id);
            $dateString = explode(PHP_EOL, $log)[0];

            try {
                $site->lastDeployment = Carbon::createFromFormat('D M n H:i:s e Y', $dateString);
            } catch(\Exception $e) {
                $site->lastDeployment = Carbon::createFromFormat('D n M H:i:s e Y', $dateString);
            }

            $site->lastDeployment->format('d-m-Y H:i:s');

            return $site;
        });
    }
}
