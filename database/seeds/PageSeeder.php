<?php

use Illuminate\Database\Seeder;
use App\Library\Models\Chapter;
use App\Library\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $serverChapter = Chapter::where('slug', 'Servers')->first();
        $serviceChapter = Chapter::where('slug', 'Services')->first();
        $monitoringChapter = Chapter::where('slug', 'Monitoring')->first();

        Page::truncate();

        Page::create([
            'chapter_id' => $serverChapter->id,
            'title' => 'Server Details',
            'description' => "A list of iaptus servers, detailing their locations, nodes and type.",
            'content' => null,
            'slug' => str_slug('Server Details'),
            'order' => 1
        ]);

        Page::create([
            'chapter_id' => $serviceChapter->id,
            'title' => 'Service Details',
            'description' => "A list of all iaptus clients, along with their service details and database locations.",
            'content' => null,
            'slug' => str_slug('Service Details'),
            'order' => 1
        ]);

        Page::create([
            'chapter_id' => $serverChapter->id,
            'title' => 'SSH Config Generator',
            'description' => "Generate a SSH config file for the Mayden servers from your SSH key names.",
            'content' => null,
            'slug' => str_slug('SSH Config Generator'),
            'order' => 3
        ]);

        Page::create([
            'chapter_id' => $monitoringChapter->id,
            'title' => 'Sensu Process Diagram',
            'description' => "A diagram showing the process Mayden use to operate Sensu monitoring.",
            'content' => '<div class="diagram"><div class="mxgraph" style="position:relative;overflow:auto;width:100%;">
<div style="width:1px;height:1px;overflow:hidden;">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</div>
</div></div>
<script type="text/javascript" src="https://www.draw.io/embed.js?s=flowchart"></script>',
            'slug' => str_slug('Sensu Process Diagram'),
            'order' => 1
        ]);

        Page::create([
            'chapter_id' => $serverChapter->id,
            'title' => 'Server Map',
            'description' => "A diagram showing the iaptus servers, their associated modules and databases, and places where communication happens between servers and modules.",
            'content' => '<div class="diagram"><div class="mxgraph" style="position:relative;overflow:auto;width:100%;">
<div style="width:1px;height:1px;overflow:hidden;">7V3bl9o40v9rcs7sQ+dgDAYe08n0bHbS8/VJ9/lm99ENbtobg1ljkvT89VOyVUaS5QtYsowxPAACfFH9VFWq6zv74+bnb5G7e70PV17wbjxa/Xxnf3o3Ho/tuQ0vZOQtHbHs0TQdWUf+io4dBx79vzw6OKKjB3/l7bkfxmEYxP6OH1yG2623jLkxN4rCH/zPXsKAP+vOXeMZjwOPSzfIj/7pr+JXOjoZ0esjX/zT89eveOo5fvPsLr+to/CwpSd8N7bvkkf69cbFg9Hf71/dVfiDG/o5Sj8u0o9v9OMcT73lrvGvMNxwA5G3z+aTHvHFp9eJFxlGKy+i1KJjgb/9xs6a/StQOApD+Cd5t/n50QsIlZF+6d/uCr7NJjDytty5i/4wnTjjqTsZeY7n2bPJ8sYeU8h8d4MDvR06ZfEb0unHqx97jzt3ST7/ADC+s29f400Anyx4m9DBI2eAObzNppp8WAfuntwueb8MN/6Svg/cZy+4zYj4MQxCMlHbcAunuH3xgwCHCGVn5EnGw21MUQwQTj8zv3Ms8oRxN/DXhHyB9wKzcruPo/Cbx/zw44w84Rt6614Ue3RVSWb0SCdYiV648eLojeCHzuiIIoYuQnsySz//OCJ6MqHUf2XAPJvRQZfiYZ0d+0hAeENpWJuekw7S8zy6FcEgR8/bT+Sphp42nS7kqdOphJ6OhJ5jBIJSetLr56jpBGR2Vv53eLsmb3FoT7gWS2nnfwfCWZIJv0n51Qf4wdja/YSX5J+EI3k3eCPkW+s9OQf9J57Cd3fxYY8ngttIz8Wf/zkSR+CH3HUKQARs7cjb5eGZ4KQCl5ThLirxtgtcf3sTAYSb48EZoYCgFHKcHB6ACcjWt47lnYPDbXiItt4mPMDFiNMLd02mnZ1CbulI2C0dwpW4hFkiIuyWzKEPkvsD/WLjr1bkNFKahfDrlyBhGq/wOw/+wPEAR81SnY0oKShpHOSoDGksVIn4paqBNDK+W7hSyWzUWanWnKxUcTGWrrf00OXLUNN1ATlOuowibvAGPCnRnKo4QrrQn8mMK5DkU571z1Bqs5xfstBRGChFU14rA3zd0VHZnLkRHKpqvsRFSDlq8j6dy90h2sGxFfDNTLHuwGxSPjGszUtdm7MuoYkKdgZN9H4uYV3O5vTyuzCTlOGy6kwESt02+VvhQjhZzey5HjRd8ItDpgfNpTsWHRsWelCGph92u2sjiYN2JFxlC6oeVqwyWwtJ8ruGT1e3SEQJMh/RWamgiJ5Fkt8sXB9FRH07M+4aoUhe4b5CtpVTDhZ0WoywLcpCGZL8sfa3RLd1N2RSts978lJp/apn4frCahO8deu6QDCfUO6UgSBv8ZrRo3IgQM+QUhBQrl1L2d6GcQ0zYoGyTcyKqa69jtz0opvOI2+ekmnajsQ6pUfTptfCzJq3Amcc/RhG8Wu4Drdu8OtxVHAEMFPo/fTjf5Ph9+A+Sj/+B7/awqWm3yVfkY/kO3KE/3px/Ean3j3EIcF0duIvYQiEklLI264+EHfjcSHByB0sL3rc9NbI/ZSTCtybbrT26JDcSpAnZ+QFbux/548tIw7960PoJxt15KkTXhV05ov3NvOgCMAD7sGeu/ToMQSCZxd1rm9ICwYYADA07ywE0gku35CWwiThjk1hAjdDmEz2gx0hOPhXilA0nfHKkkM3dEd4pEdUBxaZX7jBljz314eQSE3wqsM91P3Ph4fP2uxV9V2YR6uMIuuWNULZiarwNC9yrZFE5qJ+ptbJVGwurW2DTDyMoor1EPl7oHepHbKJ4VN60kcveIEvv3ovHqyQgPVhtmOOlV7Vvf/tG8F+E5usUkCLMRNwWH+7xhiA9NNTwp6ZgS/Jj1OnPh26DeM4CZUhrJ+OfaWAJUPpwnkDCBJmzogXcslq1hK/hwEPID0Iaw6jaqV+h23eWHyqtz4FUKG33n4/lq61j08sr5S56xtEEJx3TX96zy9htKkKI6i9BPVe7b2/vowL/fz0+2Vc6G/A/wmTO+VSu8HzgOF0meeNhT2GNUIjWQXPs7QELU1O0h1rC9JJR/2t0uv6BDE5bbtcDaqwU95mNF5IbB30J9ptHWh3aRg0V89sqMY7//9/QHQ3CfGoAsx5YXeduXmpWNh78Y3tnnfvpgMM88GtnNyYq1JqcaGU2BLbc9ujtLk4Y6JCSxEymVJTUWpEaWArOj9+LO+GvwweCPuly+EDIrbQf+CBb6b5qkc1CpU63KBykccSpU5PQOJJkejmRZL0Cs7aG/Hbq3o3cX4k/EXYK8cTwXVv1F6JcQRN7JVq9hbKdxGPsQsub9YO0feNhDWhcTld2ElM6bWoVnRmfVN0UulgRNHRk3eh09bQ7CKeIlhtZTzhklf/MR23C6tfjxlLugfugBlL7kbIvLTXY8ri1W4bPe9GIKjAFasGb8qRRVWbm1OBftnKDW8mNYutYtfk1bA3iUey7xjMgnU7gUEq7i/SkthSTBqa8sqD0oxZGhEXqkl4bRRMrRhGKJiPqL6cXW6nSNg0NPR8EuoJ7e3VIqQyrZyCiU5khIKaTE19omCd6Ox0x2SEghRgAwWLbYl0a11OQXOqzOXFLTW7iIcPbOx9f8yIaDahW5wJMteKLY6WCGCsF6W2hFdKz5NKeN37+6WqONFmsPvl8f6RXDzJ/Bjdh1s/DiMwBf3jYnbhBbGiNDSUCRbNIkOZMYwMZYZokCk5VGFGqAbz0wQZHuu2RUc/tzB0uG0dutouUV6q0mjqyMOUSCbkIWb5qqUQvpclDHL0Sb47l0J7mNMYdZolKVtJilWmw1SxOWZuY/VZmSBqTGTMpOuoA3XWAbWVIxZlvyylmixVnsKE6SqnMEbDlMcCGtuY4OUxGsj/QaXmLpc1KJDMUOv1JXnoqXwAYbZ8XNMCF4eJkiQodPu6MKv2nC0s3FqsOV0+yusCQOqNADbUvCpKAVQf6Zj+g4dKb1BLVYGZpsoScxano/cQOZh+fPAiH643Kaye6QsN4MvA8KgmHJFILqrDoqcWgtMk1LZLFliWxWfiLmgwTyGOxwthRfB/UF/kYJYvMaRib56EtxftzcfWe0dqi3HffrjHuofaMjlrX5AaDzspddaPgP7SBFE29SdvBmC3/Er0lJEQRyIJk7OxCqT+eqj5Gk3t5BN/etu6pAfBeHQHQRxdy3bni5V0OC2brZCR1Mhgc/EuJ0e743UpRGk4xTXMGt/QQMcZ33SsWawH2/XNhUbtTODtOV1NkYaGOkaphpayUBPGgbmm4I8BCLmZrmMlSnt6lXCRkf1+5kxmo+l8PranQrcaEPo6IFKcX9W6lpwkiZKCxoPyeKYgWmAdEDQWoFOelUOt6Y7Yw+4U3bG2YnPyDkYKOULvB5dombWz8UrLx2pRjzLTa3MFSQK9NhSkxUJI/JtSwcniEkMVWVxOKJ7V4rIDzskrEYt19KOUZxWLRduaty8WO2Q8SsUiMPJBLJ6d0y7YVAzLxTNsKsbk4heyQxmEopbKbkJ7UbNSEc2MnZGKxYEdrbl1tMSMoFpcbjRIoGDCaLDomtGgtzigq7irODCQdmITjYMJEiPlfemA6Bq+Coig96U8hsFY8BHu6kzGEHYBB3AqOpD0HNGPizodLxrD4qzAgAU6H7CXAe3RWxQXIP4eO6drCwvAhjfGu24/efs4MTiNHr0IFMkr7L8NBm+hDB5s5/POblmxMS3pHOB770MzWb3mCCCGEkOEmWaz4GQRymlnsRQmmqRmhfQus+EsrFehIYPh2cx7s66w0x9QRXQDYcvSqlhnHYYF4PJDR0wJ45mg5dpIT8yRptBe1U4QUbtWqMjz+IL8g1HyyKnwzZLESpV0qnGoD0C3MDU106wWCyBAnRj002OBhdBeC5w05cHAltBCWfyHerXfGrXv9EtrpFwd4Mt3rthDvGJZNE2ZawvJ0LyvbSRLurCrSd3O9eevqhtwwVllR0g3lOqY2JPRH0NBjTTolzQfN2PdSAv+V8Vydcuooaq2v9DwEVStfJM6CBFuy6ghaX8+GDV6ZdQQyqpb8DS4CZf0difbvRxlf8ECnWxtkLJZ7vsOkbeEW2MsolHVeAEr2aslIwqoboiSqvCnnkoSIWzJXuTtOC1KEryBQZL0VZKIBYQNixLy50GUnCFKkE8cZYkktKxFWdJCAcyyegEpga/e9oIivdz2ki46E/EkFnKfC4g967uZrk5FXbq1NAOVFuqXzUpij8h3XYFKGSBQISUmyDyyZnPyVImbOjVLqCJpBjcdqKY9iCIs4lpeHNFYYKNlF6cuGtj8glp4jbtfwUnozPONKFvc/OJevAgSEvKTXcYN3TAQCtM9Q+Fet3n2z+P900PdiEITlT7qZO0wRTxo1g4zYrrUB5ZUwOaoJF29TqEPrNOoGJNDEEc+d7WycXNzLQfFQ7mWk3IMM/JLSxf3+pH5SY+mrqnH5OBycCgMza/VTMZIdMME7XaYbkhDYopiG8TfT6Fqo97IBjxha6jNeNu1o7YmR0utAm0DN6uAhzkiQKcy4Iq/h8hLzUkl1mTwjPTcMzLFDkWo+UmCOtpzjEjKfkMBm3QRXZOjQ6TKQpI/1F5MNVaVGGxLnG1pApHvbdqua5muU45tRDnHrvuDsOirsJgJCTiGhUW+GfRVCguRKoaFhZYt+iAsTt341BIW5jwRWOuHWbwg3+7ymkZnk0SdHDM0GVKE9hk2pChMC0CGEb3d62GJDgETyxKJq0mgjczFgsxLMW1Oyl4YFKPLU4zmqJxnvEAigilv43iBFvcJtuhj8PbkPgeee4D5czdkIrbPe/JyhodO5s09Bi9W1czruyqGBTYzvpNXkLO8cS4+UQ8QBj/axehi5hrxW5jr2TAqpB6vUCPmPgbhYdWDNj26Cg5NsB4UV3CIKqxcUAn9nWJEVdQZ7kRQya27eQ7D8/vddOIm1NTF/dfnr/ClhsXUVrTNpLpGrqxELjOG0TbHtdliYx3LweCaqoCbqZZSNmjHGwJuKgNuMo7dXC9AuVuhGBgrlWrhLsZ4uGj8HCQBowD+KwwYdRZCvuQIU5xYbgHdRluyNWEL/nqwqKZJ7q8PH+607ftPEzlqfe1YGQt3h9ixgyGjrFo/1tlQTMULaRfSd69unRZbdMmZEQJdc+h0JnmtbajUCsFMHStGkIK8SyIX8kJAIgG62aOTaaOhukfnmoCSnnMZkraw9Pyv7ipBraJyTlOHd1VNJH08baJciZInK+6oGCiaktXSynRDtlrdRux1GjWY4yYUo+3F+g8YOQ8jKecwA5KKrUgNG10iAVRY6JRYu6cy85zv7uIDxDWpMNCpnJxmd7ULCYpBeJ7toDZ8A+sgfHaLq0p2/fJBy0iMWSddvnJ/LlXAGntzec2K06CK1KzTHDZutKQfIXJEjVomtA+dYJUBrlGazCCgxWmDrqD2eakUroUGQqlDkDcZtc0Idd7Z56ffe3pnd1DaCr68PfgBMd318ybvvc3SXb5yjPYMR9rAaJuE5WCsX8ZoZentkrJhWDdbMaOVeccbOSb4bY8OmvAgEvrhpj8kpYNUSEWhxttUYiWXliLQUuINW9VdLq0Y6qiMOUFH9NGDLemQ0xqZsH5FGZkM2Q9rdus1VPgjR0ZJ4BC6KPQX/pjLIqUv2eU3Rv5Rys1k86vF50dLHTTqsSANIHo4PAfAriQlejR3WlCv1WjiykoaYAkV+B1s7MfqMVhBUH+qF0JZPZoi/7sbw/ob4KQVTkJYiYOJKobgVBw02gxO9+HqEHjF9tMBRY1QJHRpmGFLKjMowiIpipOtpMCCJowg9cDHEZLtfM/MqN2FnI37iiPjyiutUshhIWbFkMtXLVEbD9c8vLFrybNZTNtx+1gvaR2LTCimYHGgazMO8cmN3Wd3D1NWyh6Uc6bGaaADg1LJoKYLszLRmGdHj5fcGZVivtBtnn2T7SwUOdWH1dKkzRcvCqjBhF8pkqUCXS01rBVb2h9KjEOShfgUxKjmQFBWAHEbfiGzz8hjaWLBKRUS89NeUQMBxxq26s0i2bN9AS1vWNWnN1/3UOyqmztSGp3UuOPvWMjezk6krcCiran1lFQn+BhuNoftsF8xoA7ktsiStkWt7VdsGUdTEH7L9xgpK0ibfHkJBWmVcOCqsP7uVqgVSyVjWZ26pZUhzzUFetEfxLrz4h90cNwWenb1uWG6ZEkoy4et1WQnTUo1EW2cKSJDv7fG0IF/OpB2Donn6vBTBz2pVto2I50JKuyUJl/qq9yNBUHUd9MHEmy9TXgAMg/99GtqgGj+wUrvmLbA6n+Y3tdCN31ZTNOADUPYyPqVZjoQ1sY0g46xAq++FB1fvWpvWb/QUS7wGqJGCCzKoogY1KAvVD9osJDhwFK6wVL49gGWjcY4IywFzR8MOP7wfvSJbqr6W2fRC1mFEElQrSayLecjaDthv9jWynYmC1SnhxXdESWB+vCwyxVWEGtjRYvQGJh9l6ABjaG6Aw0FgRQDNJRBIzMDYOITJteYgIamYsRlRT96a3k1ZD5ry/QqQqeFUmVldtcBOGXAqVPALPmNAeBQyTjwnMuFTluV73L7H001cZNurEXYgaJHQutWUmw0GXjwIh9uiugjA6oaSzJTDMka9k6dUpCFrRM2ANKgH8NHqHYE/z/6+GA6XiE5iQT8/fo3</div>
</div></div>
<script type="text/javascript" src="https://www.draw.io/js/embed-static.min.js"></script>',
            'slug' => str_slug('Server Map'),
            'order' => 2
        ]);
    }
}
