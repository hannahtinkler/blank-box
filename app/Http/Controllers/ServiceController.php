<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Page;
use App\Models\Service;

class ServiceController extends Controller
{
    public function showPage()
    {
        $services = Service::orderBy('name')->get();
        $page = Page::where('slug', 'service-list')->first();
        return view('services.show_page', compact('services', 'page'));
    }
}
