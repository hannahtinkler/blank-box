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
            'server_id' => $bournemouth8->id,
            'live_site_url' => 'http://barnet.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Bedford',
            'name' => 'ELFT Bedford',
            'service_id' => 188,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id,
            'live_site_url' => 'http://bedford.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Bolton',
            'name' => 'Bolton CYP',
            'service_id' => 164,
            'type' => 'CYP',
            'server_id' => $bournemouth8->id,
            'live_site_url' => 'http://boltoncyp.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Calderdale',
            'name' => 'CAMHS (Calderdale)',
            'service_id' => 178,
            'type' => 'CAMHS',
            'server_id' => $bournemouth8->id,
            'live_site_url' => 'http://calderdalecamhs.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Richmond & Kingston',
            'name' => 'CAMHSAFC (Richmond & Kingston)',
            'service_id' => 174,
            'type' => 'CAMHS',
            'server_id' => $bournemouth8->id,
            'live_site_url' => 'http://camhsafc.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Camden & Islington',
            'name' => 'Camden & Islington (CANDI)',
            'service_id' => 166,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id,
            'live_site_url' => 'http://candi.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Stockton-on-Tees',
            'name' => 'Catalyst',
            'service_id' => 179,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id,
            'live_site_url' => 'http://catalyst.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Ealing',
            'name' => 'Ealing',
            'service_id' => 160,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id,
            'live_site_url' => 'http://ealing.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Fylde and Wyre',
            'name' => 'NHS Fylde and Wyre',
            'service_id' => 186,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id,
            'live_site_url' => 'http://fyldeandwyre.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Hillingdon',
            'name' => 'CNWL Hillingdon',
            'service_id' => 107,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id,
            'live_site_url' => 'http://hillingdon.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Hounslow',
            'name' => 'Hounslow',
            'service_id' => 117,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id,
            'live_site_url' => 'http://hounslow.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Lancashire',
            'name' => 'Lancashire Care',
            'service_id' => 173,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id,
            'live_site_url' => 'http://lancashire.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Luton',
            'name' => 'ELFT Luton',
            'service_id' => 165,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id,
            'live_site_url' => 'http://luton.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Online',
            'name' => 'Making Space',
            'service_id' => 175,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id,
            'live_site_url' => 'http://makingspace.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Milton Keynes',
            'name' => 'CNWL Milton Keynes',
            'service_id' => 167,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id,
            'live_site_url' => 'http://miltonkeynes.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Bedford, Luton & Milton Keynes',
            'name' => 'Mind BLMK',
            'service_id' => 168,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id,
            'live_site_url' => 'http://mindblmk.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Northumberland',
            'name' => 'Northumberland Tyne and Wear Foundation Trust (NTW)',
            'service_id' => 161,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id,
            'live_site_url' => 'http://ntw.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Norfolk',
            'name' => 'NSFT Norfolk',
            'service_id' => 181,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id,
            'live_site_url' => 'http://norfolk.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'North Kent',
            'name' => 'North Kent MIND',
            'service_id' => 177,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id,
            'live_site_url' => 'http://nkm.iaptus.nhs.uk/'
        ]);

        Service::create([
            'area' => 'Northamptonshire',
            'name' => 'Northamptonshire',
            'service_id' => 25,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id,
            'live_site_url' => 'http://northants.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Sutton',
            'name' => 'SWLSTG Sutton',
            'service_id' => 30,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id,
            'live_site_url' => 'http://sm.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'South Staffordshire',
            'name' => 'SS South Staffordshire',
            'service_id' => 195,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id,
            'live_site_url' => 'http://southstaffs.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Stafford and Cannock',
            'name' => 'Starfish Stafford and Cannock',
            'service_id' => 172,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id,
            'live_site_url' => 'http://starfishsc.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Suffolk',
            'name' => 'NSFT Suffolk',
            'service_id' => 187,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id,
            'live_site_url' => 'http://suffolk.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Northumberland',
            'name' => 'MHM Northumberland (Talking Matters)',
            'service_id' => 191,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id,
            'live_site_url' => 'http://tmn.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Newport',
            'name' => 'Thrive Psychology',
            'service_id' => 196,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id,
            'live_site_url' => 'http://thrive.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Torbay',
            'name' => 'Torbay CYP',
            'service_id' => 171,
            'type' => 'CYP',
            'server_id' => $bournemouth8->id,
            'live_site_url' => 'http://torbaycyp.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Wandsworth',
            'name' => 'SWLSTG Wandsworth',
            'service_id' => 13,
            'type' => 'IAPT',
            'server_id' => $bournemouth8->id,
            'live_site_url' => 'http://wandsworth.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Wandsworth',
            'name' => 'Wandsworth CYP',
            'service_id' => 169,
            'type' => 'CYP',
            'server_id' => $bournemouth8->id,
            'live_site_url' => 'http://wandsworthcyp.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Bath',
            'name' => 'Bath',
            'service_id' => 158,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id,
            'live_site_url' => 'http://banes.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Bexley',
            'name' => 'Bexley',
            'service_id' => 40,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id,
            'live_site_url' => 'http://bexley.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Birmingham and Solihull',
            'name' => 'Birmingham and Solihull Employee\'s Resolve (BSMHT)',
            'service_id' => 149,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id,
            'live_site_url' => 'http://resolve.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Brent',
            'name' => 'CNWL Brent',
            'service_id' => 115,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id,
            'live_site_url' => 'http://brent.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Cornwall',
            'name' => 'Cornwall (OSW)',
            'service_id' => 23,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id,
            'live_site_url' => 'http://outlooksw.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Cornwall',
            'name' => 'Cornwall Foundation Trust (CFT)',
            'service_id' => 147,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id,
            'live_site_url' => 'http://westminster.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Croydon',
            'name' => 'SLAM Croydon',
            'service_id' => 136,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id,
            'live_site_url' => "http://croydon.iaptus.nhs.uk"
        ]);

        Service::create([
            'area' => 'Surrey & Dorking',
            'name' => 'Surrey & Dorking Healthcare',
            'service_id' => 155,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id,
            'live_site_url' => 'http://dorking.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Kent East - Dover',
            'name' => 'Dover Counselling',
            'service_id' => 145,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id,
            'live_site_url' => 'http://dover.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Durham and Darlington',
            'name' => 'Durham and Darlington',
            'service_id' => 111,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id,
            'live_site_url' => 'http://durhamdarlington.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Kent East - Faversham',
            'name' => 'Faversham Counselling',
            'service_id' => 143,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id,
            'live_site_url' => 'http://faversham.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Gloucester',
            'name' => '2gether Gloucester',
            'service_id' => 12,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id,
            'live_site_url' => 'http://2gether.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Hampshire',
            'name' => '2gether Hampshire',
            'service_id' => 123,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id,
            'live_site_url' => 'http://2gether.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Surrey',
            'name' => 'Healthy Minds Surrey (HM)',
            'service_id' => 156,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id,
            'live_site_url' => 'http://hmsurrey.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Hammersmith & Fulham',
            'name' => 'Hammersmith & Fulham',
            'service_id' => 17,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id,
            'live_site_url' => 'http://hammersmith.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Hartlepool',
            'name' => 'Hartlepool Mind',
            'service_id' => 137,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id,
            'live_site_url' => 'http://mindrecovery.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Hull',
            'name' => 'Hull CHC',
            'service_id' => 150,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id,
            'live_site_url' => 'http://hull.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Kensington & Chelsea',
            'name' => 'CNWL Kensington & Chelsea',
            'service_id' => 9,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id,
            'live_site_url' => 'http://cwlcs-kc-ph.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'KentEast',
            'name' => 'Psicon',
            'service_id' => 144,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id,
            'live_site_url' => 'https://kentpsicon.iaptus.co.uk'
        ]);

        Service::create([
            'area' => 'North Tyneside',
            'name' => 'North Tyneside',
            'service_id' => 102,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id,
            'live_site_url' => 'http://northtyneside.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Oxleas',
            'name' => 'Oxleas',
            'service_id' => 29,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id,
            'live_site_url' => 'http://oxleas.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Rushmoor',
            'name' => 'Rushmoor',
            'service_id' => 110,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id,
            'live_site_url' => 'http://rushmoor.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'West Sussex',
            'name' => 'West Sussex',
            'service_id' => 19,
            'type' => 'IAPT',
            'server_id' => $bracknell16->id,
            'live_site_url' => 'http://westsussex.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Avon',
            'name' => 'Avon',
            'service_id' => 139,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id,
            'live_site_url' => 'http://avon.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Birmingham and Solihull',
            'name' => 'Birmingham and Solihull (BSMHFT)',
            'service_id' => 153,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id,
            'live_site_url' => 'http://bmht.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Berkshire',
            'name' => 'Berkshire',
            'service_id' => 18,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id,
            'live_site_url' => 'http://berkshire.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Bromley',
            'name' => 'Bromley',
            'service_id' => 114,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id,
            'live_site_url' => 'http://bromley.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Cumbria',
            'name' => 'Cumbria',
            'service_id' => 7,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id,
            'live_site_url' => 'http://cumbria.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Devon & Torbay',
            'name' => 'Devon & Torbay',
            'service_id' => 28,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id,
            'live_site_url' => 'http://devonandtorbay.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Gateshead',
            'name' => 'Gateshead',
            'service_id' => 38,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id,
            'live_site_url' => 'http://gateshead.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Harrow',
            'name' => 'CNWL Harrow',
            'service_id' => 116,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id,
            'live_site_url' => 'http://harrow.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Liverpool',
            'name' => 'Mersey Care Liverpool',
            'service_id' => 185,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id,
            'live_site_url' => 'http://mcliverpool.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Hartlepool',
            'name' => 'Hartlepool MINDRecovery',
            'service_id' => 180,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id,
            'live_site_url' => 'http://hartlepoolmind.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Bristol',
            'name' => 'Off The Record CYP',
            'service_id' => 184,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id,
            'live_site_url' => 'http://otr.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Portsmouth',
            'name' => 'Portsmouth',
            'service_id' => 142,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id,
            'live_site_url' => 'http://portsmouth.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'South of Tyne',
            'name' => 'South of Tyne',
            'service_id' => 8,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id,
            'live_site_url' => 'http://southtyneside.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'South of Tyne',
            'name' => 'STFT CAMHS (South of Tyne)',
            'service_id' => 194,
            'type' => 'CAMHS',
            'server_id' => $bracknell18->id,
            'live_site_url' => 'http://stftcamhs.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Somerset',
            'name' => 'Somerset',
            'service_id' => 108,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id,
            'live_site_url' => 'http://somerset.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Southampton',
            'name' => 'Southampton',
            'service_id' => 35,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id,
            'live_site_url' => 'http://southampton.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Southampton',
            'name' => 'Southampton Counselling',
            'service_id' => 124,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id,
            'live_site_url' => 'http://southampton.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Southwark',
            'name' => 'Southwark',
            'service_id' => 5,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id,
            'live_site_url' => 'http://southwark.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Southwark',
            'name' => 'SLAM Lambeth',
            'service_id' => 10,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id,
            'live_site_url' => 'http://lambeth.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Lewisham',
            'name' => 'SLAM Lewisham',
            'service_id' => 15,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id,
            'live_site_url' => "http://lewisham.iaptus.nhs.uk"
        ]);

        Service::create([
            'area' => 'Surrey',
            'name' => 'Surrey Borders',
            'service_id' => 140,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id,
            'live_site_url' => 'http://surreyborders.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Telford and Wrekin',
            'name' => 'Telford and Wrekin',
            'service_id' => 36,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id,
            'live_site_url' => 'http://telfordandwrekin.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Kent',
            'name' => 'Kent University Medical Practice (UMC)',
            'service_id' => 146,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id,
            'live_site_url' => 'http://umc.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Warrington',
            'name' => 'Warrington',
            'service_id' => 120,
            'type' => 'IAPT',
            'server_id' => $bracknell18->id,
            'live_site_url' => 'http://warrington.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Coventry and Warwickshire',
            'name' => 'CW Coventry',
            'service_id' => 27,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id,
            'live_site_url' => 'http://cw.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Coventry and Warwickshire',
            'name' => 'CW Employees',
            'service_id' => 121,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id,
            'live_site_url' => 'http://cw.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Derbyshire',
            'name' => 'TP Derbyshire',
            'service_id' => 125,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id,
            'live_site_url' => 'http://derbyshire.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Dorset, Bournemouth & Poole',
            'name' => 'Dorset, Bournemouth & Poole',
            'service_id' => 1,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id,
            'live_site_url' => 'http://dorset.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Hampshire',
            'name' => 'Hants Hampshire',
            'service_id' => 106,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id,
            'live_site_url' => 'http://hampshire.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Wirral',
            'name' => 'IM Wirral (Inclusion matters)',
            'service_id' => 189,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id,
            'live_site_url' => 'http://imwirral.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Isle of Wight',
            'name' => 'Isle of Wight',
            'service_id' => 16,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id,
            'live_site_url' => 'http://iow.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Kingston',
            'name' => 'C & I Kingston',
            'service_id' => 41,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id,
            'live_site_url' => 'http://kingston.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Newham',
            'name' => 'Newham',
            'service_id' => 100,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id,
            'live_site_url' => 'http://newham.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'North Staffordshire',
            'name' => 'SS North Staffordshire',
            'service_id' => 31,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id,
            'live_site_url' => 'http://northstaffs.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Plymouth',
            'name' => 'Plymouth',
            'service_id' => 21,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id,
            'live_site_url' => 'http://plymouth.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Richmond',
            'name' => 'ELFT Richmond',
            'service_id' => 134,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id,
            'live_site_url' => 'http://richmond.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Shropshire',
            'name' => 'SS Shropshire',
            'service_id' => 37,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id,
            'live_site_url' => 'http://shropshire.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Buckinghamshire',
            'name' => 'SignHealth',
            'service_id' => 127,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id,
            'live_site_url' => 'http://signhealth.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Teeside',
            'name' => 'Starfish AQP Teeside',
            'service_id' => 170,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id,
            'live_site_url' => 'http://starfish.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Stoke on Trent',
            'name' => 'Stoke on Trent',
            'service_id' => 152,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id,
            'live_site_url' => 'http://stoke.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Swindon and Wilts',
            'name' => 'Swindon and Wilts',
            'service_id' => 182,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id,
            'live_site_url' => 'http://swindon.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Tower Hamlets',
            'name' => 'Tower Hamlets',
            'service_id' => 132,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id,
            'live_site_url' => 'http://towerhamlets.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Wakefield',
            'name' => 'TP Wakefield',
            'service_id' => 126,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id,
            'live_site_url' => 'http://wakefield.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Westminster',
            'name' => 'CNWL Westminster',
            'service_id' => 20,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id,
            'live_site_url' => 'http://westminster.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Wilts',
            'name' => 'Wilts',
            'service_id' => 183,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id,
            'live_site_url' => 'http://wiltshire.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Worcestershire',
            'name' => 'Worcestershire',
            'service_id' => 113,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id,
            'live_site_url' => 'http://worcestershire.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Yorkshire and Humber ',
            'name' => 'Yorkshire and Humber Veteran Outreach Service (YAHVOS)',
            'service_id' => 151,
            'type' => 'IAPT',
            'server_id' => $bracknell24->id,
            'live_site_url' => 'http://yahvos.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Newcastle',
            'name' => 'THN Newcastle',
            'service_id' => 197,
            'type' => 'IAPT',
            'server_id' => null,
            'live_site_url' => 'http://thn.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Thurrock',
            'name' => 'SS Thurrock',
            'service_id' => 199,
            'type' => 'IAPT',
            'server_id' => null,
            'live_site_url' => 'http://thurrock.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Blackpool',
            'name' => 'Blackpool Teaching Hospital (BTH)',
            'service_id' => 192,
            'type' => 'IAPT',
            'server_id' => null,
            'live_site_url' => 'http://bth.iaptus.nhs.uk'
        ]);

        Service::create([
            'area' => 'Gateshead',
            'name' => 'Gateshead CAMHS',
            'service_id' => 200,
            'type' => 'CAMHS',
            'server_id' => null,
            'live_site_url' => null
        ]);

        Service::create([
            'area' => 'Sunderland',
            'name' => 'Sunderland CAMHS',
            'service_id' => 201,
            'type' => 'CAMHS',
            'server_id' => null,
            'live_site_url' => null
        ]);

        Service::create([
            'area' => 'Lincolnshire',
            'name' => 'LPFT Lincolnshire',
            'service_id' => 157,
            'type' => 'CAMHS',
            'server_id' => null,
            'live_site_url' => 'http://lpft.iaptus.nhs.uk'
        ]);

    }
}
