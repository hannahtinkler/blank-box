<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\ModelServices\UserModelService;

class RankController extends Controller
{
    private $modelService;
    
    public function __construct(Request $request)
    {
        $user = $request->user();
        $this->modelService = new UserModelService($user);
    }

    public function index()
    {
        $ranked = $this->getRanikings();

        return view('rank.index', compact('ranked'));
    }
    
    private function getRanikings()
    {
        $communityData = $this->modelService->getRawCommunityData();
        $ranked = [];
        
        foreach ($communityData as $rank => $user) {
           $ranked[$user['name']] = $user['total'];
           $ranked[$user['name']] = $rank + 1;     
        }
        
        return $ranked;
    }
}
