<?php

use Illuminate\Database\Seeder;
use App\Models\Server;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $set1A = Server::where('name', 'iaptusdbvnode16')->first();
        $set2A = Server::where('name', 'iaptusdbvnode18')->first();
        $set3A = Server::where('name', 'iaptusdbvnode24')->first();
        $set4A = Server::where('name', 'iaptusdbvnode27')->first();
        $set5A = Server::where('name', 'iaptusdbvnode34')->first();

        Service::truncate();

        Service::create([
            'area' => 'Barnet',
            'name' => 'Barnet',
            'service_id' => 176,
            'type' => 'IAPT',
            'server_id' => $set4A->id,
            'live_site_url' => 'barnet.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Bedford',
            'name' => 'ELFT Bedford',
            'service_id' => 188,
            'type' => 'IAPT',
            'server_id' => $set4A->id,
            'live_site_url' => 'bedford.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Bolton',
            'name' => 'Bolton CYP',
            'service_id' => 164,
            'type' => 'CYP',
            'server_id' => $set4A->id,
            'live_site_url' => 'boltoncyp.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Calderdale',
            'name' => 'CAMHS (Calderdale)',
            'service_id' => 178,
            'type' => 'CAMHS',
            'server_id' => $set4A->id,
            'live_site_url' => 'calderdalecamhs.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Richmond & Kingston',
            'name' => 'CAMHSAFC (Richmond & Kingston)',
            'service_id' => 174,
            'type' => 'CAMHS',
            'server_id' => $set4A->id,
            'live_site_url' => 'camhsafc.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Camden & Islington',
            'name' => 'Camden & Islington (CANDI)',
            'service_id' => 166,
            'type' => 'IAPT',
            'server_id' => $set4A->id,
            'live_site_url' => 'candi.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Stockton-on-Tees',
            'name' => 'Catalyst',
            'service_id' => 179,
            'type' => 'IAPT',
            'server_id' => $set4A->id,
            'live_site_url' => 'catalyst.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Ealing',
            'name' => 'Ealing',
            'service_id' => 160,
            'type' => 'IAPT',
            'server_id' => $set4A->id,
            'live_site_url' => 'ealing.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Fylde and Wyre',
            'name' => 'NHS Fylde and Wyre',
            'service_id' => 186,
            'type' => 'IAPT',
            'server_id' => $set4A->id,
            'live_site_url' => 'fyldeandwyre.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Hillingdon',
            'name' => 'CNWL Hillingdon',
            'service_id' => 107,
            'type' => 'IAPT',
            'server_id' => $set4A->id,
            'live_site_url' => 'hillingdon.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Hounslow',
            'name' => 'Hounslow',
            'service_id' => 117,
            'type' => 'IAPT',
            'server_id' => $set4A->id,
            'live_site_url' => 'hounslow.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Lancashire',
            'name' => 'Lancashire Care',
            'service_id' => 173,
            'type' => 'IAPT',
            'server_id' => $set4A->id,
            'live_site_url' => 'lancashire.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Luton',
            'name' => 'ELFT Luton',
            'service_id' => 165,
            'type' => 'IAPT',
            'server_id' => $set4A->id,
            'live_site_url' => 'luton.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Online',
            'name' => 'Making Space',
            'service_id' => 175,
            'type' => 'IAPT',
            'server_id' => $set4A->id,
            'live_site_url' => 'makingspace.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Milton Keynes',
            'name' => 'CNWL Milton Keynes',
            'service_id' => 167,
            'type' => 'IAPT',
            'server_id' => $set4A->id,
            'live_site_url' => 'miltonkeynes.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Bedford, Luton & Milton Keynes',
            'name' => 'Mind BLMK',
            'service_id' => 168,
            'type' => 'IAPT',
            'server_id' => $set4A->id,
            'live_site_url' => 'mindblmk.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Northumberland',
            'name' => 'Northumberland Tyne and Wear Foundation Trust (NTW)',
            'service_id' => 161,
            'type' => 'IAPT',
            'server_id' => $set4A->id,
            'live_site_url' => 'ntw.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Norfolk',
            'name' => 'NSFT Norfolk',
            'service_id' => 181,
            'type' => 'IAPT',
            'server_id' => $set4A->id,
            'live_site_url' => 'norfolk.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'North Kent',
            'name' => 'North Kent MIND',
            'service_id' => 177,
            'type' => 'IAPT',
            'server_id' => $set4A->id,
            'live_site_url' => 'nkm.iaptus.nhs.uk/'
        ]);

        Service::create([
            'area' => 'Northamptonshire',
            'name' => 'Northamptonshire',
            'service_id' => 25,
            'type' => 'IAPT',
            'server_id' => $set4A->id,
            'live_site_url' => 'northants.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Sutton',
            'name' => 'SWLSTG Sutton',
            'service_id' => 30,
            'type' => 'IAPT',
            'server_id' => $set4A->id,
            'live_site_url' => 'sm.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'South Staffordshire',
            'name' => 'SS South Staffordshire',
            'service_id' => 195,
            'type' => 'IAPT',
            'server_id' => $set4A->id,
            'live_site_url' => 'southstaffs.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Stafford and Cannock',
            'name' => 'Starfish Stafford and Cannock',
            'service_id' => 172,
            'type' => 'IAPT',
            'server_id' => $set4A->id,
            'live_site_url' => 'starfishsc.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Suffolk',
            'name' => 'NSFT Suffolk',
            'service_id' => 187,
            'type' => 'IAPT',
            'server_id' => $set4A->id,
            'live_site_url' => 'suffolk.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Northumberland',
            'name' => 'MHM Northumberland (Talking Matters)',
            'service_id' => 191,
            'type' => 'IAPT',
            'server_id' => $set4A->id,
            'live_site_url' => 'tmn.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Newport',
            'name' => 'Thrive Psychology',
            'service_id' => 196,
            'type' => 'IAPT',
            'server_id' => $set4A->id,
            'live_site_url' => 'thrive.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Torbay',
            'name' => 'Torbay CYP',
            'service_id' => 171,
            'type' => 'CYP',
            'server_id' => $set4A->id,
            'live_site_url' => 'torbaycyp.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Wandsworth',
            'name' => 'SWLSTG Wandsworth',
            'service_id' => 13,
            'type' => 'IAPT',
            'server_id' => $set4A->id,
            'live_site_url' => 'wandsworth.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Wandsworth',
            'name' => 'Wandsworth CYP',
            'service_id' => 169,
            'type' => 'CYP',
            'server_id' => $set4A->id,
            'live_site_url' => 'wandsworthcyp.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Bath',
            'name' => 'Bath',
            'service_id' => 158,
            'type' => 'IAPT',
            'server_id' => $set1A->id,
            'live_site_url' => 'banes.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Bexley',
            'name' => 'Bexley',
            'service_id' => 40,
            'type' => 'IAPT',
            'server_id' => $set1A->id,
            'live_site_url' => 'bexley.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Birmingham and Solihull',
            'name' => 'Birmingham and Solihull Employee\'s Resolve (BSMHT)',
            'service_id' => 149,
            'type' => 'IAPT',
            'server_id' => $set1A->id,
            'live_site_url' => 'resolve.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Brent',
            'name' => 'CNWL Brent',
            'service_id' => 115,
            'type' => 'IAPT',
            'server_id' => $set1A->id,
            'live_site_url' => 'brent.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Cornwall',
            'name' => 'Cornwall (OSW)',
            'service_id' => 23,
            'type' => 'IAPT',
            'server_id' => $set1A->id,
            'live_site_url' => 'outlooksw.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Cornwall',
            'name' => 'Cornwall Foundation Trust (CFT)',
            'service_id' => 147,
            'type' => 'IAPT',
            'server_id' => $set1A->id,
            'live_site_url' => 'westminster.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Croydon',
            'name' => 'SLAM Croydon',
            'service_id' => 136,
            'type' => 'IAPT',
            'server_id' => $set1A->id,
            'live_site_url' => "croydon.iaptus.nhs.uk"
        ]);

        Service::create([
            'area' => 'Surrey & Dorking',
            'name' => 'Surrey & Dorking Healthcare',
            'service_id' => 155,
            'type' => 'IAPT',
            'server_id' => $set1A->id,
            'live_site_url' => 'dorking.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Kent East - Dover',
            'name' => 'Dover Counselling',
            'service_id' => 145,
            'type' => 'IAPT',
            'server_id' => $set1A->id,
            'live_site_url' => 'dover.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Durham and Darlington',
            'name' => 'Durham and Darlington',
            'service_id' => 111,
            'type' => 'IAPT',
            'server_id' => $set1A->id,
            'live_site_url' => 'durhamdarlington.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Kent East - Faversham',
            'name' => 'Faversham Counselling',
            'service_id' => 143,
            'type' => 'IAPT',
            'server_id' => $set1A->id,
            'live_site_url' => 'faversham.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Gloucester',
            'name' => '2gether Gloucester',
            'service_id' => 12,
            'type' => 'IAPT',
            'server_id' => $set1A->id,
            'live_site_url' => '2gether.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Hampshire',
            'name' => '2gether Hampshire',
            'service_id' => 123,
            'type' => 'IAPT',
            'server_id' => $set1A->id,
            'live_site_url' => '2gether.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Surrey',
            'name' => 'Healthy Minds Surrey (HM)',
            'service_id' => 156,
            'type' => 'IAPT',
            'server_id' => $set1A->id,
            'live_site_url' => 'hmsurrey.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Hammersmith & Fulham',
            'name' => 'Hammersmith & Fulham',
            'service_id' => 17,
            'type' => 'IAPT',
            'server_id' => $set1A->id,
            'live_site_url' => 'hammersmith.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Hartlepool',
            'name' => 'Hartlepool Mind',
            'service_id' => 137,
            'type' => 'IAPT',
            'server_id' => $set1A->id,
            'live_site_url' => 'mindrecovery.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Hull',
            'name' => 'Hull CHC',
            'service_id' => 150,
            'type' => 'IAPT',
            'server_id' => $set1A->id,
            'live_site_url' => 'hull.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Kensington & Chelsea',
            'name' => 'CNWL Kensington & Chelsea',
            'service_id' => 9,
            'type' => 'IAPT',
            'server_id' => $set1A->id,
            'live_site_url' => 'cwlcs-kc-ph.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'KentEast',
            'name' => 'Psicon',
            'service_id' => 144,
            'type' => 'IAPT',
            'server_id' => $set1A->id,
            'live_site_url' => 'https://kentpsicon.iaptus.co.uk'
        ]);

        Service::create([
            'area' => 'North Tyneside',
            'name' => 'North Tyneside',
            'service_id' => 102,
            'type' => 'IAPT',
            'server_id' => $set1A->id,
            'live_site_url' => 'northtyneside.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Oxleas',
            'name' => 'Oxleas',
            'service_id' => 29,
            'type' => 'IAPT',
            'server_id' => $set1A->id,
            'live_site_url' => 'oxleas.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Rushmoor',
            'name' => 'Rushmoor',
            'service_id' => 110,
            'type' => 'IAPT',
            'server_id' => $set1A->id,
            'live_site_url' => 'rushmoor.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'West Sussex',
            'name' => 'West Sussex',
            'service_id' => 19,
            'type' => 'IAPT',
            'server_id' => $set1A->id,
            'live_site_url' => 'westsussex.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Avon',
            'name' => 'Avon',
            'service_id' => 139,
            'type' => 'IAPT',
            'server_id' => $set2A->id,
            'live_site_url' => 'avon.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Birmingham and Solihull',
            'name' => 'Birmingham and Solihull (BSMHFT)',
            'service_id' => 153,
            'type' => 'IAPT',
            'server_id' => $set2A->id,
            'live_site_url' => 'bmht.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Berkshire',
            'name' => 'Berkshire',
            'service_id' => 18,
            'type' => 'IAPT',
            'server_id' => $set2A->id,
            'live_site_url' => 'berkshire.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Bromley',
            'name' => 'Bromley',
            'service_id' => 114,
            'type' => 'IAPT',
            'server_id' => $set2A->id,
            'live_site_url' => 'bromley.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Cumbria',
            'name' => 'Cumbria',
            'service_id' => 7,
            'type' => 'IAPT',
            'server_id' => $set2A->id,
            'live_site_url' => 'cumbria.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Devon & Torbay',
            'name' => 'Devon & Torbay',
            'service_id' => 28,
            'type' => 'IAPT',
            'server_id' => $set2A->id,
            'live_site_url' => 'devonandtorbay.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Gateshead',
            'name' => 'Gateshead',
            'service_id' => 38,
            'type' => 'IAPT',
            'server_id' => $set2A->id,
            'live_site_url' => 'gateshead.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Harrow',
            'name' => 'CNWL Harrow',
            'service_id' => 116,
            'type' => 'IAPT',
            'server_id' => $set2A->id,
            'live_site_url' => 'harrow.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Liverpool',
            'name' => 'Mersey Care Liverpool',
            'service_id' => 185,
            'type' => 'IAPT',
            'server_id' => $set2A->id,
            'live_site_url' => 'mcliverpool.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Hartlepool',
            'name' => 'Hartlepool MINDRecovery',
            'service_id' => 180,
            'type' => 'IAPT',
            'server_id' => $set2A->id,
            'live_site_url' => 'hartlepoolmind.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Bristol',
            'name' => 'Off The Record CYP',
            'service_id' => 184,
            'type' => 'IAPT',
            'server_id' => $set2A->id,
            'live_site_url' => 'otr.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Portsmouth',
            'name' => 'Portsmouth',
            'service_id' => 142,
            'type' => 'IAPT',
            'server_id' => $set2A->id,
            'live_site_url' => 'portsmouth.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'South of Tyne',
            'name' => 'South of Tyne',
            'service_id' => 8,
            'type' => 'IAPT',
            'server_id' => $set2A->id,
            'live_site_url' => 'southtyneside.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'South of Tyne',
            'name' => 'STFT CAMHS (South of Tyne)',
            'service_id' => 194,
            'type' => 'CAMHS',
            'server_id' => $set2A->id,
            'live_site_url' => 'stftcamhs.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Somerset',
            'name' => 'Somerset',
            'service_id' => 108,
            'type' => 'IAPT',
            'server_id' => $set2A->id,
            'live_site_url' => 'somerset.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Southampton',
            'name' => 'Southampton',
            'service_id' => 35,
            'type' => 'IAPT',
            'server_id' => $set2A->id,
            'live_site_url' => 'southampton.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Southampton',
            'name' => 'Southampton Counselling',
            'service_id' => 124,
            'type' => 'IAPT',
            'server_id' => $set2A->id,
            'live_site_url' => 'southampton.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Southwark',
            'name' => 'Southwark',
            'service_id' => 5,
            'type' => 'IAPT',
            'server_id' => $set2A->id,
            'live_site_url' => 'southwark.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Southwark',
            'name' => 'SLAM Lambeth',
            'service_id' => 10,
            'type' => 'IAPT',
            'server_id' => $set2A->id,
            'live_site_url' => 'lambeth.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Lewisham',
            'name' => 'SLAM Lewisham',
            'service_id' => 15,
            'type' => 'IAPT',
            'server_id' => $set2A->id,
            'live_site_url' => "lewisham.iaptus.nhs.uk"
        ]);

        Service::create([
            'area' => 'Surrey',
            'name' => 'Surrey Borders',
            'service_id' => 140,
            'type' => 'IAPT',
            'server_id' => $set2A->id,
            'live_site_url' => 'surreyborders.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Telford and Wrekin',
            'name' => 'Telford and Wrekin',
            'service_id' => 36,
            'type' => 'IAPT',
            'server_id' => $set2A->id,
            'live_site_url' => 'telfordandwrekin.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Kent',
            'name' => 'Kent University Medical Practice (UMC)',
            'service_id' => 146,
            'type' => 'IAPT',
            'server_id' => $set2A->id,
            'live_site_url' => 'umc.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Warrington',
            'name' => 'Warrington',
            'service_id' => 120,
            'type' => 'IAPT',
            'server_id' => $set2A->id,
            'live_site_url' => 'warrington.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Coventry and Warwickshire',
            'name' => 'CW Coventry',
            'service_id' => 27,
            'type' => 'IAPT',
            'server_id' => $set3A->id,
            'live_site_url' => 'cw.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Coventry and Warwickshire',
            'name' => 'CW Employees',
            'service_id' => 121,
            'type' => 'IAPT',
            'server_id' => $set3A->id,
            'live_site_url' => 'cw.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Derbyshire',
            'name' => 'TP Derbyshire',
            'service_id' => 125,
            'type' => 'IAPT',
            'server_id' => $set3A->id,
            'live_site_url' => 'derbyshire.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Dorset, Bournemouth & Poole',
            'name' => 'Dorset, Bournemouth & Poole',
            'service_id' => 1,
            'type' => 'IAPT',
            'server_id' => $set3A->id,
            'live_site_url' => 'dorset.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Hampshire',
            'name' => 'Hants Hampshire',
            'service_id' => 106,
            'type' => 'IAPT',
            'server_id' => $set3A->id,
            'live_site_url' => 'hampshire.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Wirral',
            'name' => 'IM Wirral (Inclusion matters)',
            'service_id' => 189,
            'type' => 'IAPT',
            'server_id' => $set3A->id,
            'live_site_url' => 'imwirral.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Isle of Wight',
            'name' => 'Isle of Wight',
            'service_id' => 16,
            'type' => 'IAPT',
            'server_id' => $set3A->id,
            'live_site_url' => 'iow.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Kingston',
            'name' => 'C & I Kingston',
            'service_id' => 41,
            'type' => 'IAPT',
            'server_id' => $set3A->id,
            'live_site_url' => 'kingston.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Newham',
            'name' => 'Newham',
            'service_id' => 100,
            'type' => 'IAPT',
            'server_id' => $set3A->id,
            'live_site_url' => 'newham.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'North Staffordshire',
            'name' => 'SS North Staffordshire',
            'service_id' => 31,
            'type' => 'IAPT',
            'server_id' => $set3A->id,
            'live_site_url' => 'northstaffs.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Plymouth',
            'name' => 'Plymouth',
            'service_id' => 21,
            'type' => 'IAPT',
            'server_id' => $set3A->id,
            'live_site_url' => 'plymouth.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Richmond',
            'name' => 'ELFT Richmond',
            'service_id' => 134,
            'type' => 'IAPT',
            'server_id' => $set3A->id,
            'live_site_url' => 'richmond.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Shropshire',
            'name' => 'SS Shropshire',
            'service_id' => 37,
            'type' => 'IAPT',
            'server_id' => $set3A->id,
            'live_site_url' => 'shropshire.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Buckinghamshire',
            'name' => 'SignHealth',
            'service_id' => 127,
            'type' => 'IAPT',
            'server_id' => $set3A->id,
            'live_site_url' => 'signhealth.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Teeside',
            'name' => 'Starfish AQP Teeside',
            'service_id' => 170,
            'type' => 'IAPT',
            'server_id' => $set3A->id,
            'live_site_url' => 'starfish.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Stoke on Trent',
            'name' => 'Stoke on Trent',
            'service_id' => 152,
            'type' => 'IAPT',
            'server_id' => $set3A->id,
            'live_site_url' => 'stoke.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Swindon and Wilts',
            'name' => 'Swindon and Wilts',
            'service_id' => 182,
            'type' => 'IAPT',
            'server_id' => $set3A->id,
            'live_site_url' => 'swindon.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Tower Hamlets',
            'name' => 'Tower Hamlets',
            'service_id' => 132,
            'type' => 'IAPT',
            'server_id' => $set3A->id,
            'live_site_url' => 'towerhamlets.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Wakefield',
            'name' => 'TP Wakefield',
            'service_id' => 126,
            'type' => 'IAPT',
            'server_id' => $set3A->id,
            'live_site_url' => 'wakefield.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Westminster',
            'name' => 'CNWL Westminster',
            'service_id' => 20,
            'type' => 'IAPT',
            'server_id' => $set3A->id,
            'live_site_url' => 'westminster.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Wilts',
            'name' => 'Wilts',
            'service_id' => 183,
            'type' => 'IAPT',
            'server_id' => $set3A->id,
            'live_site_url' => 'wiltshire.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Worcestershire',
            'name' => 'Worcestershire',
            'service_id' => 113,
            'type' => 'IAPT',
            'server_id' => $set3A->id,
            'live_site_url' => 'worcestershire.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Yorkshire and Humber ',
            'name' => 'Yorkshire and Humber Veteran Outreach Service (YAHVOS)',
            'service_id' => 151,
            'type' => 'IAPT',
            'server_id' => $set3A->id,
            'live_site_url' => 'yahvos.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Newcastle',
            'name' => 'THN Newcastle',
            'service_id' => 197,
            'type' => 'IAPT',
            'server_id' => $set1A->id,
            'live_site_url' => 'thn.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Thurrock',
            'name' => 'SS Thurrock',
            'service_id' => 199,
            'type' => 'IAPT',
            'server_id' => $set5A->id,
            'live_site_url' => 'thurrock.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Blackpool',
            'name' => 'Blackpool Teaching Hospital (BTH)',
            'service_id' => 192,
            'type' => 'IAPT',
            'server_id' => $set5A->id,
            'live_site_url' => 'bth.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Gateshead',
            'name' => 'Gateshead CAMHS',
            'service_id' => 200,
            'type' => 'CAMHS',
            'server_id' => $set2A->id,
            'live_site_url' => null
        ]);

        Service::create([
            'area' => 'Sunderland',
            'name' => 'Sunderland CAMHS',
            'service_id' => 201,
            'type' => 'CAMHS',
            'server_id' => $set5A->id,
            'live_site_url' => null
        ]);

        Service::create([
            'area' => 'Ingeus',
            'name' => 'Ingeus',
            'service_id' => 202,
            'type' => 'NDPP',
            'server_id' => $set5A->id,
            'live_site_url' => 'ingeus-staging.iaptus.co.uk'
        ]);

        Service::create([
            'area' => 'Avon & Wiltshire',
            'name' => 'AWP CAMHS',
            'service_id' => 203,
            'type' => 'CAMHS',
            'server_id' => $set5A->id,
            'live_site_url' => null
        ]);

        Service::create([
            'area' => 'Lincolnshire',
            'name' => 'LPFT Lincolnshire',
            'service_id' => 157,
            'type' => 'CAMHS',
            'server_id' => $set5A->id,
            'live_site_url' => 'lpft.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'North West England',
            'name' => '5BP (Five Boroughs)',
            'service_id' => 190,
            'type' => 'IAPT',
            'server_id' => $set5A->id,
            'live_site_url' => '5bp.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Ealing',
            'name' => 'ECC (Ealing Counselling Consortium)',
            'service_id' => 204,
            'type' => 'IAPT',
            'server_id' => $set5A->id,
            'live_site_url' => 'ecc.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Online',
            'name' => 'BWW (Big White Wall)',
            'service_id' => 208,
            'type' => 'IAPT',
            'server_id' => $set5A->id,
            'live_site_url' => 'https://bww.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'South Stafforshire & Shropshire',
            'name' => 'SSSFT (South Stafforshire & Shropshire Foundation Trust)',
            'service_id' => 205,
            'type' => 'IAPT',
            'server_id' => $set5A->id,
            'live_site_url' => ''
        ]);

        Service::create([
            'area' => 'Sunderland',
            'name' => 'Sunderland Counselling Service',
            'service_id' => 206,
            'type' => 'IAPT',
            'server_id' => $set5A->id,
            'live_site_url' => ''
        ]);

        Service::create([
            'area' => 'East Lancashire',
            'name' => 'ELHT CAMHS (East Lancashire Hospitals Trust)',
            'service_id' => 207,
            'type' => 'IAPT',
            'server_id' => $set5A->id,
            'live_site_url' => ''
        ]);

        Service::create([
            'area' => 'Australia',
            'name' => 'ACT PHN (Australia Capital Territory Primary Health Network)',
            'service_id' => 209,
            'type' => 'Australian IAPT',
            'server_id' => $set5A->id,
            'live_site_url' => 'https://actphn.iaptus.co.uk'
        ]);

        Service::create([
            'area' => 'London',
            'name' => 'Bikur Cholim',
            'service_id' => 210,
            'type' => 'IAPT',
            'server_id' => $set5A->id,
            'live_site_url' => ''
        ]);

        Service::create([
            'area' => 'London',
            'name' => 'Derman',
            'service_id' => 211,
            'type' => 'IAPT',
            'server_id' => $set5A->id,
            'live_site_url' => ''
        ]);

    }
}
