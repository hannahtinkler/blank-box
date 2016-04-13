<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Library\Models\Server;
use App\Library\Models\Page;

class ServerController extends Controller
{
    public function showPage()
    {
        $servers = Server::orderBy('node_number')->orderBy('node_number')->get();
        $page = Page::where('slug', 'server-list')->first();
        return view('servers.show_page', compact('servers', 'page'));
    }
}
