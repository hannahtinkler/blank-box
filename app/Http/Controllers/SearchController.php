<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Library\Repositories\SearchRepository;

class SearchController extends Controller
{
    private $defaultSearchables = [
        'Server',
        'Service',
        'Page',
        'Chapter'
    ];
  
    public function performSearch($term)
    {

        if (strpos($term, ':')) {
            $parts = array_map('trim', explode(':', $term));
            $searchables = array_map('trim', explode(',', $parts[0]));
            $searchables = array_map('ucwords', $searchables);
            $term = $parts[1];
        } else {
            $searchables = $this->defaultSearchables;
        }

        $searchRepository = new SearchRepository($term);
        $results = $searchRepository->processSearch($searchables);
        
        return json_encode($results);
    }
}
