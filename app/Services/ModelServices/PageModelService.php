<?php

namespace App\Services\ModelServices;

use Illuminate\Http\Request;

use App\Models\Page;
use App\Models\SuggestedEdit;
use App\Interfaces\SearchableModelService;

class PageModelService implements SearchableModelService
{
    public $page;

    public function __construct($page)
    {
        $this->page = $page;
    }

    public function getSearchResults($term)
    {
        $query = [
            "bool" => [
                "should" => [
                    [ "wildcard" => [ "_all" => "*$term*"]],
                    [ "match" => [ "_all" => "$term" ]]
                ]
            ]
        ];

        return Page::searchByQuery($query, null, null, 100);
    }

    public function editableByUser($user)
    {
        return $this->page->created_by == $user->id || $user->curator;
    }

    public function searchResultString()
    {
        return 'Page: ' . $this->page->title;
    }

    public function searchResultUrl()
    {
        return '/p/' . $this->page->chapter->category->slug . '/' . $this->page->chapter->slug . '/' . $this->page->slug;
    }

    public function searchResultIcon()
    {
        return '<i class="fa fa-file-o"></i>';
    }

    public function hasEdits()
    {
        $edits = SuggestedEdit::where('page_id', $this->page->id)
            ->where('approved', 1)
            ->get();
            
        return $edits->count();
    }

    public function getUpdatorsString()
    {
        $edits = SuggestedEdit::where('page_id', $this->page->id)
            ->where('approved', 1)
            ->groupBy('created_by')
            ->get();

        if ($edits->count() == 1) {
            return '<strong>' . $edits->first()->creator->name . '</strong>';
        }

        $count = 1;
        $string = '';
        foreach ($edits as $edit) {
            if ($count < $edit->count()) {
                $string .= '<strong>' . $edit->creator->name . '</strong>, ';
            } else {
                $string = trim($string, ', ') . ' and <strong>' . $edit->creator->name . '</strong>';
            }
            $count++;
        }
        return $string;

    }
}
