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
            'node_number' => 4,
            'access' => 'private',
            'type' => 'Application, Database'
        ]);

        Server::create([
            'name' => 'maydenasvnode1',
            'nickname' => 'iaptus Demo',
            'location' => 'Bournemouth',
            'node_number' => 1,
            'access' => 'public',
            'type' => 'Application'
        ]);

        Server::create([
            'name' => 'maydenasvnode5',
            'nickname' => 'Webforms DB (Slave)',
            'location' => 'Bournemouth',
            'node_number' => 5,
            'access' => 'public',
            'type' => 'Application'
        ]);

        Server::create([
            'name' => 'maydenasvnod23',
            'nickname' => 'Webforms DB',
            'location' => 'Bournemouth',
            'node_number' => 5,
            'access' => 'public',
            'type' => 'Application'
        ]);

        Server::create([
            'name' => 'iaptusvnode7',
            'nickname' => 'iaptus Application (Source Host)',
            'location' => 'Bournemouth',
            'node_number' => 7,
            'access' => 'private',
            'type' => 'Application'
        ]);

        Server::create([
            'name' => 'iaptusvnode14',
            'nickname' => 'iaptus Application (Source Host)',
            'location' => 'Bracknell',
            'node_number' => 14,
            'access' => 'private',
            'type' => 'Application'
        ]);


        Server::create([
            'name' => 'iaptusvnode22',
            'nickname' => 'iaptus Application',
            'location' => 'Bracknell',
            'node_number' => 23,
            'access' => 'private',
            'type' => 'Application'
        ]);


        Server::create([
            'name' => 'iaptusvnode26',
            'nickname' => 'iaptus Application (Testing)',
            'location' => 'Bracknell',
            'node_number' => 26,
            'access' => 'private',
            'type' => 'Application'
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
            'node_number' => 12,
            'access' => 'private',
            'type' => 'Loadbalancer'
        ]);

        Server::create([
            'name' => 'lbnode13',
            'nickname' => 'Nginx Loadbalancer Failover',
            'location' => 'Bracknell',
            'node_number' => 13,
            'access' => 'private',
            'type' => 'Loadbalancer'
        ]);

        Server::create([
            'name' => 'lbnode30',
            'nickname' => 'Nginx Loadbalancer',
            'location' => 'Bournemouth',
            'node_number' => 30,
            'access' => 'private',
            'type' => 'Loadbalancer'
        ]);

        Server::create([
            'name' => 'lbnode31',
            'nickname' => 'Nginx Loadbalancer Failover',
            'location' => 'Bournemouth',
            'node_number' => 31,
            'access' => 'private',
            'type' => 'Loadbalancer'
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
            'node_number' => 16,
            'access' => 'private',
            'type' => 'Database'
        ]);

        Server::create([
            'name' => 'iaptusdbvnode17',
            'nickname' => 'Set-1B',
            'location' => 'Bracknell',
            'node_number' => 17,
            'access' => 'private',
            'type' => 'Database'
        ]);

        Server::create([
            'name' => 'iaptusdbvnode18',
            'nickname' => 'Set-2A',
            'location' => 'Bracknell',
            'node_number' => 18,
            'access' => 'private',
            'type' => 'Database'
        ]);

        Server::create([
            'name' => 'iaptusdbvnode19',
            'nickname' => 'Set-2B',
            'location' => 'Bracknell',
            'node_number' => 19,
            'access' => 'private',
            'type' => 'Database'
        ]);

        Server::create([
            'name' => 'iaptusdbvnode21',
            'nickname' => 'Stats Archive A',
            'location' => 'Bracknell',
            'node_number' => 21,
            'access' => 'private',
            'type' => 'Database'
        ]);

        Server::create([
            'name' => 'iaptusdbvnode26',
            'nickname' => 'Stats Archive B',
            'location' => 'Bracknell',
            'node_number' => 26,
            'access' => 'private',
            'type' => 'Database'
        ]);

        Server::create([
            'name' => 'iaptusdbvnode24',
            'nickname' => 'Set-3A',
            'location' => 'Bracknell',
            'node_number' => 24,
            'access' => 'private',
            'type' => 'Database'
        ]);

        Server::create([
            'name' => 'iaptusdbvnode25',
            'nickname' => 'Set-3B',
            'location' => 'Bracknell',
            'node_number' => 25,
            'access' => 'private',
            'type' => 'Database'
        ]);

        Server::create([
            'name' => 'iaptusdbvnode27',
            'nickname' => 'Set-4A',
            'location' => 'Bournemouth',
            'node_number' => 27,
            'access' => 'private',
            'type' => 'Database'
        ]);

        Server::create([
            'name' => 'iaptusdbvnode28',
            'nickname' => 'Set-4B',
            'location' => 'Bournemouth',
            'node_number' => 28,
            'access' => 'private',
            'type' => 'Database'
        ]);

        Server::create([
            'name' => 'iaptusdbvnode34',
            'nickname' => 'Set-5A',
            'location' => 'Bournemouth',
            'node_number' => 34,
            'access' => 'private',
            'type' => 'Database'
        ]);
        Server::create([
            'name' => 'iaptusdbvnode35',
            'nickname' => 'Set-5B',
            'location' => 'Bournemouth',
            'node_number' => 35,
            'access' => 'private',
            'type' => 'Database'
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
            'node_number' => 17,
            'access' => 'public',
            'type' => 'Application'
        ]);

        Server::create([
            'name' => 'tbldbvnode24',
            'nickname' => 'Tableau DB',
            'location' => 'Bournemouth',
            'node_number' => 24,
            'access' => 'private',
            'type' => 'Database'
        ]);
    

        /*
        |--------------------------------------------------------------------------
        | BacPac Servers
        |--------------------------------------------------------------------------
        |
        */

        Server::create([
            'name' => 'bacpacvnode13',
            'nickname' => 'Application (BacPac Staging)',
            'location' => 'Bournemouth',
            'node_number' => 13,
            'access' => 'public',
            'type' => 'Application'
        ]);

        Server::create([
            'name' => 'bacpacvnode14',
            'nickname' => 'Application Application (Paywall)',
            'location' => 'Bracknell',
            'node_number' => 14,
            'access' => 'private',
            'type' => 'Application'
        ]);


        Server::create([
            'name' => 'bacpacvnode15',
            'nickname' => 'Application Server (BacPac Live)',
            'location' => 'Bracknell',
            'node_number' => 15,
            'access' => 'public',
            'type' => 'Application'
        ]);
    }
}
