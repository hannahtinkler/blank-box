<?php

use Illuminate\Database\Seeder;
use App\Library\Models\Server;

class ServerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Server::truncate();


        /*
        |--------------------------------------------------------------------------
        | Application Servers
        |--------------------------------------------------------------------------
        |
        */

        Server::create([
            'name' => 'Cloud4',
            'nickname' => 'Basement Server',
            'location' => 'Widcombe',
            'ip_address' => null,
            'node_type' => 'Dual (Application & Database)',
            'access_type' => 'private'
        ]);

        Server::create([
            'name' => 'maydenasvnode1',
            'nickname' => 'iaptus Demo',
            'location' => 'Bournemouth',
            'ip_address' => '192.168.60.1',
            'node_type' => 'application',
            'access_type' => 'public'
        ]);

        Server::create([
            'name' => 'maydenasvnode23',
            'nickname' => 'Webforms DB (Slave)',
            'location' => 'Bournemouth',
            'ip_address' => '192.168.60.23',
            'node_type' => 'application',
            'access_type' => 'public'
        ]);

        Server::create([
            'name' => 'maydenasvnod5',
            'nickname' => 'Webforms DB',
            'location' => 'Bournemouth',
            'ip_address' => '192.168.60.5',
            'node_type' => 'application',
            'access_type' => 'public'
        ]);

        Server::create([
            'name' => 'iaptusvnode7',
            'nickname' => 'iaptus Application (Source Host)',
            'location' => 'Bournemouth',
            'ip_address' => '192.168.63.7',
            'node_type' => 'application',
            'access_type' => 'private'
        ]);

        Server::create([
            'name' => 'iaptusvnode14',
            'nickname' => 'iaptus Application (Source Host)',
            'location' => 'Bracknell',
            'ip_address' => '10.0.2.42',
            'node_type' => 'application',
            'access_type' => 'private'
        ]);


        Server::create([
            'name' => 'iaptusvnode22',
            'nickname' => 'iaptus Application',
            'location' => 'Bracknell',
            'ip_address' => '10.0.2.50',
            'node_type' => 'application',
            'access_type' => 'private'
        ]);


        Server::create([
            'name' => 'iaptusvnode26',
            'nickname' => 'iaptus Application (Testing)',
            'location' => 'Bracknell',
            'ip_address' => '10.0.2.54',
            'node_type' => 'application',
            'access_type' => 'private'
        ]);


        /*
        |--------------------------------------------------------------------------
        | Loadbalancer Servers
        |--------------------------------------------------------------------------
        |
        */

        Server::create([
            'name' => 'lbnode12',
            'nickname' => 'Nginx Loadbalancer',
            'location' => 'Bracknell',
            'ip_address' => null,
            'node_type' => 'Loadbalancer',
            'access_type' => 'private'
        ]);

        Server::create([
            'name' => 'lbnode13',
            'nickname' => 'Nginx Loadbalancer Failover',
            'location' => 'Bracknell',
            'ip_address' => null,
            'node_type' => 'Loadbalancer',
            'access_type' => 'private'
        ]);

        Server::create([
            'name' => 'lbnode30',
            'nickname' => 'Nginx Loadbalancer',
            'location' => 'Bournemouth',
            'ip_address' => null,
            'node_type' => 'Loadbalancer',
            'access_type' => 'private'
        ]);

        Server::create([
            'name' => 'lbnode31',
            'nickname' => 'Nginx Loadbalancer Failover',
            'location' => 'Bournemouth',
            'ip_address' => null,
            'node_type' => 'Loadbalancer',
            'access_type' => 'private'
        ]);


        /*
        |--------------------------------------------------------------------------
        | Database Servers
        |--------------------------------------------------------------------------
        |
        */

        Server::create([
            'name' => 'iaptusdbvnode16',
            'nickname' => 'Set-1A',
            'location' => 'Bracknell',
            'ip_address' => '10.0.2.44',
            'node_type' => 'database',
            'access_type' => 'private'
        ]);

        Server::create([
            'name' => 'iaptusdbvnode17',
            'nickname' => 'Set-1B',
            'location' => 'Bracknell',
            'ip_address' => '10.0.2.45',
            'node_type' => 'database',
            'access_type' => 'private'
        ]);

        Server::create([
            'name' => 'iaptusdbvnode18',
            'nickname' => 'Set-2A',
            'location' => 'Bracknell',
            'ip_address' => '10.0.2.46',
            'node_type' => 'database',
            'access_type' => 'private'
        ]);

        Server::create([
            'name' => 'iaptusdbvnode19',
            'nickname' => 'Set-2B',
            'location' => 'Bracknell',
            'ip_address' => '10.0.2.47',
            'node_type' => 'database',
            'access_type' => 'private'
        ]);

        Server::create([
            'name' => 'iaptusdbvnode21',
            'nickname' => 'Stats Archive A',
            'location' => 'Bracknell',
            'ip_address' => '10.0.2.49',
            'node_type' => 'database',
            'access_type' => 'private'
        ]);

        Server::create([
            'name' => 'iaptusdbvnode26',
            'nickname' => 'Stats Archive B',
            'location' => 'Bracknell',
            'ip_address' => '10.0.2.54',
            'node_type' => 'database',
            'access_type' => 'private'
        ]);

        Server::create([
            'name' => 'iaptusdbvnode24',
            'nickname' => 'Set-3A',
            'location' => 'Bracknell',
            'ip_address' => '10.0.2.52',
            'node_type' => 'database',
            'access_type' => 'private'
        ]);

        Server::create([
            'name' => 'iaptusdbvnode25',
            'nickname' => 'Set-3B',
            'location' => 'Bracknell',
            'ip_address' => '10.0.2.53',
            'node_type' => 'database',
            'access_type' => 'private'
        ]);

        Server::create([
            'name' => 'iaptusdbvnode27',
            'nickname' => 'Set-4A',
            'location' => 'Bournemouth',
            'ip_address' => '192.168.63.27',
            'node_type' => 'database',
            'access_type' => 'private'
        ]);

        Server::create([
            'name' => 'iaptusdbvnode28',
            'nickname' => 'Set-4B',
            'location' => 'Bournemouth',
            'ip_address' => '192.168.63.28',
            'node_type' => 'database',
            'access_type' => 'private'
        ]);

        Server::create([
            'name' => 'iaptusdbvnode34',
            'nickname' => 'Set-5A',
            'location' => 'Bournemouth',
            'ip_address' => '192.168.63.34',
            'node_type' => 'database',
            'access_type' => 'private'
        ]);
        Server::create([
            'name' => 'iaptusdbvnode35',
            'nickname' => 'Set-5B',
            'location' => 'Bournemouth',
            'ip_address' => '192.168.63.35',
            'node_type' => 'database',
            'access_type' => 'private'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Tableau Servers
        |--------------------------------------------------------------------------
        |
        */

        Server::create([
            'name' => 'tblNode19',
            'nickname' => 'Tableau Reporting',
            'location' => 'Bournemouth',
            'ip_address' => '192.168.63.19',
            'node_type' => 'application',
            'access_type' => 'public'
        ]);

        Server::create([
            'name' => 'tbldbvnode24',
            'nickname' => 'Tableau DB',
            'location' => 'Bournemouth',
            'ip_address' => '192.168.63.24',
            'node_type' => 'database',
            'access_type' => 'private'
        ]);
    

        /*
        |--------------------------------------------------------------------------
        | BacPac Servers
        |--------------------------------------------------------------------------
        |
        */

        Server::create([
            'name' => 'bacpacvnode13',
            'nickname' => 'BacPac Staging',
            'location' => 'Bournemouth',
            'ip_address' => '192.168.82.13',
            'node_type' => 'application',
            'access_type' => 'public'
        ]);

        Server::create([
            'name' => 'bacpacvnode14',
            'nickname' => 'Paywall',
            'location' => 'Bracknell',
            'ip_address' => '192.168.82.14',
            'node_type' => 'application',
            'access_type' => 'public'
        ]);


        Server::create([
            'name' => 'bacpacvnode15',
            'nickname' => 'BacPac Live',
            'location' => 'Bracknell',
            'ip_address' => '192.168.83.15',
            'node_type' => 'application',
            'access_type' => 'public'
        ]);
    }
}
