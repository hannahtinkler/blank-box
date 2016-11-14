<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Page;

class DiagramController extends Controller
{
    public function whatKindOfTestShouldIWrite()
    {
        $page = Page::findBySlug('what-kind-of-test-should-i-write');

        return view('diagrams.what_kind_of_test_should_i_write', compact('page'));
    }
    
    public function webformsProcessDiagram()
    {
        $page = Page::findBySlug('webforms-process-diagram');

        return view('diagrams.webforms_process_diagram', compact('page'));
    }
    
    public function serverNodeDiagram()
    {
        $page = Page::findBySlug('server-node-diagram');

        return view('diagrams.server_node_diagram', compact('page'));
    }
    
    public function sensuProcessDiagram()
    {
        $page = Page::findBySlug('sensu-process-diagram');

        return view('diagrams.sensu_process_diagram', compact('page'));
    }

    public function serverMapDiagram()
    {
        $page = Page::findBySlug('server-map-diagram');

        return view('diagrams.server_map_diagram', compact('page'));
    }
}
