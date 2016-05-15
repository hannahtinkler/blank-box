<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\SearchRepository;

class SearchController extends Controller
{
    private $isAjaxRequest;
    private $defaultSearchables = [
        'Server',
        'Service',
        'Page',
        'Chapter',
        'User'
    ];
  
    public function __construct()
    {
        $this->determineIfAjax();
    }

    public function showSearchResults($term)
    {
        $results = $this->performSearch($term);
        return view('search.results', [
            'results' => $results,
            'searchTerm' => $term
        ]);
    }
  
    public function determineIfAjax()
    {
        $this->isAjaxRequest = \Request::ajax();
    }

    public function performSearch($term)
    {

        if (strlen($term) < 3 && !is_int($term)) {
            return $this->isAjaxRequest ? json_encode([]) : [];
        }

        $searchDetails = $this->getSearchDetails($term);

        $searchRepository = new SearchRepository($searchDetails['term'], $this->isAjaxRequest);
        $results = $searchRepository->processSearch($searchDetails['searchables']);

        return $this->isAjaxRequest ? json_encode($results) : $results;
    }
  
    public function getSearchDetails($term)
    {
        if (strpos($term, ':')) {
            $parts = array_map('trim', explode(':', $term));
            $searchables = array_map('trim', explode(',', $parts[0]));
            $searchables = array_map('ucwords', $searchables);
            $term = $parts[1];
        } else {
            $searchables = $this->defaultSearchables;
        }

        return [
            'term' => $term,
            'searchables' => $searchables
        ];
    }
}
