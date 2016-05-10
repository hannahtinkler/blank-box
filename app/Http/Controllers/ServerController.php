<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Server;
use App\Models\Page;

class ServerController extends Controller
{
    public function showPage()
    {
        $servers = Server::orderBy('node_type')->orderBy('name')->get();
        $page = Page::where('slug', 'server-details')->first();
        return view('servers.show_page', compact('servers', 'page'));
    }

    public function showServerModal($id)
    {
        $server = Server::find($id);
        return view('partials.servermodal', compact('server'));
    }

    public function configGenerator()
    {
        $page = Page::where('slug', 'ssh-config-generator')->first();
        return view('servers.config_generator', compact('page'));
    }

    public function generateConfig(Request $request)
    {
        $validation = \Validator::make($request->input(), [
            'ssh_username' => 'required|min:3',
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
        $content = str_replace('SSH_USERNAME', $request->input('ssh_username'), $content);
        $content = str_replace('BRACKNELL_KEY', $request->input('bracknell_key'), $content);
        $content = str_replace('BOURNEMOUTH_KEY', $request->input('bournemouth_key'), $content);

        echo $content;
    }

    public function getSshConfigContent()
    {
        return "# Debian (and by extension ubuntu) hashes the known_hosts file, inhibiting tab completion
HashKnownHosts no

# Send a ping/request a pong every 90 seconds to keep connections alive
ServerAliveInterval 90


#[ IAPTUS VIA BRACKNELL ]-----------------------------------------------------

# iaptusbracknell
    Host iaptusbracknell
    HostName 10.0.2.42
    User SSH_USERNAME
    ForwardAgent yes
    IdentityFile ~/.ssh/iaptus/BRACKNELL_KEY
    
    # WEB FORWARDING
        LocalForward 8000 10.0.2.70:80
        LocalForward 8443 10.0.2.70:443
    
    # DATABASE CONNECTIONS
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
        LocalForward 55307 10.0.2.53:3306
        
        # iaptusdbvnode27 (Multi-Master-4a / Testing B)
        LocalForward 38306 192.168.63.27:3306
        # iaptusdbvnode28 (Multi-Master-4b / Testing B)
        LocalForward 38307 192.168.63.28:3306
        
        # iaptusdbvnode34 (Multi-Master-5a)
        LocalForward 38308 192.168.63.34:3306
        # iaptusdbvnode35 (Multi-Master-5b)
        LocalForward 38309 192.168.63.35:3306
        
        # iaptusdbvnode21 (Stats Archive A)
        LocalForward 64306 10.0.2.49:3306
        # iaptusdbvnode26 (Stats Archive B)
        LocalForward 57306 10.0.2.54:3306


#[ IAPTUS VIA BOURNEMOUTH ]---------------------------------------------------

# iaptusbournemouth
    Host iaptusbournemouth
    HostName 192.168.63.7
    User SSH_USERNAME
    Port 2263
    ForwardAgent yes
    IdentityFile ~/.ssh/iaptus/BOURNEMOUTH_KEY
    
    # WEB FORWARDING
        LocalForward 8000 localhost:6080
        LocalForward 8443 localhost:443
        LocalForward 9443 localhost:60443
    
    # DATABASE CONNECTIONS
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
        LocalForward 55307 10.0.2.53:3306
        
        # iaptusdbvnode27 (Multi-Master-4a / Testing B)
        LocalForward 38306 192.168.63.27:3306
        # iaptusdbvnode28 (Multi-Master-4b / Testing B)
        LocalForward 38307 192.168.63.28:3306
        
        # iaptusdbvnode34 (Multi-Master-5a)
        LocalForward 38308 192.168.63.34:3306
        # iaptusdbvnode35 (Multi-Master-5b)
        LocalForward 38309 192.168.63.35:3306
        
        # iaptusdbvnode21 (Stats Archive A)
        LocalForward 64306 10.0.2.49:3306
        # iaptusdbvnode26 (Stats Archive B)
        LocalForward 57306 10.0.2.54:3306


#[ BACPAC ]-------------------------------------------------------------------

# bacpac
    Host bacpac-staging
    HostName 192.168.82.13
    User SSH_USERNAME
    IdentityFile ~/.ssh/bacpac/BOURNEMOUTH_KEY
    IdentitiesOnly yes

    # DATABASE CONNECTIONS
        LocalForward 13306 127.0.0.1:3306


    Host bacpac-live
    HostName 192.168.83.15
    User SSH_USERNAME
    IdentityFile ~/.ssh/bacpac/BOURNEMOUTH_KEY
    IdentitiesOnly yes
    
    # DATABASE CONNECTIONS
        LocalForward 13306 127.0.0.1:3306


#[ PAYWALL ]------------------------------------------------------------------

    Host paywall
    HostName 192.168.82.14
    User SSH_USERNAME
    IdentityFile ~/.ssh/bacpac/BOURNEMOUTH_KEY
    IdentitiesOnly yes


#[ IAPTUS DEMO ]------------------------------------------------------------

# iaptusdemo
    Host iaptusdemo
    HostName 192.168.60.1
    User SSH_USERNAME
    Port 2260
    IdentityFile ~/.ssh/iaptus/BOURNEMOUTH_KEY
    
    # DATABASE CONNECTIONS
        LocalForward 63306 localhost:3306


#[ WEBFORMS ]------------------------------------------------------------

# webforms-application
    Host webforms-application
    HostName 192.168.60.5
    User SSH_USERNAME
    Port 2260
    IdentitiesOnly yes
    IdentityFile ~/.ssh/iaptus/BOURNEMOUTH_KEY
    
    # DATABASE CONNECTIONS
        LocalForward 16306 localhost:3306


# webforms-database
    Host webforms-database
    HostName 192.168.60.23
    User SSH_USERNAME
    Port 2260
    IdentitiesOnly yes
    IdentityFile ~/.ssh/iaptus/BOURNEMOUTH_KEY

    # DATABASE CONNECTIONS
        # Master database
        LocalForward 16306 192.168.60.5:3306
        # Replication database
        LocalForward 16307 localhost:3306
";
    }
}
