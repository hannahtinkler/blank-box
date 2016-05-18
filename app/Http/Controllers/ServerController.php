<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\SshConfigRequest;
use App\Services\ControllerServices\ServerControllerService;
use App\Models\Server;
use App\Models\Page;

class ServerController extends Controller
{
    private $manager;

    public function __construct(ServerControllerService $manager)
    {
        $this->manager = $manager;
    }

    public function show()
    {
        $servers = Server::orderBy('node_type')->orderBy('name')->get();
        $page = Page::where('slug', 'server-details')->first();
        return view('servers.show_page', compact('servers', 'page'));
    }

    public function showServerModal($id)
    {
        $server = Server::find($id);

        if (!is_object($server)) {
            return \App::abort(404);
        }
        
        return view('partials.servermodal', compact('server'));
    }

    public function configGenerator()
    {
        $page = Page::where('slug', 'ssh-config-generator')->first();

        if (!is_object($page)) {
            return \App::abort(404);
        }
        
        return view('servers.config_generator', compact('page'));
    }

    public function generateConfig(SshConfigRequest $request)
    {
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=config");
        header('Content-type: text/plain');

        $content = $this->manager->getSshConfigContent();
        $content = str_replace('SSH_USERNAME', $request->input('ssh_username'), $content);
        $content = str_replace('BRACKNELL_KEY', $request->input('bracknell_key'), $content);
        $content = str_replace('BOURNEMOUTH_KEY', $request->input('bournemouth_key'), $content);

        echo $content;
    }
}
