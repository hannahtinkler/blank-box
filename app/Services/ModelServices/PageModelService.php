<?php

namespace App\Services\ModelServices;

use Illuminate\Http\Request;

use App\Models\Page;
use App\Models\SuggestedEdit;
use App\Interfaces\SearchableModelService;

class PageModelService
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
            return '<strong><a href="/u/' . $edits->first()->creator->slug . '">' . $edits->first()->creator->name . '</a></strong>';
        }

        $count = 1;
        $string = '';
        foreach ($edits as $edit) {
            $creator = $edit->creator;
            $creatorString = '<a href="/u/' . $creator->slug . '">' . $creator->name . '</a>';

            if ($count < $edits->count()) {
                $string .= '<strong>' . $creatorString . '</strong>, ';
            } else {
                $string = rtrim($string, ', ') . ' and <strong>' . $creatorString . '</strong>';
            }
            $count++;
        }

        return $string;
    }
}
