<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Library\Models\Chapter;
use App\Library\Models\Page;
use App\Library\Models\Service;
use App\Library\Models\Server;
use App\Library\Repositories\SearchRepository;

class HomeController extends Controller
{
    public function index()
    {
        $chapters = Chapter::orderBy('order')->get();
        return view('home.index', compact('chapters'));
    }
  
    public function search($term)
    {
        $this->searchRepository = new SearchRepository($term);

        $results = $this->searchRepository->processSearch([
            'Server',
            'Service',
            'Page',
            'Chapter'
        ]);
        
        return json_encode($results);
    }
}
