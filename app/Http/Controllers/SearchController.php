<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\ControllerServices\SearchControllerService;

class SearchController extends Controller
{
    private $isAjaxRequest;

    public function __construct()
    {
        $this->isAjaxRequest = \Request::ajax();
    }

    public function showSearchResults(Request $request, $term)
    {
        $results = $this->performSearch($request, $term);

        return view('search.results', [
            'results' => $results,
            'searchTerm' => $term
        ]);
    }

    public function performSearch(Request $request, $term)
    {
        if (strlen($term) < 1) {
            return $this->isAjaxRequest ? json_encode([]) : [];
        }

        $searchDetails = $this->getSearchDetails($term);
        
        if (is_numeric($term)) {
            $searchDetails['searchables'] = ['Service'];
        }

        $searchModelService = new SearchControllerService($request, $searchDetails['term'], $this->isAjaxRequest);
        $results = $searchModelService->processSearch($searchDetails['searchables']);

        return $this->isAjaxRequest ? json_encode($results) : $results;
    }

    public function getSearchDetails($term)
    {
        if (strpos($term, ']')) {
            $term = trim($term, '[');
            $parts = array_map('trim', explode(']', $term));
            $searchables = array_map('trim', explode(',', $parts[0]));
            $searchables = array_map('ucwords', $searchables);
            $term = $parts[1];
        } else {
            $searchables = config('elasticquent.searchables');
        }

        return [
            'term' => $term,
            'searchables' => $searchables
        ];
    }
}
