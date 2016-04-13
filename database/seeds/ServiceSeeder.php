<?php

use Illuminate\Database\Seeder;
use App\Library\Models\Server;
use App\Library\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bournemouth8 = Server::where('location', 'Bournemouth')->where('node_number', 8)->first();
        $bracknell16 = Server::where('location', 'Bracknell')->where('node_number', 16)->first();
        $bracknell18 = Server::where('location', 'Bracknell')->where('node_number', 18)->first();
        $bracknell24 = Server::where('location', 'Bracknell')->where('node_number', 24)->first();

        Service::truncate();

        Service::create([
            'area' => 'Barnet',
            'name' => 'Barnet',
            'service_id' => 176,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id
        ]);

        Service::create([
            'area' => 'Bedford',
            'name' => 'Bedford',
            'service_id' => 188,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id
        ]);

        Service::create([
            'area' => 'Bolton',
            'name' => 'Bolton CYP',
            'service_id' => 164,
            'type' => 'CYP',
            'server_id' => $bournemouth8->id
        ]);

        Service::create([
            'area' => 'Calderdale',
            'name' => 'calderdalecamhs',
            'service_id' => 178,
            'type' => 'CAMHS',
            'server_id' => $bournemouth8->id
        ]);

        Service::create([
            'area' => 'London',
            'name' => 'CAMHSAFC',
            'service_id' => 174,
            'type' => 'CAMHS',
            'server_id' => $bournemouth8->id
        ]);

        Service::create([
            'area' => 'Camden and Islington',
            'name' => 'Camden and Islington',
            'service_id' => 166,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id
        ]);

        Service::create([
            'area' => 'Stockton',
            'name' => 'Catalyst',
            'service_id' => 179,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id
        ]);

        Service::create([
            'area' => 'Ealing',
            'name' => 'Ealing',
            'service_id' => 160,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id
        ]);

        Service::create([
            'area' => 'Fylde and Wyre',
            'name' => 'NHS Fylde and Wyre',
            'service_id' => 186,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id
        ]);

        Service::create([
            'area' => 'Hillingdon',
            'name' => 'Hillingdon',
            'service_id' => 107,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id
        ]);

        Service::create([
            'area' => 'Hounslow',
            'name' => 'Hounslow',
            'service_id' => 117,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id
        ]);

        Service::create([
            'area' => 'Lancashire',
            'name' => 'Lancashire Care',
            'service_id' => 173,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id
        ]);

        Service::create([
            'area' => 'Luton',
            'name' => 'Luton',
            'service_id' => 165,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id
        ]);

        Service::create([
            'area' => 'Online/Cheshire',
            'name' => 'Making Space',
            'service_id' => 175,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id
        ]);

        Service::create([
            'area' => 'Milton Keynes',
            'name' => 'Milton Keynes',
            'service_id' => 167,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id
        ]);

        Service::create([
            'area' => 'Online',
            'name' => 'Mind BLMK',
            'service_id' => 168,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id
        ]);

        Service::create([
            'area' => 'Northumberland',
            'name' => 'Northumberland Tyne and Wear Foundation Trust',
            'service_id' => 161,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id
        ]);

        Service::create([
            'area' => 'Norfolk',
            'name' => 'Norfolk',
            'service_id' => 181,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id
        ]);

        Service::create([
            'area' => 'North Kent',
            'name' => 'North Kent MIND',
            'service_id' => 177,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id
        ]);

        Service::create([
            'area' => 'Northamptonshire',
            'name' => 'Northamptonshire',
            'service_id' => 25,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id
        ]);

        Service::create([
            'area' => 'Oxleas',
            'name' => 'Oxleas CYP',
            'service_id' => 163,
            'type' => 'CYP',
            'server_id' => $bournemouth8->id
        ]);

        Service::create([
            'area' => 'Sutton and Merton',
            'name' => 'Sutton and Merton',
            'service_id' => 30,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id
        ]);

        Service::create([
            'area' => 'South Staffs',
            'name' => 'South Staffs',
            'service_id' => 195,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id
        ]);

        Service::create([
            'area' => 'Staffs and Cannock',
            'name' => 'Starfish Staffs and Cannock',
            'service_id' => 172,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id
        ]);

        Service::create([
            'area' => 'Suffolk',
            'name' => 'Suffolk',
            'service_id' => 187,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id
        ]);

        Service::create([
            'area' => 'Northumberland',
            'name' => 'Northumberland Talking Matters',
            'service_id' => 191,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id
        ]);

        Service::create([
            'area' => 'Newport',
            'name' => 'Thrive Psychology',
            'service_id' => 196,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id
        ]);

        Service::create([
            'area' => 'Torbay',
            'name' => 'Torbay CYP',
            'service_id' => 171,
            'type' => 'CYP',
            'server_id' => $bournemouth8->id
        ]);

        Service::create([
            'area' => 'South West London',
            'name' => 'SWLSTG',
            'service_id' => 13,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id
        ]);

        Service::create([
            'area' => 'Wandsworth',
            'name' => 'Wandsworth CYP',
            'service_id' => 169,
            'type' => 'CYP',
            'server_id' => $bournemouth8->id
        ]);

        Service::create([
            'area' => 'Bath',
            'name' => 'Bath',
            'service_id' => 158,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id
        ]);

        Service::create([
            'area' => 'Bexley',
            'name' => 'Bexley',
            'service_id' => 40,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id
        ]);

        Service::create([
            'area' => 'Birmingham and Solihull',
            'name' => 'Birmingham and Solihull Resolve Staff Care',
            'service_id' => 149,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id
        ]);

        Service::create([
            'area' => 'Brent',
            'name' => 'Brent',
            'service_id' => 115,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id
        ]);

        Service::create([
            'area' => 'Bristol',
            'name' => 'Bristol',
            'service_id' => 104,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id
        ]);

        Service::create([
            'area' => 'Cornwall',
            'name' => 'Cornwall',
            'service_id' => 23,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id
        ]);

        Service::create([
            'area' => 'Cornwall',
            'name' => 'Cornwall Foundation Trust',
            'service_id' => 147,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id
        ]);

        Service::create([
            'area' => 'Croydon',
            'name' => 'Croydon',
            'service_id' => 136,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id
        ]);

        Service::create([
            'area' => 'Dorking',
            'name' => 'Dorking Healthcare',
            'service_id' => 155,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id
        ]);

        Service::create([
            'area' => 'Dover',
            'name' => 'Dover Counselling',
            'service_id' => 145,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id
        ]);

        Service::create([
            'area' => 'Durham and Darlington',
            'name' => 'Durham and Darlington',
            'service_id' => 111,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id
        ]);

        Service::create([
            'area' => 'Faversham',
            'name' => 'Faversham Counselling Service',
            'service_id' => 143,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id
        ]);

        Service::create([
            'area' => 'Gloucester',
            'name' => 'Gloucester',
            'service_id' => 12,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id
        ]);

        Service::create([
            'area' => 'Surrey',
            'name' => 'Healthy Minds Surrey',
            'service_id' => 156,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id
        ]);

        Service::create([
            'area' => 'Hammersmith & Fulham',
            'name' => 'Hammersmith & Fulham',
            'service_id' => 17,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id
        ]);

        Service::create([
            'area' => 'Hartlepool',
            'name' => 'Hartlepool Mind',
            'service_id' => 137,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id
        ]);

        Service::create([
            'area' => 'Hull',
            'name' => 'Hull',
            'service_id' => 150,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id
        ]);

        Service::create([
            'area' => 'Kensington & Chelsea',
            'name' => 'Kensington & Chelsea',
            'service_id' => 9,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id
        ]);

        Service::create([
            'area' => 'Kent',
            'name' => 'Psicon',
            'service_id' => 144,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id
        ]);

        Service::create([
            'area' => 'Tees',
            'name' => 'MHM Tees',
            'service_id' => 138,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id
        ]);

        Service::create([
            'area' => 'North Yorkshire',
            'name' => 'North Yorks',
            'service_id' => 135,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id
        ]);

        Service::create([
            'area' => 'North Tyneside',
            'name' => 'North Tyneside',
            'service_id' => 102,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id
        ]);

        Service::create([
            'area' => 'Oxleas',
            'name' => 'Oxleas',
            'service_id' => 29,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id
        ]);

        Service::create([
            'area' => 'Rushmoor',
            'name' => 'Rushmoor',
            'service_id' => 110,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id
        ]);

        Service::create([
            'area' => 'Tees',
            'name' => 'Tees',
            'service_id' => 26,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id
        ]);

        Service::create([
            'area' => 'West Sussex',
            'name' => 'West Sussex',
            'service_id' => 19,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id
        ]);

        Service::create([
            'area' => 'Avon',
            'name' => 'Avon',
            'service_id' => 139,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id
        ]);

        Service::create([
            'area' => 'Birmingham and Solihull',
            'name' => 'Birmingham and Solihull',
            'service_id' => 153,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id
        ]);

        Service::create([
            'area' => 'Berkshire',
            'name' => 'Berkshire',
            'service_id' => 18,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id
        ]);

        Service::create([
            'area' => 'Bromley',
            'name' => 'Bromley',
            'service_id' => 114,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id
        ]);

        Service::create([
            'area' => 'Cumbria',
            'name' => 'Cumbria',
            'service_id' => 7,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id
        ]);

        Service::create([
            'area' => 'Devon',
            'name' => 'Devon',
            'service_id' => 28,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id
        ]);

        Service::create([
            'area' => 'Gateshead',
            'name' => 'Gateshead',
            'service_id' => 38,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id
        ]);

        Service::create([
            'area' => 'Harrow',
            'name' => 'Harrow',
            'service_id' => 116,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id
        ]);

        Service::create([
            'area' => 'Liverpool',
            'name' => 'IM - Liverpool',
            'service_id' => 11,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id
        ]);

        Service::create([
            'area' => 'Liverpool',
            'name' => 'Mersey Care',
            'service_id' => 185,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id
        ]);

        Service::create([
            'area' => 'Hartlepool',
            'name' => 'MINDRecovery-Hartlepool',
            'service_id' => 180,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id
        ]);

        Service::create([
            'area' => 'Newcastle',
            'name' => 'Newcastle',
            'service_id' => 101,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id
        ]);

        Service::create([
            'area' => 'Croydon',
            'name' => 'Off The Record CYP',
            'service_id' => 184,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id
        ]);

        Service::create([
            'area' => 'Portsmouth',
            'name' => 'Portsmouth',
            'service_id' => 142,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id
        ]);

        Service::create([
            'area' => 'South of Tyne',
            'name' => 'South of Tyne',
            'service_id' => 8,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id
        ]);

        Service::create([
            'area' => 'South of Tyne',
            'name' => 'South Of Tyne CAMHS',
            'service_id' => 194,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id
        ]);

        Service::create([
            'area' => 'Somerset',
            'name' => 'Somerset',
            'service_id' => 108,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id
        ]);

        Service::create([
            'area' => 'Southampton',
            'name' => 'Southampton',
            'service_id' => 35,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id
        ]);

        Service::create([
            'area' => 'Southampton',
            'name' => 'Southampton Counselling',
            'service_id' => 124,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id
        ]);

        Service::create([
            'area' => 'Southwark',
            'name' => 'Southwark',
            'service_id' => 5,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id
        ]);

        Service::create([
            'area' => 'Southwark',
            'name' => 'SLAM - Lambeth',
            'service_id' => 10,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id
        ]);

        Service::create([
            'area' => 'Southwark',
            'name' => 'SLAM - Lewisham',
            'service_id' => 15,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id
        ]);

        Service::create([
            'area' => 'Stockport',
            'name' => 'Stockport',
            'service_id' => 39,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id
        ]);

        Service::create([
            'area' => 'Surrey',
            'name' => 'Surrey Borders',
            'service_id' => 140,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id
        ]);

        Service::create([
            'area' => 'Telford and Wrekin',
            'name' => 'Telford and Wrekin',
            'service_id' => 36,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id
        ]);

        Service::create([
            'area' => 'Trafford',
            'name' => 'Trafford',
            'service_id' => 22,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id
        ]);

        Service::create([
            'area' => 'Kent',
            'name' => 'Kent University Medical Practice',
            'service_id' => 146,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id
        ]);

        Service::create([
            'area' => 'Warrington',
            'name' => 'Warrington',
            'service_id' => 120,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id
        ]);

        Service::create([
            'area' => 'Coventry',
            'name' => 'Coventry',
            'service_id' => 27,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id
        ]);

        Service::create([
            'area' => 'Coventry and Warwickshire',
            'name' => 'CW Employees',
            'service_id' => 121,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id
        ]);

        Service::create([
            'area' => 'Derbyshire',
            'name' => 'Derbyshire',
            'service_id' => 125,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id
        ]);

        Service::create([
            'area' => 'Bournemouth & Poole',
            'name' => 'Bournemouth & Poole',
            'service_id' => 1,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id
        ]);

        Service::create([
            'area' => 'Hampshire',
            'name' => 'Hampshire',
            'service_id' => 106,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id
        ]);

        Service::create([
            'area' => 'Wirral',
            'name' => 'Inclusion Matters Wirral',
            'service_id' => 189,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id
        ]);

        Service::create([
            'area' => 'Isle of Wight',
            'name' => 'Isle of Wight',
            'service_id' => 16,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id
        ]);

        Service::create([
            'area' => 'Kingston',
            'name' => 'Kingston',
            'service_id' => 41,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id
        ]);

        Service::create([
            'area' => 'Newham',
            'name' => 'Newham',
            'service_id' => 100,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id
        ]);

        Service::create([
            'area' => 'North Staffs',
            'name' => 'North Staffs',
            'service_id' => 31,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id
        ]);

        Service::create([
            'area' => 'Plymouth',
            'name' => 'Plymouth',
            'service_id' => 21,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id
        ]);

        Service::create([
            'area' => 'Richmond',
            'name' => 'Richmond',
            'service_id' => 134,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id
        ]);

        Service::create([
            'area' => 'Sefton',
            'name' => 'Sefton',
            'service_id' => 32,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id
        ]);

        Service::create([
            'area' => 'Shropshire',
            'name' => 'Shropshire',
            'service_id' => 37,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id
        ]);

        Service::create([
            'area' => 'Buckinghamshire',
            'name' => 'SignHealth',
            'service_id' => 127,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id
        ]);

        Service::create([
            'area' => 'Teeside',
            'name' => 'Starfish',
            'service_id' => 170,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id
        ]);

        Service::create([
            'area' => 'Stoke on Trent',
            'name' => 'Stoke on Trent',
            'service_id' => 152,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id
        ]);

        Service::create([
            'area' => 'Swindon and Wilts',
            'name' => 'Swindon and Wilts',
            'service_id' => 182,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id
        ]);

        Service::create([
            'area' => 'Tower Hamlets',
            'name' => 'Tower Hamlets',
            'service_id' => 132,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id
        ]);

        Service::create([
            'area' => 'Wakefield',
            'name' => 'Wakefield',
            'service_id' => 126,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id
        ]);

        Service::create([
            'area' => 'Westminster',
            'name' => 'Westminster',
            'service_id' => 20,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id
        ]);

        Service::create([
            'area' => 'Swindon and Wilts',
            'name' => 'Swindon and Wilts',
            'service_id' => 183,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id
        ]);

        Service::create([
            'area' => 'Wirral',
            'name' => 'Wirral Assura',
            'service_id' => 130,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id
        ]);

        Service::create([
            'area' => 'Wirral',
            'name' => 'Wirral',
            'service_id' => 4,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id
        ]);

        Service::create([
            'area' => 'Worcestershire',
            'name' => 'Worcestershire',
            'service_id' => 113,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id
        ]);

        Service::create([
            'area' => 'Yorkshire and Humber ',
            'name' => 'Yorkshire and Humber Veteran Outreach Service',
            'service_id' => 151,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id
        ]);

    }
}
