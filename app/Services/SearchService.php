<?php

namespace App\Services;

use Illuminate\Http\Request;

use App\Services\PageService;
use App\Services\UserService;
use App\Services\ChapterService;

class SearchService
{
    /**
     * @var array
     */
    private $repositories;
    
    /**
     * @var boolean
     */
    private $ajax;

    /**
     * @param PageService    $pages
     * @param ChapterService $chapters
     * @param UserService    $users
     */
    public function __construct(
        Request $request,
        PageService $pages,
        ChapterService $chapters,
        UserService $users
    ) {
        $this->ajax = $request->ajax();

        $this->services = [
            'pages' => $pages,
            'chapters' => $chapters,
            'users' => $users,
        ];
    }

    /**
     * @param  string  $term
     * @param  array   $searchables
     * @param  boolean $ajax
     * @return array
     */
    public function process($term, array $searchables)
    {
        $results = [];

        foreach ($searchables as $searchable) {
            $class = $this->services[$searchable];

            $results = array_merge(
                $results,
                $class->search($term)->all()
            );
        }

        $results = $this->sort($results);
        $results = $this->format($results);

        return $results;
    }

    /**
     * @param  array  $results
     * @return array
     */
    public function format(array $results)
    {
        $formatted = [];

        foreach ($results as $result) {
            if ($this->ajax) {
                $result = [
                    'content' => $result->searchResultString,
                    'url' => $result->searchResultUrl,
                    'score' => $result->documentScore()
                ];
            }

            $formatted[] = $result;
        }

        return $formatted;
    }

    /**
     * @param  array $results
     * @return array
     */
    public function sort(array $results)
    {
        usort($results, function ($a, $b) {
            if ($a->documentScore() == $b->documentScore()) {
                return 0;
            }

            return ($a->documentScore() < $b->documentScore()) ? 1 : -1;
        });

        return $results;
    }
}
