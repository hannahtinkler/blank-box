<?php

namespace App\Http\Controllers\Api;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ForgeSiteController extends Controller
{
    /**
     * @return Redirect
     */
    public function index(Request $request, Page $page)
    {
        return response()->json($page->forgeSites);
    }
}
