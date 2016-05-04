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
        $page = Page::where('slug', 'server-details')->first();
        return view('servers.show_page', compact('servers', 'page'));
    }

    public function configGenerator()
    {
        $page = Page::where('slug', 'ssh-config-generator')->first();
        return view('servers.config_generator', compact('page'));
    }

    public function generateConfig(Request $request)
    {
        $validation = \Validator::make($request->input(), [
            'bracknell_key' => 'required|min:3',
            'bournemouth_key' => 'required|min:3'
        ]);

        if ($validation->fails()) {
            return back()->with('error', 'You did not complete all the fields')->withInput();
        }

        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=config");
        header('Content-type: text/plain');

        $content = $this->getSshConfigContent();
        $content = str_replace('BRACKNELL_KEY', $request->input('bracknell_key'), $content);
        $content = str_replace('BOURNEMOUTH_KEY', $request->input('bournemouth_key'), $content);

        echo $content;
    }

    public function getSshConfigContent()
    {
        return "# debian (and by extension ubuntu) hashes the known_hosts file, inhibiting
# tab completion
HashKnownHosts no

# send a ping/request a pong every 90 seconds to keep connections alive
ServerAliveInterval 90

# iaptus bracknell ]----------------------------------------------------------

# iaptusvnode14
Host iaptusvnode14
    HostName 10.0.2.42
    User mayhealthv_ht
    ForwardAgent yes
    IdentityFile ~/.ssh/BRACKNELL_KEY
    #
    # web forwarding
    #
    # port 8000 shunt to the lb http port
    LocalForward 8000 10.0.2.70:80
    # port 8443 shunt to the lb https port
    LocalForward 8443 10.0.2.70:443
    #
    # database connections
    #
    # iaptusdbvnode16 (Multi-Master-1a)
    LocalForward 53306 10.0.2.44:3306
    # iaptusdbvnode17 (Multi-Master-1b)
    LocalForward 53307 10.0.2.45:3306
    # iaptusdbvnode18 (Multi-Master-2a)
    LocalForward 54306 10.0.2.46:3306
    # iaptusdbvnode19 (Multi-Master-2b)
    LocalForward 54307 10.0.2.47:3306
    # iaptusdbvnode24 (Multi-Master-3a)
    LocalForward 55306 10.0.2.52:3306
    # iaptusdbvnode25 (Multi-Master-3b)
    LocalForward 56306 10.0.2.53:3306
    # iaptusdbvnode26 (testing environment server)
    LocalForward 57306 10.0.2.54:3306
    # iaptusdbvnode21 (statsarchive)
    LocalForward 64306 10.0.2.49:3306


# iaptusvnode15
Host iaptusvnode15
    HostName 10.0.2.43
    User mayhealthv_ht
    ForwardAgent yes
    IdentityFile ~/.ssh/BRACKNELL_KEY

# iaptusvnode26 (testing server)
Host iaptusvnode26
    HostName 10.0.2.54
    User mayhealthv_ht
    ForwardAgent yes
    IdentityFile ~/.ssh/BRACKNELL_KEY
    #
    # web forwarding
    #
    LocalForward 8000 10.0.2.70:80
    LocalForward 8443 10.0.2.70:443
    #
    # database connections
    #
    # iaptusdbvnode16 (Multi-Master-1a)
    LocalForward 53306 10.0.2.44:3306
    # iaptusdbvnode17 (Multi-Master-1b)
    LocalForward 53307 10.0.2.45:3306
    # iaptusdbvnode18 (Multi-Master-2a)
    LocalForward 54306 10.0.2.46:3306
    # iaptusdbvnode19 (Multi-Master-2b)
    LocalForward 54307 10.0.2.47:3306
    # iaptusdbvnode24 (Multi-Master-3a)
    LocalForward 55306 10.0.2.52:3306
    # iaptusdbvnode25 (Multi-Master-3b)
    LocalForward 56306 10.0.2.53:3306
    # iaptusdbvnode26 (testing environment server)
    LocalForward 57306 10.0.2.54:3306
    # iaptusdbvnode21 (statsarchive)
    LocalForward 64306 10.0.2.49:3306
    # iaptusdbvnode34 (Multi-Master-5a)
    LocalForward 38308 192.168.63.34:3306
    # iaptusdbvnode35 (Multi-Master-5b)
    LocalForward 38309 192.168.63.35:3306

# iaptus bournemouth ]--------------------------------------------------------


# iaptusvnode7
Host iaptusvnode7
    HostName 192.168.63.7
    User mayhealthv_ht
    Port 2263
    ForwardAgent yes
    IdentityFile ~/.ssh/BOURNEMOUTH_KEY
    LocalForward 8000 localhost:6080
    LocalForward 8443 localhost:443
    LocalForward 9443 localhost:60443
    # iaptusvnode8
    LocalForward 18306 192.168.63.27:3306
    # gp global db/general bournemouth shared for reading
    LocalForward 18308 192.168.63.11:3306
    # slave (no more description)
    LocalForward 28306 192.168.63.9:3306
    # mysql stats archive
    LocalForward 28307 192.168.63.10:3306

# iaptusvnode27 - bournemouth (new test server)
Host iaptusvnode27
    HostName 192.168.60.27
    User mayhealthv_ht
    Port 2260
    ForwardAgent yes
    IdentityFile ~/.ssh/BOURNEMOUTH_KEY
    LocalForward 63306 127.0.0.1:3306

# bacpac group ]--------------------------------------------------------------

# bacpac
Host bacpac-staging
    HostName 192.168.82.13
    User mayhealthv_ht
    IdentityFile ~/.ssh/bacpac/BOURNEMOUTH_KEY
    IdentitiesOnly yes
    LocalForward 13306 127.0.0.1:3306

Host bacpac-paywall-live
    HostName 192.168.82.14
    User mayhealthv_ht
    IdentityFile ~/.ssh/bacpac/BOURNEMOUTH_KEY
    IdentitiesOnly yes

Host bacpac-live
    HostName 192.168.83.15
    User mayhealthv_ht
    IdentityFile ~/.ssh/bacpac/BOURNEMOUTH_KEY
    IdentitiesOnly yes
    LocalForward 13306 127.0.0.1:3306

# misc hosts (includes iaptus demo) ]-----------------------------------------

# maydenasvnode1 - bournemouth (demo)
Host maydenasvnode1
    HostName 192.168.60.1
    User mayhealthv_ht
    Port 2260
    IdentityFile ~/.ssh/BOURNEMOUTH_KEY
    LocalForward 63306 localhost:3306

# maydenasvnode5 - bournemouth (webforms)
Host maydenasvnode5
    HostName 192.168.60.5
    User mayhealthv_ht
    Port 2260
    IdentitiesOnly yes
    IdentityFile ~/.ssh/BOURNEMOUTH_KEY
    LocalForward 16306 localhost:3306

# maydenasvnode23 - bournemouth (webforms db)
Host maydenasvnode23
    HostName 192.168.60.23
    User mayhealthv_ht
    Port 2260
    IdentitiesOnly yes
    IdentityFile ~/.ssh/BOURNEMOUTH_KEY
    # Live Webforms
    LocalForward 16306 192.168.60.5:3306
    # Replication Webforms
    LocalForward 16307 localhost:3306

# miscellaneous/git keys/personal ]-------------------------------------------

# Put your personal ssh configuration in personal_config and use phing install
# to build and install a new ssh configuration.";
    }
}
