<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\SshConfigRequest;
use App\Services\ControllerServices\ServerControllerService;
use App\Models\Server;
use App\Models\Page;

class ServerController extends Controller
{
    private $controllerService;

    public function __construct(ServerControllerService $controllerService)
    {
        $this->controllerService = $controllerService;
    }

    public function show()
    {
        $servers = Server::orderBy('node_type')->orderBy('name')->get();
        $page = Page::where('slug', 'server-details')->firstOrFail();
        return view('servers.show_page', compact('servers', 'page'));
    }

    public function showServerModal($id)
    {
        $server = Server::findOrFail($id);

        if (!is_object($server)) {
            return \App::abort(404);
        }
        
        return view('partials.servermodal', compact('server'));
    }

    public function configGenerator()
    {
        $page = Page::where('slug', 'ssh-config-generator')->firstOrFail();

        return view('servers.config_generator', compact('page'));
    }

    public function generateConfig(SshConfigRequest $request)
    {
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=config");
        header('Content-type: text/plain');

        $content = $this->controllerService->getSshConfigContent();
        $content = str_replace('SSH_USERNAME', $request->input('ssh_username'), $content);
        $content = str_replace('BRACKNELL_KEY', $request->input('bracknell_key'), $content);
        $content = str_replace('BOURNEMOUTH_KEY', $request->input('bournemouth_key'), $content);

        echo $content;
    }
}
