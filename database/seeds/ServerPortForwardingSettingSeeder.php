<?php

use Illuminate\Database\Seeder;
use App\Library\Models\ServerPortForwardingSetting;
use App\Library\Models\Server;

class ServerPortForwardingSettingSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vn7 = Server::where('name', 'iaptusvnode7')->first();
        $vn14 = Server::where('name', 'iaptusvnode14')->first();
        $statsA = Server::where('name', 'iaptusdbvnode21')->first();
        $statsB = Server::where('name', 'iaptusdbvnode26')->first();
        $set1A = Server::where('name', 'iaptusdbvnode16')->first();
        $set1B = Server::where('name', 'iaptusdbvnode17')->first();
        $set2A = Server::where('name', 'iaptusdbvnode18')->first();
        $set2B = Server::where('name', 'iaptusdbvnode19')->first();
        $set3A = Server::where('name', 'iaptusdbvnode24')->first();
        $set3B = Server::where('name', 'iaptusdbvnode25')->first();
        $set4A = Server::where('name', 'iaptusdbvnode27')->first();
        $set4B = Server::where('name', 'iaptusdbvnode28')->first();
        $set5A = Server::where('name', 'iaptusdbvnode34')->first();
        $set5B = Server::where('name', 'iaptusdbvnode35')->first();
        $bacpac13 = Server::where('name', 'bacpacvnode13')->first();
        $bacpac15 = Server::where('name', 'bacpacvnode15')->first();
        $demo = Server::where('name', 'maydenasvnode1')->first();

        ServerPortForwardingSetting::truncate();

        ServerPortForwardingSetting::create([
            'server_id' => $demo->id,
            'source_port_number' => 3306,
            'target_port_number' => 63306
        ]);

        ServerPortForwardingSetting::create([
            'server_id' => $bacpac13->id,
            'source_port_number' => 3306,
            'target_port_number' => 13306
        ]);

        ServerPortForwardingSetting::create([
            'server_id' => $bacpac15->id,
            'source_port_number' => 3306,
            'target_port_number' => 13306
        ]);

        ServerPortForwardingSetting::create([
            'server_id' => $statsA->id,
            'source_port_number' => 3306,
            'target_port_number' => 64306
        ]);

        ServerPortForwardingSetting::create([
            'server_id' => $statsB->id,
            'source_port_number' => 3306,
            'target_port_number' => 57306
        ]);

        ServerPortForwardingSetting::create([
            'server_id' => $set1A->id,
            'source_port_number' => 3306,
            'target_port_number' => 53306
        ]);

        ServerPortForwardingSetting::create([
            'server_id' => $set1B->id,
            'source_port_number' => 3306,
            'target_port_number' => 53307
        ]);

        ServerPortForwardingSetting::create([
            'server_id' => $set2A->id,
            'source_port_number' => 3306,
            'target_port_number' => 54306
        ]);

        ServerPortForwardingSetting::create([
            'server_id' => $set2B->id,
            'source_port_number' => 3306,
            'target_port_number' => 54307
        ]);

        ServerPortForwardingSetting::create([
            'server_id' => $set3A->id,
            'source_port_number' => 3306,
            'target_port_number' => 55306
        ]);

        ServerPortForwardingSetting::create([
            'server_id' => $set3B->id,
            'source_port_number' => 3306,
            'target_port_number' => 55307
        ]);

        ServerPortForwardingSetting::create([
            'server_id' => $set4A->id,
            'source_port_number' => 3306,
            'target_port_number' => 38306
        ]);

        ServerPortForwardingSetting::create([
            'server_id' => $set4B->id,
            'source_port_number' => 3306,
            'target_port_number' => 38307
        ]);

        ServerPortForwardingSetting::create([
            'server_id' => $set5A->id,
            'source_port_number' => 3306,
            'target_port_number' => 38308
        ]);

        ServerPortForwardingSetting::create([
            'server_id' => $set5B->id,
            'source_port_number' => 3306,
            'target_port_number' => 38309
        ]);

        ServerPortForwardingSetting::create([
            'server_id' => $vn7->id,
            'source_port_number' => 6080,
            'target_port_number' => 8000
        ]);

        ServerPortForwardingSetting::create([
            'server_id' => $vn7->id,
            'source_port_number' => 443,
            'target_port_number' => 8443
        ]);

        ServerPortForwardingSetting::create([
            'server_id' => $vn7->id,
            'source_port_number' => 60443,
            'target_port_number' => 9443
        ]);

        ServerPortForwardingSetting::create([
            'server_id' => $vn14->id,
            'source_port_number' => 80,
            'target_port_number' => 8000
        ]);

        ServerPortForwardingSetting::create([
            'server_id' => $vn14->id,
            'source_port_number' => 443,
            'target_port_number' => 8443
        ]);
    }
}
