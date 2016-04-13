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

        Server::create([
            'name' => 'Cloud4',
            'nickname' => 'Basement Server',
            'location' => 'Widcombe',
            'node_number' => NULL,
            'type' => 'private'
        ]);

        Server::create([
            'name' => 'vnode5',
            'nickname' => 'Webforms DB (Replication)',
            'location' => 'Bournemouth',
            'node_number' => 5,
            'type' => 'public'
        ]);

        Server::create([
            'name' => 'vnode8',
            'nickname' => 'Bournemouth 8 DB',
            'location' => 'Bournemouth',
            'node_number' => 8,
            'type' => 'public'
        ]);

        Server::create([
            'name' => 'vnode13',
            'nickname' => 'BacPac Staging',
            'location' => 'Bournemouth',
            'node_number' => 13,
            'type' => 'public'
        ]);

        Server::create([
            'name' => 'vnode14',
            'nickname' => 'Paywall',
            'location' => 'Bournemouth',
            'node_number' => 14,
            'type' => 'public'
        ]);

        Server::create([
            'name' => 'vnode15',
            'nickname' => 'BacPac Live',
            'location' => 'Bournemouth',
            'node_number' => 15,
            'type' => 'public'
        ]);

        Server::create([
            'name' => 'vnode16',
            'nickname' => 'Bracknell 16 DB',
            'location' => 'Bracknell',
            'node_number' => 16,
            'type' => 'private'
        ]);

        Server::create([
            'name' => 'tblNode17',
            'nickname' => 'Tableau',
            'location' => 'Bournemouth',
            'node_number' => 26,
            'type' => 'public'
        ]);

        Server::create([
            'name' => 'vnode18',
            'nickname' => 'Bracknell 18 DB',
            'location' => 'Bracknell',
            'node_number' => 18,
            'type' => 'private'
        ]);

        Server::create([
            'name' => 'vnode23',
            'nickname' => 'Webforms DB',
            'location' => 'Bournemouth',
            'node_number' => 23,
            'type' => 'public'
        ]);

        Server::create([
            'name' => 'vnode24',
            'nickname' => 'Postroom/API',
            'location' => 'Bracknell',
            'node_number' => 24,
            'type' => 'private'
        ]);

        Server::create([
            'name' => 'vnode26',
            'nickname' => 'Testing Server',
            'location' => 'Bracknell',
            'node_number' => 26,
            'type' => 'private'
        ]);

        Server::create([
            'name' => 'vnode27',
            'nickname' => 'Demo/Staging',
            'location' => 'Bournemouth',
            'node_number' => 27,
            'type' => 'public'
        ]);
    }
}
