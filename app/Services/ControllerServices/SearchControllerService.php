<?php

namespace App\Services\ControllerServices;

use Auth;
use App\Interfaces\SearchableModelService;

class SearchControllerService
{
    public $user;
    private $term;
    private $formatForAjax;
    private $allResults = array();

    public function __construct($term, $formatForAjax = true, $user = null)
    {
        $this->user = $user ?: Auth::user();
        $this->term = $term;
        $this->formatForAjax = $formatForAjax;
    }

    public function processSearch(array $searchables)
    {
        foreach ($searchables as $searchable) {
            $searchable = 'App\Services\ModelServices\\'. $searchable . 'ModelService';
            $class = new $searchable($this->user);
            $newResults = $this->getResults($class);
            $this->allResults[] = $newResults;
        }

        $this->formatResultSet();
        $this->sortResults();

        return $this->allResults;
    }

    private function getResults(SearchableModelService $class)
    {
        return $class->getSearchResults($this->term);
    }

    private function formatResultSet()
    {
        $formatted = [];
        foreach ($this->allResults as $resultSet) {
            foreach ($resultSet as $result) {
                if ($this->formatForAjax) {
                    $result = $this->formatSingleResultForAjax($result);
                }
                $formatted[] = $result;
            }
        }

        $this->allResults = $formatted;
    }

    private function formatSingleResultForAjax($result)
    {
        return [
            'content' => $result->searchResultString(),
            'url' => $result->searchResultUrl(),
            'score' => $result->documentScore()
        ];
    }

    private function sortResults()
    {
        usort($this->allResults, function ($a, $b) {
            if ($a['score'] == $b['score']) {
                return 0;
            }

            return ($a['score'] < $b['score']) ? 1 : -1;
        });
    }
}
