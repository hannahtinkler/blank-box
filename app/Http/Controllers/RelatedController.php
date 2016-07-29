<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tag;
use App\Models\Page;
use App\Models\Chapter;
use App\Models\PageTag;

class RelatedController extends Controller
{
    private $isAjaxRequest;
  
    public function __construct()
    {
        $this->isAjaxRequest = \Request::ajax();
    }

    public function showRelatedResults($term)
    {
        $results = $this->getRelatedResources($term);
        return view('related.results', [
            'results' => $results,
            'relatedTerm' => $term
        ]);
    }

    public function getRelatedResources($term)
    {
        $queryParts = $this->getQueryParts($term);

        $relatedResources = $this->getRelatedResourcesForTags($queryParts);
        $relatedResources = $this->formatRelatedResources($relatedResources);

        return $this->isAjaxRequest ? json_encode($relatedResources) : $relatedResources;
    }

    public function getQueryParts($term)
    {
        $queryParts = explode(' ', $term);

        $queryParts = array_filter($queryParts, function ($part) {
            return strlen($part) > 1 && !in_array($part, $this->getIgnoredQueryParts());
        });

        return $queryParts;
    }

    public function formatRelatedResources($relatedResources)
    {
        $pages = [];
        foreach ($relatedResources['pages'] as $page) {
            if (isset($pages['page' . $page->id])) {
                $pages['page' . $page->id]['score'] += $page->score;
            } else {
                $pages['page' . $page->id] = [
                    'type' => 'page',
                    'title' => $page->searchResultString(),
                    'description' => $page->description,
                    'url' => $page->searchResultUrl(),
                    'score' => $page->score
                ];
            }
        }
        $pages = $this->sortResultsByScore($pages);

        $chapters = [];
        foreach ($relatedResources['chapters'] as $chapter) {
            if (isset($chapters['chapter' . $chapter->id])) {
                $chapters['chapter' . $chapter->id]['score'] += $chapter->score;
            } else {
                $chapters['chapter' . $chapter->id] = [
                    'type' => 'chapter',
                    'title' => $chapter->searchResultString(),
                    'description' => $chapter->description,
                    'url' => $chapter->searchResultUrl(),
                    'score' => $chapter->score
                ];
            }
        }
        $chapters = $this->sortResultsByScore($chapters);

        return array_merge($pages, $chapters);
    }

    public function sortResultsByScore($resources)
    {
        usort($resources, function ($a, $b) {
            if ($a == $b) {
                return 0;
            }

            return ($a['score'] > $b['score']) ? -1 : +1;
        });

        return $resources;
    }

    public function getMatchingTags($queryParts)
    {
        $matchingTags = [];

        foreach ($queryParts as $queryPart) {
            $tag = Tag::where('tag', 'LIKE', '%' . $queryPart . '%')->first();
            if (is_object($tag)) {
                $matchingTags[] = $tag;
            }
        }

        return $matchingTags;
    }
  
    public function getRelatedResourcesForTags($queryParts)
    {
        $pages = $this->getRelatedPagesForTags($queryParts);
        $chapters = $this->getRelatedChaptersForTags($queryParts);

        return [
            'pages' => $pages,
            'chapters' => $chapters
        ];
    }

    public function getRelatedPagesForTags($queryParts)
    {
        $matchingTags = $this->getMatchingTags($queryParts);

        $pages = [];

        if (!empty($matchingTags)) {
            foreach ($matchingTags as $tag) {
                $resultPages = Page::select([
                    'pages.*',
                    \DB::raw('1 as score')
                ])
                    ->join('page_tags', 'pages.id', '=', 'page_tags.page_id')
                    ->where('page_tags.tag_id', $tag->id)
                    ->get();

                if (!$resultPages->isEmpty()) {
                    foreach ($resultPages as $result) {
                        $pages[] = $result;
                    }
                }
            }
        }

        return $pages;
    }

    public function getRelatedChaptersForTags($queryParts)
    {
        $chapters = [];
        foreach ($queryParts as $part) {
            $resultChapters = Chapter::select([
                'chapters.*',
                \DB::raw('1 as score')
            ])
                ->where('title', 'LIKE', '%' . $part . '%')
                ->get();

            if (!$resultChapters->isEmpty()) {
                foreach ($resultChapters as $result) {
                    $chapters[] = $result;
                }
            }
        }

        return $chapters;
    }

    public function getIgnoredQueryParts()
    {
        return [
            'and',
            'are',
            'as',
            'at',
            'be',
            'but',
            'for',
            'from',
            'how',
            'in',
            'is',
            'no',
            'not',
            'on',
            'off',
            'of',
            'the',
            'to',
            'this',
            'up'
        ];
    }
}
