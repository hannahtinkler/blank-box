<?php

use Illuminate\Database\Seeder;
use App\Models\Chapter;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $serverChapter = Chapter::where('slug', 'servers')->first();
        $serviceChapter = Chapter::where('slug', 'services')->first();
        $monitoringChapter = Chapter::where('slug', 'monitoring')->first();
        $webformsChapter = Chapter::where('slug', 'webforms')->first();
        $supportChapter = Chapter::where('slug', 'support-how-tos')->first();
        $workflowsChapter = Chapter::where('slug', 'workflows')->first();
        $testingChapter = Chapter::where('slug', 'testing')->first();
        $generalChapter = Chapter::where('slug', 'general-information')->first();

        Page::truncate();

        Page::create([
            'chapter_id' => $serverChapter->id,
            'title' => 'Server Details',
            'description' => "A list of iaptus servers, detailing their locations, nodes and type.",
            'content' => null,
            'slug' => str_slug('Server Details'),
            'order' => 1,
            'created_by' => 1,
            'approved' => 1
        ]);

        Page::create([
            'chapter_id' => $serviceChapter->id,
            'title' => 'Service List',
            'description' => "A list of all iaptus clients, along with their service details and database locations.",
            'content' => null,
            'slug' => str_slug('Service List'),
            'order' => 1,
            'created_by' => 1,
            'approved' => 1
        ]);

        Page::create([
            'chapter_id' => $serverChapter->id,
            'title' => 'SSH Config Generator',
            'description' => "Generate a SSH config file for the Mayden servers from your SSH key names.",
            'content' => null,
            'slug' => str_slug('SSH Config Generator'),
            'order' => 3,
            'created_by' => 1,
            'approved' => 1
        ]);

        Page::create([
            'chapter_id' => $supportChapter->id,
            'title' => 'Creating Case Managers',
            'description' => "Instructions for how to manually convert therapists to case managers via the database",
            'content' => "<h3>You will need:</h3><ol><li>The service number of the service requiring the case manager</li></ol><br /><h3>How To</h3><ol><li>Find the therapist ID (th_id) by looking up the therapist name in the nh_therapist table for the relevant service</li><li>Create a new patch in <code>/mysql/service_patches</code>.</li><li>Paste the example text below into the patch and replace 'TH_ID_HERE' with the therapist ID you looked up earlier</li></ol><br /><h3>Sample Patch Text:</h3><code><span>#Patch to make therapist 'TherapistNameHere' a casemanager for ServiceNameHere</span><br />UPDATE `nh_therapist` <br />SET `th_type`='casemanager' <br />WHERE `th_type`='therapist' and 'th_id'=TH_ID_HERE;</code>",
            'slug' => str_slug('Creating Case Managers'),
            'order' => 3,
            'created_by' => 1,
            'approved' => 1
        ]);

        Page::create([
            'chapter_id' => $supportChapter->id,
            'title' => 'Putting a Care Pathway Live',
            'description' => "Instructions for how to transfer a care pathway from demo to a live site",
            'content' => "<h3>You will need:</h3><ol><li>Live access</li><li>Access to Keepass</li></ol><br /><h3>How To</h3><ol><li>SSH into the Bournemouth server</li><li>Log into <a href='https://demo.iaptus.co.uk'>https://demo.iaptus.co.uk</a> using 'superuser' followed by the service needing the care pathway as the username, e.g. <code>superuserhull</code>. You can find the password in Keepass under <code>Projects > IAPTus > Websites > Demo</code>.</li><li>Click the 'Care Pathway (Mayden Only)' link under the Superuser menu.</li><li>Scroll to the 'Care Pathway Sync Tool' section of the page, which will be close to the bottom. Ensure that the dropdown says 'LIVE' and then click 'Export'.</li><li>Open the downloaded file in a text editor and add the following insert statement to the top, to log the patch running: <br /><code><span># Changing 'PATCH_FILENAME_HERE' to the name you will save this patch under</span><br />INSERT INTO db_patches (filename, startDate, endDate, user, logFile) VALUES ('PATCH_FILENAME_HERE.sql', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP(), '', '');</code></li><li>Save the patch in the <code>/mysql/service_patches</code> folder.</li></ol><br /><h3>Notes:</h3><ul><li>The patch filename should be the current timestamp with no delimiter, followed by the service name, followed by a brief description of the patch (all separated by dashes):<br /><code><span># For example:</span><br />20160505-hull-care-pathway-to-go-live.sql</code></li><li>Don't forget to make a note on Jira that the patch will need to be run manually</li></ul>",
            'slug' => str_slug('Putting a Care Pathway Live'),
            'order' => 3,
            'created_by' => 1,
            'approved' => 1
        ]);

        Page::create([
            'chapter_id' => $supportChapter->id,
            'title' => 'Signing Exports Certificates',
            'description' => "Instructions for how to process and sign CAE certificate requests for clients",
            'content' => "<h3>You will need:</h3><ol><li>Live access</li><li>Access to Keepass</li><li>An FTP connection to the server the client lives on</li></ol><br /><h3>How To</h3><ol><li>Download the client's certificate request from the relevant Orbit task and upload it to the <code>/var/www/ca/clients/CLIENT_NAME/</code> directory on <a href='/p/iaptus/services/service-list'>the client's server</a> via FTP</li><li>Open and read the certificate using the <code>openssl req -noout -text -in CERT_REQUEST_NAME.csr</code> command, replacing 'CERT_REQUEST_NAME' with the file name of the certificate request that you uploaded.</li><li>Chech the 'common name' in the open certificate request againt that service's nh_export_users. If the common name from the certificate is already in this table, the certificate request should be discarded and the client needs to be asked to supply another with a unique common name.</li><li>Generate a signed certificate from your uploaded certificate request by running <code>openssl ca -cert ../../ca/ca.crt -keyfile ../../ca/ca.key -config ../../openssl.cnf -in CERT_REQUEST_NAME.csr -out CERT_REQUEST_NAME.crt</code>, replacing 'CERT_REQUEST_NAME' again.</li><li>Open the newly created signed certificate by running <code>openssl x509 -noout -text -in client.crt</code>. Ensure the contents look logical/not corrupted or empty.</li><li>Download the certificate via FTP and send it via Skype to the support team member who is assigned to the task.</li><li>Add a patch to the <code>/mysql/service_patches</code> directory which stores the common name from the certificate request to the service's <code>nh_export_users</code> table:<br /><code>INSERT INTO db_patches (filename, startDate, endDate, user, logFile) VALUES ('date_database_patch_name.sql', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP(), '', '');</code></li></ol><br /><h3>Notes:</h3><ul><li>The certificate request you download may have a <code>.csr</code> file extension OR a <code>.req</code> file extension. Either if valid.</li></ul>",
            'slug' => str_slug('Signing Exports Certificates'),
            'order' => 3,
            'created_by' => 1,
            'approved' => 1
        ]);

        Page::create([
            'chapter_id' => $testingChapter->id,
            'title' => 'Types of Automated Tests',
            'description' => "An overview of the different types of automated tests being used at Mayden.",
            'content' => "            
                <h4><strong>Acceptance Tests</strong></h4>
                An automated test that mimics a user’s behaviour and performs assertions throughout the test to ensure the correct behaviour is witnessed.
                <br />
                <br />
                <h4><strong>Integration Tests</strong></h4>
                An automated test that is used to test that multiple units of code behave as expected when used together. Can also be used to test areas out of our control (e.g. third party libraries, database interactions, API calls).
                <br />
                <br />
                <h4><strong>Unit Tests</strong></h4>
                An automated test that tests a particular “unit” of code in isolation. These are very low level tests, and only test the functionality of that code, with the assumption that any associated code runs as expected. A unit is a part of the program that can work independently of the rest of the program. This could be a function, class or even an entire module.
            ",
            'slug' => str_slug('Types of Automated Tests'),
            'order' => 1,
            'created_by' => 1,
            'approved' => 1
        ]);

        Page::create([
            'chapter_id' => $testingChapter->id,
            'title' => 'Features of Valuable Tests',
            'description' => "A description of the types of things whihc make a test 'valuable' and worth running on Mayden code.",
            'content' => '<h4><strong>General:</strong></h4>
                <ul>
                    <li>Should actually test something — if you change functionality then the test should break</li>
                    <li>Should always pass regardless of the order tests are run in</li>,
                    <li>Should always pass regardless of the order tests are created_by in</li>
                    <li>Should be completely independant of the rest of the suite</li>
                    <li>Must always contain at least one assertion</li>
                    <li>Should never be skipped (even conditionally skipped) without a good reason</li>
                    <li>Should contain minimal (preferably no) outside dependencies, in both tests and code under test</li>
                    <li>Should not share state between tests — this increases the risk of tests interfering with each other and results in much more brittle tests</li>
                    <li>Should have good, descriptive names — no one is going to type it so make it as long as you need to fully explain what the test is doing</li>
                    <li>Test method names should be camelCased as this is PSR-2, even if some frameworks (e.g. PHPSpec) like snake case</li>
                    <li>When using PHPUnit (includes Codeception unit & integration/functional) always start test methods with ‘test’ rather than use PHPUnit’s @test annotation</li>
                    <li>Maintain the pyramid — don’t write 10 acceptance tests and 1 unit test for a feature</li>
                    <li>Use the variable names “actual” and “expected” in assertions</li>
                    <li>Use the “expected” and “actual” parameters to assertions correctly — in PHPUnit assertions are assertion($expected, $actual), in almost every other testing framework it’s assertion(actual, expected)</li>
                    <li>Employ common sense — if you have a good reason to do something then it’s probably ok, so long as it’s a good reason</li>
                </ul>
                <br />

                <h4><strong>Unit Tests:</strong></h4>
                <ul>
                    <li>Ideally one assertion per test — having to use more than one assertion may indicate your unit is doing too much and should be split up. There are exceptions to this and partial refactors of legacy code may not be perfect so sometimes multiple exceptions may be acceptable</li>
                    <li>Use PHPUnit Data Providers liberally (where it makes sense to — common sense etc…)</li>
                    <li>Test a unit at a time</li>
                    <li>Use Prophecy rather than PHPUnit mocking</li>
                    <li>Don’t mock the class you’re testing</li>
                </ul>
                <br />

                <h4><strong>Integration Tests:</strong></h4>
                <ul>
                    <li>Don’t mock anything, you should be testing in as close to a live environment as possible</li>
                    <li>Try to always test a combination of units as the goal is to check a piece of functionality works in its entirety</li>
                    <li>Don’t just repeat a unit test but without using mocks as this provides very little additional value</li>
                </ul>
                <br />

                <h4><strong>Acceptance Tests:</strong></h4>
                <ul>
                    <li>Must only be a high level check of a feature (i.e. saving the New Patient form & checking it stored the patient record correctly)</li>
                    <li>Don’t test validation — use unit & integration tests for this</li>
                    <li>Test combinations of conditionals in unit & integration tests</li>
                    <li>Only write new acceptance tests as a last resort if a feature can’t be unit or integration tested, but consider if the value added by the acceptance test is worth it</li>
                </ul>

            ',
            'slug' => str_slug('Features of Valuable Tests'),
            'order' => 3,
            'created_by' => 1,
            'approved' => 1
        ]);

        Page::create([
            'chapter_id' => $testingChapter->id,
            'title' => 'Code Review Testing Checklist',
            'description' => "A list of questions a code reviewer should be asking when code reviewing automated tests.",
            'content' => "<p>No new code should be missing tests, but a lot of tests aren’t code reviewed properly. Below are some prompts for use during code review to help ensure the quality of new tests. If the answers to any of them are 'no', ask the writer to take the actions recommended. If you don’t feel comfortable code reviewing someone’s tests, ask someone else to help as bad quality tests will lead to a lot of headaches in future.</p>
                <br />
                <br />

                <strong>Are there unit tests (plural)?</strong><br />
                Write some
                <br />
                <br />
                <strong>Are the test method names descriptive and match what is being tested?</strong><br />
                Rename test methods
                <br />
                <br />
                <strong>Do the tests provide value?</strong><br />
                I.e. if a method only makes a database call then a unit test with a mocked database is of little worth
                Rewrite the tests, code under test or write integration tests
                <br />
                <br />
                <strong>Does it conform to the <a href='https://gist.github.com/imjoehaines/827b360db65d85807a33d0d6210d2512'>PHP test style guide</a>?</strong><br />
                Rewrite the tests
                <br />
                <br />
                <strong>Are they following all of the guidelines listed in this chapter?</strong><br />
                If they don’t have a valid justification for not following them, fix the issue(s)
                <br />
                <br />
                <strong>Have they written the appropriate type(s) of tests, according to the information available in this chapter?</strong><br />
                Rewrite the tests
            ",
            'slug' => str_slug('Code Review Testing Checklist'),
            'order' => 3,
            'created_by' => 1,
            'approved' => 1
        ]);

        Page::create([
            'chapter_id' => $testingChapter->id,
            'title' => '"What Kind of Test Should I Write?"',
            'description' => "A flow diagram to help you make a decision as to what kind of automated test to write to test a certain piece of code.",
            'content' => '<div class="diagram">

            <div class="mxgraph" style="position:relative;overflow:auto;width:100%;"><div style="width:1px;height:1px;overflow:hidden;">%3Cmxfile%20userAgent%3D%22Mozilla%2F5.0%20(Windows%20NT%206.3%3B%20WOW64)%20AppleWebKit%2F537.36%20(KHTML%2C%20like%20Gecko)%20Chrome%2F49.0.2623.112%20Safari%2F537.36%22%20version%3D%225.4.4.5%22%20editor%3D%22www.draw.io%22%20type%3D%22google%22%20x0%3D%22-1382%22%20y0%3D%2232%22%20pan%3D%221%22%20zoom%3D%221%22%20resize%3D%221%22%20fit%3D%221%22%20math%3D%220%22%20nav%3D%220%22%20links%3D%221%22%20tooltips%3D%221%22%20border%3D%220%22%3E%3Cdiagram%3E7V1vc6M40v80qbvnRVL8M7ZfJjOTvZnn9mqrslVz%2B1K2ZZsbDD7AcXKffrulFkiAie2AcWaxq%2FxHCCGkn37d6m6JG%2FfT5uWXhG3Xv8YLHt441uLlxv184ziuNXXgC1NeZcrUsWXCKgkWMklLeAr%2BxynRotRdsOCpkTGL4zALtmbiPI4iPs%2BMNJYk8d7MtoxD86pbtlJXLBKe5iyspn4PFtmaUj1VPzzwDx6s1urSjkVHZmz%2BY5XEu4gueOO4S%2FGShzdMFUb50zVbxHstyf0CDZvEMZSMvzYvn3iIjavaTZ73eOBoXvGER1S3N06wmTWZLqYLe8l8d%2BTd2rYny3hm4Y6a48bxQyjtYRE8Y5WzV2on%2F787rOdDxl%2ByWxYGq%2BjGvYccIV9mxVH4taJvUUq6ZVFtMWEQ8ds1NSuWY9%2FhpavFUMr3NYPLWP8fQGM7VgxN7LPNFg5EsxS%2F1AXh7uU1zXpAsrghM%2FUq7vF3nuKdPa3jHSD3p7mtr3DgexJkcO6jcfSU%2BxGjJq%2BAgzcA6etsE0KCjZXMkvgH%2FxSHcQIpURxBzodlEIalJLrrz%2BKW3YdnnmQBUMA9Jc%2FiLIs3cGC%2Fhho%2Fbdkcr7gHwoO0GHIvQzFw18FiweGEBzHqOY4rC2uhBjb%2BWYUsRUrC3%2FN4E8zpd8hmPHzIKaNc5zjKiBvtEWbHBJUHiOXRwnfeKHgDnCi4hgdEEpHALzze8Cx5hSx0wq3tTugk4mzfJRLfawxoecRbqq8xdWQr6iXaXeXFF8wDP4h8jiWiCg3ReM9et5zGOwiABf6G28SKxzs8nLwG0UpIDPzAkYRoK8GmrlM1DLXelxKUSpjgJbTeBY6udK49xrcG0zn0JIeDD9uQBdHtKzQf1gnH5Bxv2P08agkKE881kODSXw0IuaTWcTCltFZhQNeukUY6WTzhldbU7xImQYpVERjZzIKIZUGM3CVgg1L6lguxwcTnMoHWpxSJqQOcVIJRgRPs0jdA1TWMbOjU42Fk4kaCapUw2VvvRJDrm1zijCZVLgFKq0DIp%2B5ul0mUrlX0G1%2BAvkd%2F4yRbx6s4YuGXIrXEAFov8pcg%2Bzcm32G74b8%2FKBO0TvKqHcK%2F6liasSS7R9UU%2BwD7HntcJj%2BCbMplF%2Fyn7vRFGYvqSZConfIfnmWvdArbAemBdMrv6J9xDCDUxKKCjluCjtcAHYmN7S7ZQsuIlsTma8YGtHa8S8RAqOsSpf7C7a64Oq926FdBlvAQBvOzWYE6wNCpv8UBVE2TdJY1vfO9sTWaTBx35ExNtnM8706me7Y99j2f9GF1BXlfVKiuWZev449Lg8CamiXJm6%2BUBB2OozDPtsUMQGYHb2g6GRkXssfj5po5E7%2FpBPgh61AMt7z5zxuBqrs1Fq9h7IyFP5C0UXBL%2Bp0VxGuBnscTgLRAgOwEyJzTtJ7173x1h7NPlrEZSzEbVNm6%2F%2B0r%2FQJlEPWF9DXN%2BCb9v5%2BJ1TUe70I1sC2fulKBWg2Pt5h9TNpkq8zu0MW7ZHZx5Fhmzzu0oPU8Tx%2B03oSd3mi9sHO0yuvTiddA62PLvdMOeqXyT%2BZiA7PvpEfZIgY9fkU1NVsjTWlsZ%2B25mOls4vkPQLAgs720EVBmMd%2FBAYFIAkUX03YpX%2B6gMlc%2BC2rUQS4%2FC7KtkSlWPVdKSYPq6ubDk07mQaQ8HBChSxYkIVa%2FIjrTYCMGeH7EFJZkW5KfdecHaQzjEtFWWwLMnDY5%2BmL4ShBxUYCjRE62lrtojpMv6MKMZheDrD3KIlOah9fK2joAdiJrFWOeDEDoGwDgywH87AO4FTlRX%2FJ93fkLvgXRyKN5ICiwrhBSIBUVRlzAVRiABAMqvhywd6wJyKYJexP0lCrYPfSqRiBpRkbzTR1kkH8OQUUIyKuWg6ghnggEXYt7L%2BsoG4wSe16N7UaJOMN204XY8wYN%2F6oMN0oNadTw5Xh9h4Z%2FPlzIsNEyXHRDX4EPPJRjpzg2wKU6s7lWuJBGrwmWP1DJ6EtPKKIFulMWdE9o9XolQQXnLAIoppTciqCBcApT0NToGB5NwXQ541CntYqE0akqBtgBOLQOeZUGTeMMHVP5FXNFo2Z%2BrXyKnSsaowspGoN0qE4pG6WDHJl9SIdx1SxHIQhavEF9bI4WsYI0QFNkbFMMfDkmrmUwzTW4l0em5HDHNbNTpXoYkSpdMIdy82kw%2BZ0cWsIoRjEqIh5hAfZjhEKqWU7SLZ8HS%2BgmYc6VrisoKwD3lcyAfix5cJvEYAdOZbKY4gYofdR1kgSDIaEZ2CsUMhg7joTTyDHdoZ6SBb0YO1Shw4z3gJBqUlq6mMIcIaOkpOhFRlH1LjbhHdDSiBalMzTD5QAhneYBPTlOxFPWESU2p9KY01nYh7ISGpJRyMEfRcy2cFmSJKR4Z2m0XyCSDAmHYXvYSeLc5wB9BmTpha7FnPqUDItNUZYKV%2Bo39szSeRJs89BAJYpZhI2oBC6e%2BmiIWZ6RZAZ5jeeZlcSrCGeDqCbW6NuT5obdgZStiuLr0u3eHTU4w95tQw67plo3UuSmy2E1wHQ5nOt6rVKrioceBPF1zBaVnt1IrZJy%2BpDEE9LbNLL7thMsoMLbBIfJoDPBPzKig6KVhb98w5lgbOG5pCg2tiiiO7ZwD9hmgo9g0RUXBip5DEf%2BVvLVENF2POnAarWS8k9C8i0rlCKidkHUiTqnfg8%2BirNVNjm6e%2BGV6no8LTiMVJWyJUBYHOZrFq1U9GuuthhxYhC1IQPDymaswRp1PIOouG61cMoip4URplPjyPAprV24UKHX4tLqWCDUrOurdWS1Yna0yEGhOtqp6qd1oc%2FdaKdUlw%2Fs6aYzChGC%2BT%2BkCFEc3SxCxMjsRYRQBM8QFXElcCGOvtaZDMmzwRV6QUjQ7LEZEoJm%2BoCEmgBpWsUn0iflquslZ2kwEwHAez1uwrTJCTMdmeyUBirShG2tZoGCiaoPv76WtNA2lE4wbBvLW1Sg5Fs%2Bq06CJ6aDqeyq2ETtv9PIJnJM98ImVVPZv8DiNUxR3h9UV1p47ytZ3scURa3A%2B8Cs8BebosiB2cGSe9eHrjGAqaz5Jy%2Brt93Rna%2B9RkQmShCOvTtXe5VsLAfWebbh7ZxWDXWf0Y6%2Fl4s4WSi0I31tEqlA0rH4KLyLQjXaI5yk6V%2FfykYY7th8zrcZi6CjTTdjrktBEYMmdYImpRYtE4AmtUudiEY7dwBMq%2Ba7QTR2IhonUL%2F%2BRGM361R%2BEtF44V0L1OS2WTT2Zr2bdmPpHTa5OBcux1jvpDLQC1zI2Hv0ShZdozi40%2BSwquVYdcIz9VHYMpEKMbbPq3MHdiJoqttGDO7AttyBpR1mRj3OtWFTs8Ef%2BME0CgGXPkSEbXVjr22KGh8bOsXVu38uDZhjltW%2F2yN4Zti4RRPiwsLSbdi4bVXtw4PQamsWbFo7puNquOMFhdZgIb4iDjrGQkxjsx%2BpVbWN0XKSub4kQ%2Bz5DNt%2B5gZRMe2psZtW9hjFOMm6Oc9sV5fbwlaSl0s5PIlCLGjZBhG4uiFuu26vtWEZyHHLQEyKqp1B1a4D6WQGBVueXlxZcgYDTANR2SoO8w2meq%2FF7kx1SUVm5s%2B%2BMZ7A0oW6VN3F5uvfcIlJBM%2FXAC6E0Qh9MKhPbcz5S1ttT5VurFFT3WKRjtSnC8R1FvO2YdLfiv4kBmv7LnZYpHQHO%2Brkr5Jxamr7xuGSW%2Fxo77vnWab3vSSqR%2Bd430%2Fm2LLPdmp3vJLZVms8ulYCPqycP6i9YLFdKAHqqR4XMJm8vZRe2URaR7qnYveV15oChbtDumrXIQKhdeXBN0Ez8XuMQLDtC%2BwcUjDBoDy0oTzIsXnxKU0lRKp7EiLF4S%2B9BKXusXCf77%2FYXzBjFyL1mId3vNdpdR4Cx64pBt98xJHtqM1DLvWMI1utyBjidD4QnqVpsRdzttpif8DLAbzUPfO0U7wov2Oz21502wUQ44J9Z7Z0Ro63mE8ZY7edbAxY3RukwEtVXzu2Y43eqevntjbnO6bH%2BttBVlXvSuZSl95evOsJ1USFTeQ7iFed2UpxMHYQb2Hfzsro7GT%2F6J5G51tTrEs%2BHUCOoQ4eF6fmGAo8pCCebhOduGaATKWksxcdwd8kxoekF9mBENa%2Fwv4%2BmONP%3C%2Fdiagram%3E%3C%2Fmxfile%3E</div></div>
            <div class="mxgraph" style="position:relative;overflow:auto;width:100%;"><div style="width:1px;height:1px;overflow:hidden;">%3Cmxfile%20userAgent%3D%22Mozilla%2F5.0%20(Windows%20NT%206.3%3B%20WOW64)%20AppleWebKit%2F537.36%20(KHTML%2C%20like%20Gecko)%20Chrome%2F49.0.2623.112%20Safari%2F537.36%22%20version%3D%225.4.4.5%22%20editor%3D%22www.draw.io%22%20type%3D%22google%22%20x0%3D%22,-1382%22%20y0%3D%2232%22%20pan%3D%221%22%20zoom%3D%221%22%20resize%3D%221%22%20fit%3D%221%22%20math%3D%220%22%20nav%3D%220%22%20links%3D%221%22%20tooltips%3D%221%22%20border%3D%220%22%3E%created_bygram%3E7V1vc6M40v80qbvnRVL8M7ZfJjOTvZnn9mqrslVz%2B1K2ZZsbDD7AcXKffrulFkiAie2AcWaxq%2FxHCCGkn37d6m6JG%2FfT5uWXhG3Xv8YLHt441uLlxv184ziuNXXgC1NeZcrUsWXCKgkWMklLeAr%2BxynRotRdsOCpkTGL4zALtmbiPI4iPs%2BMNJYk8d7MtoxD86pbtlJXLBKe5iyspn4PFtmaUj1VPzzwDx6s1urSjkVHZmz%2BY5XEu4gueOO4S%2FGShzdMFUb50zVbxHstyf0CDZvEMZSMvzYvn3iIjavaTZ73eOBoXvGER1S3N06wmTWZLqYLe8l8d%2BTd2rYny3hm4Y6a48bxQyjtYRE8Y5WzV2on%2F787rOdDxl%2ByWxYGq%2BjGvYccIV9mxVH4taJvUUq6ZVFtMWEQ8ds1NSuWY9%2FhpavFUMr3NYPLWP8fQGM7VgxN7LPNFg5EsxS%2F1AXh7uU1zXpAsrghM%2FUq7vF3nuKdPa3jHSD3p7mtr3DgexJkcO6jcfSU%2BxGjJq%2BAgzcA6etsE0KCjZXMkvgH%2FxSHcQIpURxBzodlEIalJLrrz%2BKW3YdnnmQBUMA9Jc%2FiLIs3cGC%2Fhho%2Fbdkcr7gHwoO0GHIvQzFw18FiweGEBzHqOY4rC2uhBjb%2BWYUsRUrC3%2FN4E8zpd8hmPHzIKaNc5zjKiBvtEWbHBJUHiOXRwnfeKHgDnCi4hgdEEpHALzze8Cx5hSx0wq3tTugk4mzfJRLfawxoecRbqq8xdWQr6iXaXeXFF8wDP4h8jiWiCg3ReM9et5zGOwiABf6G28SKxzs8nLwG0UpIDPzAkYRoK8GmrlM1DLXelxKUSpjgJbTeBY6udK49xrcG0zn0JIeDD9uQBdHtKzQf1gnH5Bxv2P08agkKE881kODSXw0IuaTWcTCltFZhQNeukUY6WTzhldbU7xImQYpVERjZzIKIZUGM3CVgg1L6lguxwcTnMoHWpxSJqQOcVIJRgRPs0jdA1TWMbOjU42Fk4kaCapUw2VvvRJDrm1zijCZVLgFKq0DIp%2B5ul0mUrlX0G1%2BAvkd%2F4yRbx6s4YuGXIrXEAFov8pcg%2Bzcm32G74b8%2FKBO0TvKqHcK%2F6liasSS7R9UU%2BwD7HntcJj%2BCbMplF%2Fyn7vRFGYvqSZConfIfnmWvdArbAemBdMrv6J9xDCDUxKKCjluCjtcAHYmN7S7ZQsuIlsTma8YGtHa8S8RAqOsSpf7C7a64Oq926FdBlvAQBvOzWYE6wNCpv8UBVE2TdJY1vfO9sTWaTBx35ExNtnM8706me7Y99j2f9GF1BXlfVKiuWZev449Lg8CamiXJm6%2BUBB2OozDPtsUMQGYHb2g6GRkXssfj5po5E7%2FpBPgh61AMt7z5zxuBqrs1Fq9h7IyFP5C0UXBL%2Bp0VxGuBnscTgLRAgOwEyJzTtJ7173x1h7NPlrEZSzEbVNm6%2F%2B0r%2FQJlEPWF9DXN%2BCb9v5%2BJ1TUe70I1sC2fulKBWg2Pt5h9TNpkq8zu0MW7ZHZx5Fhmzzu0oPU8Tx%2B03oSd3mi9sHO0yuvTiddA62PLvdMOeqXyT%2BZiA7PvpEfZIgY9fkU1NVsjTWlsZ%2B25mOls4vkPQLAgs720EVBmMd%2FBAYFIAkUX03YpX%2B6gMlc%2BC2rUQS4%2FC7KtkSlWPVdKSYPq6ubDk07mQaQ8HBChSxYkIVa%2FIjrTYCMGeH7EFJZkW5KfdecHaQzjEtFWWwLMnDY5%2BmL4ShBxUYCjRE62lrtojpMv6MKMZheDrD3KIlOah9fK2joAdiJrFWOeDEDoGwDgywH87AO4FTlRX%2FJ93fkLvgXRyKN5ICiwrhBSIBUVRlzAVRiABAMqvhywd6wJyKYJexP0lCrYPfSqRiBpRkbzTR1kkH8OQUUIyKuWg6ghnggEXYt7L%2BsoG4wSe16N7UaJOMN204XY8wYN%2F6oMN0oNadTw5Xh9h4Z%2FPlzIsNEyXHRDX4EPPJRjpzg2wKU6s7lWuJBGrwmWP1DJ6EtPKKIFulMWdE9o9XolQQXnLAIoppTciqCBcApT0NToGB5NwXQ541CntYqE0akqBtgBOLQOeZUGTeMMHVP5FXNFo2Z%2BrXyKnSsaowspGoN0qE4pG6WDHJl9SIdx1SxHIQhavEF9bI4WsYI0QFNkbFMMfDkmrmUwzTW4l0em5HDHNbNTpXoYkSpdMIdy82kw%2BZ0cWsIoRjEqIh5hAfZjhEKqWU7SLZ8HS%2BgmYc6VrisoKwD3lcyAfix5cJvEYAdOZbKY4gYofdR1kgSDIaEZ2CsUMhg7joTTyDHdoZ6SBb0YO1Shw4z3gJBqUlq6mMIcIaOkpOhFRlH1LjbhHdDSiBalMzTD5QAhneYBPTlOxFPWESU2p9KY01nYh7ISGpJRyMEfRcy2cFmSJKR4Z2m0XyCSDAmHYXvYSeLc5wB9BmTpha7FnPqUDItNUZYKV%2Bo39szSeRJs89BAJYpZhI2oBC6e%2BmiIWZ6RZAZ5jeeZlcSrCGeDqCbW6NuT5obdgZStiuLr0u3eHTU4w95tQw67plo3UuSmy2E1wHQ5nOt6rVKrioceBPF1zBaVnt1IrZJy%2BpDEE9LbNLL7thMsoMLbBIfJoDPBPzKig6KVhb98w5lgbOG5pCg2tiiiO7ZwD9hmgo9g0RUXBip5DEf%2BVvLVENF2POnAarWS8k9C8i0rlCKidkHUiTqnfg8%2BirNVNjm6e%2BGV6no8LTiMVJWyJUBYHOZrFq1U9GuuthhxYhC1IQPDymaswRp1PIOouG61cMoip4URplPjyPAprV24UKHX4tLqWCDUrOurdWS1Yna0yEGhOtqp6qd1oc%2FdaKdUlw%2Fs6aYzChGC%2BT%2BkCFEc3SxCxMjsRYRQBM8QFXElcCGOvtaZDMmzwRV6QUjQ7LEZEoJm%2BoCEmgBpWsUn0iflquslZ2kwEwHAez1uwrTJCTMdmeyUBirShG2tZoGCiaoPv76WtNA2lE4wbBvLW1Sg5Fs%2Bq06CJ6aDqeyq2ETtv9PIJnJM98ImVVPZv8DiNUxR3h9UV1p47ytZ3scURa3A%2B8Cs8BebosiB2cGSe9eHrjGAqaz5Jy%2Brt93Rna%2B9RkQmShCOvTtXe5VsLAfWebbh7ZxWDXWf0Y6%2Fl4s4WSi0I31tEqlA0rH4KLyLQjXaI5yk6V%2FfykYY7th8zrcZi6CjTTdjrktBEYMmdYImpRYtE4AmtUudiEY7dwBMq%2Ba7QTR2IhonUL%2F%2BRGM361R%2BEtF44V0L1OS2WTT2Zr2bdmPpHTa5OBcux1jvpDLQC1zI2Hv0ShZdozi40%2BSwquVYdcIz9VHYMpEKMbbPq3MHdiJoqttGDO7AttyBpR1mRj3OtWFTs8Ef%2BME0CgGXPkSEbXVjr22KGh8bOsXVu38uDZhjltW%2F2yN4Zti4RRPiwsLSbdi4bVXtw4PQamsWbFo7puNquOMFhdZgIb4iDjrGQkxjsx%2BpVbWN0XKSub4kQ%2Bz5DNt%2B5gZRMe2psZtW9hjFOMm6Oc9sV5fbwlaSl0s5PIlCLGjZBhG4uiFuu26vtWEZyHHLQEyKqp1B1a4D6WQGBVueXlxZcgYDTANR2SoO8w2meq%2FF7kx1SUVm5s%2B%2BMZ7A0oW6VN3F5uvfcIlJBM%2FXAC6E0Qh9MKhPbcz5S1ttT5VurFFT3WKRjtSnC8R1FvO2YdLfiv4kBmv7LnZYpHQHO%2Brkr5Jxamr7xuGSW%2Fxo77vnWab3vSSqR%2Bd430%2Fm2LLPdmp3vJLZVms8ulYCPqycP6i9YLFdKAHqqR4XMJm8vZRe2URaR7qnYveV15oChbtDumrXIQKhdeXBN0Ez8XuMQLDtC%2BwcUjDBoDy0oTzIsXnxKU0lRKp7EiLF4S%2B9BKXusXCf77%2FYXzBjFyL1mId3vNdpdR4Cx64pBt98xJHtqM1DLvWMI1utyBjidD4QnqVpsRdzttpif8DLAbzUPfO0U7wov2Oz21502wUQ44J9Z7Z0Ro63mE8ZY7edbAxY3RukwEtVXzu2Y43eqevntjbnO6bH%2BttBVlXvSuZSl95evOsJ1USFTeQ7iFed2UpxMHYQb2Hfzsro7GT%2F6J5G51tTrEs%2BHUCOoQ4eF6fmGAo8pCCebhOduGaATKWksxcdwd8kxoekF9mBENa%2Fwv4%2BmONP%3C%2Fdiagram%3E%3C%2Fmxfile%3E</div></div>


</div>
<script type="text/javascript" src="https://www.draw.io/embed.js?s=flowchart"></script>',
            'slug' => str_slug('"What Kind of Test Should I Write?"'),
            'order' => 4,
            'created_by' => 1,
            'approved' => 1
        ]);

        Page::create([
            'chapter_id' => $workflowsChapter->id,
            'title' => 'Working on Support Tasks',
            'description' => "Diagram showing the process for picking up a support task and seeing it through to pull request stage",
            'content' => '<div class="diagram"><div class="mxgraph" style="position:relative;overflow:auto;width:100%;">
<div style="width:1px;height:1px;overflow:hidden;">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</div>
</div></div>',
            'slug' => str_slug('Working on Support Tasks'),
            'order' => 3,
            'created_by' => 1,
            'approved' => 1
        ]);

        Page::create([
            'chapter_id' => $webformsChapter->id,
            'title' => 'Webform Process Diagram',
            'description' => "A diagram showing how Webforms are used with iaptus, including how they make their way from iaptus to the patient and back again.",
            'content' => '<div class="diagram"><div class="mxgraph" style="position:relative;overflow:auto;width:100%;">
<div style="width:1px;height:1px;overflow:hidden;">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</div>
</div></div>
<script type="text/javascript" src="https://www.draw.io/embed.js?s=flowchart"></script>',
            'slug' => str_slug('Webforms Process Diagram'),
            'order' => 1,
            'created_by' => 1,
            'approved' => 1
        ]);

        Page::create([
            'chapter_id' => $serverChapter->id,
            'title' => 'Server Node Diagram',
            'description' => "A diagram showing the setup of iaptus server nodes and access points.",
            'content' => '<p>This diagram shows access points for the various iaptus nodes available. External traffic is funnelled to the loadbalances and distributed between nodes as it sees fit. Local traffic (e.g. developers on local machines) is directed by local SSH config settings and provided access via VPN. Depending on your SSH config, you should be able to access all nodes from a single VPN/SSH entry point.<br /><br /><div class="diagram">

            <div class="mxgraph" style="position:relative;overflow:auto;width:100%;"><div style="width:1px;height:1px;overflow:hidden;">%3Cmxfile%20userAgent%3D%22Mozilla%2F5.0%20(Windows%20NT%206.3%3B%20WOW64)%20AppleWebKit%2F537.36%20(KHTML%2C%20like%20Gecko)%20Chrome%2F49.0.2623.112%20Safari%2F537.36%22%20version%3D%225.4.4.5%22%20editor%3D%22www.draw.io%22%20type%3D%22google%22%20x0%3D%2259%22%20y0%3D%2270%22%20pan%3D%221%22%20zoom%3D%221%22%20resize%3D%221%22%20fit%3D%221%22%20math%3D%220%22%20nav%3D%220%22%20links%3D%221%22%20tooltips%3D%221%22%20border%3D%220%22%3E%3Cdiagram%3E7V3bc6M41v9rUtX7kBR3w2PS6Z7Zqu7ZqcnUN98%2BYhs77GDjwbi7s3%2F9nAM6XISwYxuBspFd5YtAXMRP53rRjf1x8%2BOnLNw9f02XUXJjGcsfN%2FbjjWXZ7syFL2x5KVvMwPXLlnUWL1lb3fAU%2FzdijQZrPcTLaN%2FaMU%2FTJI937cZFut1Gi7zVFmZZ%2Br292ypN2mfdhWs6Y93wtAiTbusf8TJ%2FZjdWXR9u%2BDmK18%2Fs1Fbgsi3zcPHnOksPW3bCG8teFa9y8yakg7H998%2FhMv3eaLI%2FwchmaQpHxl%2BbHx%2BjBEeXxq3s97lna3XhWbRl13a8g730ZnYUOt48jIJ5tLoNyiN8C5MDG4wby0vgWA%2FL%2BBv8XONPatrvwi3eRP7CRs7764BX%2FpDE2%2Bj2mY3QPexi3uFx2Fb%2BMKsULhafZpJmrcM0Rq9uEpwOD3C7L2CEJ7NcY%2Feje7qHDB7Otrj%2F8rwwLOWp25cDzeWNtZvnmWDH1qAUD7S6OOv7c5xHT7twgf%2B%2Fw1SBnZ7zTQL%2FTPhZoCTC52DgUBIQ8M86CfcIYfy9SDfxgv1OwnmUPFQQ%2B8gGbJtu4RQP%2BzxL%2F6wAi6fAu2OzywSElg3UCwbXKF7QHibxegttSbTCW%2FkWZXkM0%2BGeNecpXvsqTpJG508evqvzNrY8fMZ3iY9FvF1%2FKY76aNe3kGbLKOMunwEPTh0xSiJAc9HEoPxTlG6iPHuBXVgHj80qojumxyjR93oWmz7NPcJn0TqjuR0y2rGujl5PH%2FjBZpB4NjkL11oFs0VoWys%2FXN1CTw4T0RIIDfubZvlzuk63YfKpbuVg0cBL9CPO%2Fx%2Bb71z2799syz4Ps%2Fwe6V4TDND2GZ4Y4Qv%2FMyzgQ4u2S64HtDT2%2F0%2BU5y9s%2F%2FCQp9BUX%2B%2BXFAHBzt0EHV5ZA3RHMbdLwnh7u87CcogNHJrjzx1GMj1kxXQSkS7fFoMji5Iwj7%2B1Dy56zKzrr2lc0CNCoTXjYGUAklsHgbFdRznrV8MFBhhvrtpthzvs%2B8%2FkmoxNshP5ME4t4n1i%2F4An9tz%2Bvt%2B%2BkXP3r268r4PZmYFcD%2FhRDko9naoH9aoZ1vPQhQyLsZWT7MIWcosvabich0m4XUQZPLMejnEpyS%2BmjmSS77yG4i9gikWwsYfmd2h78BHfXW7w2cK3bAJv2awLw5dLtLxB4N0Z26dJ32EuXU%2FeO%2BBzZIHvKcLOcB8adirAzjQZJ2ews0zb6%2BKOuEITdzYBdFDc0dn7pHQB7ODm81s2%2Boi7rLjGUyL5aVHb4PDbI8WH%2BBaI5MDPt9EmPcAgnhTK34ysbc9eMQPKB9CdAPM0z9PNNeL2bwx%2B8uVtkySI4xK3BSRBksTdmRrsHhozI5lvwUKBM7hXj301sfZFxPrD13APxOwfIyF4DBpuBefQ8FKSz%2FDqjuCNofP3QnVARWEIeWDWJsyewSTiBvyA9wvQ57KOg4LPmkmSB%2B53uwSIRB6naG%2F5EIe7%2FLDvB5wWD8aVSk2eDII00MGhTTbCFg4DGUSQEN%2FAYfwNqeAltjwhQPFhwWfHzmd7Ivja1TTosa2doI2AyR3%2BXBzm%2BMjUIpVn4bkcx0dgfbx1rNlU0siipR%2B4JdXdHbIdDNMQqhXqGy0QB4xGNnm5kJUzO8XAQm4XxI%2BIuV%2F%2B9fhpAF7uBCKkmkDBjQ8PV%2FLyCq8vMEHgyZ2D2TEE1EvY%2B7x4Cm2EgmFMMmm1yb5DmpdldjWvypvS0viliJeOMwUo4ZaND%2FcalIqA0nTalHJqUJpdpUeLne9A7OTN8y5yL17q9Jkk2oahDO2HnegcofM6eJpAjAehiFqslCZWQtBEG6QeCYvTSJVdy6lskMK00CC9CKTkIY4iOI5cWur4asEUSZsUlv57tM9hlDUPV8SzZJNEWDPxrukIvCxjMXE6uyqmIwsItjYdqU4%2BTRt8Xm0Y%2B11ZdET66XRhPKRnvmnP1PRzQvo5U8wz73TlyxHsQxC0q42W6tiHAp%2BhQBWjZdctOQIowXyvjZbqgHJGpmtFQOnKMlqWHBrcBppDq6HhoLSkEIumyI9RqSHGA2gWrZALx52xTCdVyGE3lHgEVAJL0DxaIVTyavTkqJSrRvf7bzSTHpdJB3yOkxsw%2BjgRk55Cj8awOc2k1SGH4JZp6yymR1x7InI4hSKNQcWaSSuESoNTaKZGJaVcSGLS%2Ff5rzaTHjfdxFWPS3hRM2taatFrk0FeMSXtTMGlba9JqodJTjEnP2CSRWQsEd4LxyV4am%2FAvbWvVCVkgPBAUrVIhVTkRcamQulNdLQS7XFYtxD6nRE2jXMhp7FxdS4QMH2Vlj6OC17UFR86tEgIXwhFcivvtK8th%2BSd6DF%2BWg0qAvZ%2FSNwqDuUxLHbwwDtafubPrVw%2FGhq6SY9mUGTYemtmdaOL9JvBOZVmOEu%2FS%2Fzw28ba5nA3LYPkZvSWVXEpp7%2BkxPNpNo78IoA4%2BVsWgsIwzKH2JmVn2I8wGvOSBSt1wwUuuIBIe7nwsIwPFUo1rc21GHWtFbkqXaFVRpsIjqVJTJVtKC1zKQ2Qdxn22eEYGpKmkslTSVYxImiQkjEsl%2BwvUaSo5KpV0yRSvDJHsz1%2BTmS30CLXkevOFNN0cuSoSl9oGD01QHI4KIMmvimQKctvC%2FZTJbU36qXPbFM1tg6g8LnLeRJ%2F4hLnBZFgbXALlyKcWO6cknwZXS9uyPXaQJk8XkU9JMiammV0gY76WgJYyZh8Bdf07YfHNoUioFkGvxiuViyO8OlQmaSIZ1JJVnVuXRVI6JZgyz49VVBixLBKUP1aspIKuxvkGxE6firgeC%2FYbU%2BqkkrbKwLiZ4qlhrCiMA181GDNL2buNTHm9o%2F5YOMJArvpKSDvqqy%2BruQwewBIQSas0LJ%2Bx6oFDVgIKIKFJMGOV4uX58CnHWsN8lLXHSqfg4Ah1yIxfB3%2FIQSh%2FIkBoSaYlIpQxhmEQ%2Br9AbmmSNaPCign3WpAOjj%2BP4jhr%2FDG6cgJ%2Fp49UeUzpSOX8uhrJvSeSiGQm0WgkMyRfjtd6zUXnzqtfXFY8hcCdt4pjB8rcQV4LZby4cbAMZ%2BLK39tOaaI4cm2cJ5jrIQH%2BFG6pRY1xRI0CfMMvc%2Bp03LWvnCDDgEh%2Bwdtwgzr9dr7HL22tVSWpNWiTOOHaSSaFTY8QJSAoHTqtnQuYn7ZzSalyX1rAhsg2NHkQB9OGCNBaY5onj8ST5TBly%2FMtGHOxO2sMtkx5kLJx9OrMp%2FMxJjXtaWwrE5OSjlpLWXzQFWC8nO543eKKY%2FDIP6L5Ks02zXXadeznlFKdw5UqwbVzu6VKSOMYQarzusEg08Z%2BNsvqaKlO1dhPFzu0Yz%2B7OB5TsPNk6ckCEqoV40lJKFWbq%2BM%2FuzkdLhnfRoj%2FFNQZmz7%2Bs1sNSkeBThkF6vhcXWWHLHsTRYFeWKRMLmox6oErF6VhOyVsZ04HttMu6UryszLyqg63exMC6yzg%2FH9TC6zkwRzRggSe3vdsQjpuHCqFyOEtlb7n3jmW787M8pNfAskKRJtPOMwHsWHKqkUGfqpeCJbbtBXzqJFwDKCeXV3MDfh1kmRHwlkGjZrk8mLXlxAb0F%2BDF3dRcJH8cnm4eNRJfBarVxxNG%2FbN%2Fup4NmV3DMpsqyu%2FwjrkomxYSHWcAPh%2Fv%2F7yJm1DR5F10ja0iZfLYr6d8iVncENDLMRBnlsGFE%2BQvOZQZnBTfJNiNmcgbwHqSwrDA01PTz%2F3CvnLdHHYFLeslkZ6HhaYoG%2FcmX5jIsPL7zcinqG3lrh5gUcAtzwEdGj2M%2BhQ5k3TXOiy59nSYEkbGBg6isXR6DAaWWE0u0O2g2EaotQGWV3qOJoxl%2BGfuQsQOwFdcy%2BIrGV4K0kwa2kOXOHXE8qrApVfL5TchhHOmJnuqGhW5j6NrTm4FJxB2AUcnSjLTWugXt6DnDJDKSde4DlutDIWhrdyndCkGTC4u%2FFLGi7nYRJuF1GmfY6K%2BByDWRteVYBGU4SgfVoiBMXnXkN9O9g7FUtUoiSZo1CBM%2Bcoe%2B%2Btfli2ffga7uFJXbmAh1pSwQXuF9RijoGsJRzUqWnXCa4Gt4i%2FG3QlV4CYgOnTWr6Dwq5fhxbA7lT9oQZaBBDTWBoaS3z%2BkxhLguIvVcj0oFjqqs8lbjBe%2FOqqrLbQt6wp2WTocykTlIw3At%2FbiISMKlVPFbytVoLApGqLLzApi2Xt8dWWNsEMWJBDf4Yprc0r7iBBBRnBg3zW6itTe%2B%2BmVcBZVOJRDbyE%2B9hQ9jnXHVNK%2BpDM7%2B6c0L6rBY3E%2B0sAvmprxmngK0nCJeMeKP7YwH93q8dNimzmNh4%2BJqhK2%2BYNnGfX3MBD3dmuFTiQ3eZBdlEbkR5EF7m%2Bb9EenHN9uOiiLlTfXZ0tDdW3AdVeBtYwRvxzixo6Vscwfov%2BOkCpDO3SV8il71GXNmOX4tGHv1mKhqQabvBkn7%2BCsQr3%2BBs%3D%3C%2Fdiagram%3E%3C%2Fmxfile%3E</div></div>
            <div class="mxgraph" style="position:relative;overflow:auto;width:100%;"><div style="width:1px;height:1px;overflow:hidden;">%3Cmxfile%20userAgent%3D%22Mozilla%2F5.0%20(Windows%20NT%206.3%3B%20WOW64)%20AppleWebKit%2F537.36%20(KHTML%2C%20like%20Gecko)%20Chrome%2F49.0.2623.112%20Safari%2F537.36%22%20version%3D%225.4.4.5%22%20editor%3D%22www.draw.io%22%20type%3D%22google%22%20x0%3D%22,59%22%20y0%3D%2270%22%20pan%3D%221%22%20zoom%3D%221%22%20resize%3D%221%22%20fit%3D%221%22%20math%3D%220%22%20nav%3D%220%22%20links%3D%221%22%20tooltips%3D%221%22%20border%3D%220%22%3E%created_bygram%3E7V3bc6M41v9rUtX7kBR3w2PS6Z7Zqu7ZqcnUN98%2BYhs77GDjwbi7s3%2F9nAM6XISwYxuBspFd5YtAXMRP53rRjf1x8%2BOnLNw9f02XUXJjGcsfN%2FbjjWXZ7syFL2x5KVvMwPXLlnUWL1lb3fAU%2FzdijQZrPcTLaN%2FaMU%2FTJI937cZFut1Gi7zVFmZZ%2Br292ypN2mfdhWs6Y93wtAiTbusf8TJ%2FZjdWXR9u%2BDmK18%2Fs1Fbgsi3zcPHnOksPW3bCG8teFa9y8yakg7H998%2FhMv3eaLI%2FwchmaQpHxl%2BbHx%2BjBEeXxq3s97lna3XhWbRl13a8g730ZnYUOt48jIJ5tLoNyiN8C5MDG4wby0vgWA%2FL%2BBv8XONPatrvwi3eRP7CRs7764BX%2FpDE2%2Bj2mY3QPexi3uFx2Fb%2BMKsULhafZpJmrcM0Rq9uEpwOD3C7L2CEJ7NcY%2Feje7qHDB7Otrj%2F8rwwLOWp25cDzeWNtZvnmWDH1qAUD7S6OOv7c5xHT7twgf%2B%2Fw1SBnZ7zTQL%2FTPhZoCTC52DgUBIQ8M86CfcIYfy9SDfxgv1OwnmUPFQQ%2B8gGbJtu4RQP%2BzxL%2F6wAi6fAu2OzywSElg3UCwbXKF7QHibxegttSbTCW%2FkWZXkM0%2BGeNecpXvsqTpJG508evqvzNrY8fMZ3iY9FvF1%2FKY76aNe3kGbLKOMunwEPTh0xSiJAc9HEoPxTlG6iPHuBXVgHj80qojumxyjR93oWmz7NPcJn0TqjuR0y2rGujl5PH%2FjBZpB4NjkL11oFs0VoWys%2FXN1CTw4T0RIIDfubZvlzuk63YfKpbuVg0cBL9CPO%2Fx%2Bb71z2799syz4Ps%2Fwe6V4TDND2GZ4Y4Qv%2FMyzgQ4u2S64HtDT2%2F0%2BU5y9s%2F%2FCQp9BUX%2B%2BXFAHBzt0EHV5ZA3RHMbdLwnh7u87CcogNHJrjzx1GMj1kxXQSkS7fFoMji5Iwj7%2B1Dy56zKzrr2lc0CNCoTXjYGUAklsHgbFdRznrV8MFBhhvrtpthzvs%2B8%2FkmoxNshP5ME4t4n1i%2F4An9tz%2Bvt%2B%2BkXP3r268r4PZmYFcD%2FhRDko9naoH9aoZ1vPQhQyLsZWT7MIWcosvabich0m4XUQZPLMejnEpyS%2BmjmSS77yG4i9gikWwsYfmd2h78BHfXW7w2cK3bAJv2awLw5dLtLxB4N0Z26dJ32EuXU%2FeO%2BBzZIHvKcLOcB8adirAzjQZJ2ews0zb6%2BKOuEITdzYBdFDc0dn7pHQB7ODm81s2%2Boi7rLjGUyL5aVHb4PDbI8WH%2BBaI5MDPt9EmPcAgnhTK34ysbc9eMQPKB9CdAPM0z9PNNeL2bwx%2B8uVtkySI4xK3BSRBksTdmRrsHhozI5lvwUKBM7hXj301sfZFxPrD13APxOwfIyF4DBpuBefQ8FKSz%2FDqjuCNofP3QnVARWEIeWDWJsyewSTiBvyA9wvQ57KOg4LPmkmSB%2B53uwSIRB6naG%2F5EIe7%2FLDvB5wWD8aVSk2eDII00MGhTTbCFg4DGUSQEN%2FAYfwNqeAltjwhQPFhwWfHzmd7Ivja1TTosa2doI2AyR3%2BXBzm%2BMjUIpVn4bkcx0dgfbx1rNlU0siipR%2B4JdXdHbIdDNMQqhXqGy0QB4xGNnm5kJUzO8XAQm4XxI%2BIuV%2F%2B9fhpAF7uBCKkmkDBjQ8PV%2FLyCq8vMEHgyZ2D2TEE1EvY%2B7x4Cm2EgmFMMmm1yb5DmpdldjWvypvS0viliJeOMwUo4ZaND%2FcalIqA0nTalHJqUJpdpUeLne9A7OTN8y5yL17q9Jkk2oahDO2HnegcofM6eJpAjAehiFqslCZWQtBEG6QeCYvTSJVdy6lskMK00CC9CKTkIY4iOI5cWur4asEUSZsUlv57tM9hlDUPV8SzZJNEWDPxrukIvCxjMXE6uyqmIwsItjYdqU4%2BTRt8Xm0Y%2B11ZdET66XRhPKRnvmnP1PRzQvo5U8wz73TlyxHsQxC0q42W6tiHAp%2BhQBWjZdctOQIowXyvjZbqgHJGpmtFQOnKMlqWHBrcBppDq6HhoLSkEIumyI9RqSHGA2gWrZALx52xTCdVyGE3lHgEVAJL0DxaIVTyavTkqJSrRvf7bzSTHpdJB3yOkxsw%2BjgRk55Cj8awOc2k1SGH4JZp6yymR1x7InI4hSKNQcWaSSuESoNTaKZGJaVcSGLS%2Ff5rzaTHjfdxFWPS3hRM2taatFrk0FeMSXtTMGlba9JqodJTjEnP2CSRWQsEd4LxyV4am%2FAvbWvVCVkgPBAUrVIhVTkRcamQulNdLQS7XFYtxD6nRE2jXMhp7FxdS4QMH2Vlj6OC17UFR86tEgIXwhFcivvtK8th%2BSd6DF%2BWg0qAvZ%2FSNwqDuUxLHbwwDtafubPrVw%2FGhq6SY9mUGTYemtmdaOL9JvBOZVmOEu%2FS%2Fzw28ba5nA3LYPkZvSWVXEpp7%2BkxPNpNo78IoA4%2BVsWgsIwzKH2JmVn2I8wGvOSBSt1wwUuuIBIe7nwsIwPFUo1rc21GHWtFbkqXaFVRpsIjqVJTJVtKC1zKQ2Qdxn22eEYGpKmkslTSVYxImiQkjEsl%2BwvUaSo5KpV0yRSvDJHsz1%2BTmS30CLXkevOFNN0cuSoSl9oGD01QHI4KIMmvimQKctvC%2FZTJbU36qXPbFM1tg6g8LnLeRJ%2F4hLnBZFgbXALlyKcWO6cknwZXS9uyPXaQJk8XkU9JMiammV0gY76WgJYyZh8Bdf07YfHNoUioFkGvxiuViyO8OlQmaSIZ1JJVnVuXRVI6JZgyz49VVBixLBKUP1aspIKuxvkGxE6firgeC%2FYbU%2BqkkrbKwLiZ4qlhrCiMA181GDNL2buNTHm9o%2F5YOMJArvpKSDvqqy%2BruQwewBIQSas0LJ%2Bx6oFDVgIKIKFJMGOV4uX58CnHWsN8lLXHSqfg4Ah1yIxfB3%2FIQSh%2FIkBoSaYlIpQxhmEQ%2Br9AbmmSNaPCign3WpAOjj%2BP4jhr%2FDG6cgJ%2Fp49UeUzpSOX8uhrJvSeSiGQm0WgkMyRfjtd6zUXnzqtfXFY8hcCdt4pjB8rcQV4LZby4cbAMZ%2BLK39tOaaI4cm2cJ5jrIQH%2BFG6pRY1xRI0CfMMvc%2Bp03LWvnCDDgEh%2Bwdtwgzr9dr7HL22tVSWpNWiTOOHaSSaFTY8QJSAoHTqtnQuYn7ZzSalyX1rAhsg2NHkQB9OGCNBaY5onj8ST5TBly%2FMtGHOxO2sMtkx5kLJx9OrMp%2FMxJjXtaWwrE5OSjlpLWXzQFWC8nO543eKKY%2FDIP6L5Ks02zXXadeznlFKdw5UqwbVzu6VKSOMYQarzusEg08Z%2BNsvqaKlO1dhPFzu0Yz%2B7OB5TsPNk6ckCEqoV40lJKFWbq%2BM%2FuzkdLhnfRoj%2FFNQZmz7%2Bs1sNSkeBThkF6vhcXWWHLHsTRYFeWKRMLmox6oErF6VhOyVsZ04HttMu6UryszLyqg63exMC6yzg%2FH9TC6zkwRzRggSe3vdsQjpuHCqFyOEtlb7n3jmW787M8pNfAskKRJtPOMwHsWHKqkUGfqpeCJbbtBXzqJFwDKCeXV3MDfh1kmRHwlkGjZrk8mLXlxAb0F%2BDF3dRcJH8cnm4eNRJfBarVxxNG%2FbN%2Fup4NmV3DMpsqyu%2FwjrkomxYSHWcAPh%2Fv%2F7yJm1DR5F10ja0iZfLYr6d8iVncENDLMRBnlsGFE%2BQvOZQZnBTfJNiNmcgbwHqSwrDA01PTz%2F3CvnLdHHYFLeslkZ6HhaYoG%2FcmX5jIsPL7zcinqG3lrh5gUcAtzwEdGj2M%2BhQ5k3TXOiy59nSYEkbGBg6isXR6DAaWWE0u0O2g2EaotQGWV3qOJoxl%2BGfuQsQOwFdcy%2BIrGV4K0kwa2kOXOHXE8qrApVfL5TchhHOmJnuqGhW5j6NrTm4FJxB2AUcnSjLTWugXt6DnDJDKSde4DlutDIWhrdyndCkGTC4u%2FFLGi7nYRJuF1GmfY6K%2BByDWRteVYBGU4SgfVoiBMXnXkN9O9g7FUtUoiSZo1CBM%2Bcoe%2B%2Btfli2ffga7uFJXbmAh1pSwQXuF9RijoGsJRzUqWnXCa4Gt4i%2FG3QlV4CYgOnTWr6Dwq5fhxbA7lT9oQZaBBDTWBoaS3z%2BkxhLguIvVcj0oFjqqs8lbjBe%2FOqqrLbQt6wp2WTocykTlIw3At%2FbiISMKlVPFbytVoLApGqLLzApi2Xt8dWWNsEMWJBDf4Yprc0r7iBBBRnBg3zW6itTe%2B%2BmVcBZVOJRDbyE%2B9hQ9jnXHVNK%2BpDM7%2B6c0L6rBY3E%2B0sAvmprxmngK0nCJeMeKP7YwH93q8dNimzmNh4%2BJqhK2%2BYNnGfX3MBD3dmuFTiQ3eZBdlEbkR5EF7m%2Bb9EenHN9uOiiLlTfXZ0tDdW3AdVeBtYwRvxzixo6Vscwfov%2BOkCpDO3SV8il71GXNmOX4tGHv1mKhqQabvBkn7%2BCsQr3%2BBs%3D%3C%2Fdiagram%3E%3C%2Fmxfile%3E</div></div>



</div>
<script type="text/javascript" src="https://www.draw.io/embed.js?s=flowchart"></script>',
            'slug' => str_slug('Server Node Diagram'),
            'order' => 1,
            'created_by' => 1,
            'approved' => 1
        ]);

        Page::create([
            'chapter_id' => $monitoringChapter->id,
            'title' => 'Sensu Process Diagram',
            'description' => "A diagram showing the process Mayden use to operate Sensu monitoring.",
            'content' => '<div class="diagram"><div class="mxgraph" style="position:relative;overflow:auto;width:100%;">
<div style="width:1px;height:1px;overflow:hidden;">7V1Zk6M4Ev41FbH7UAT38VhV3bUdG9NzdE3M7D5iG9tsYePFuLuqf/1kQgpLgPCB8DFt4wtxCenLU6nkznpavP0rC1fzz+kkSu5MffJ2Z324M03Td3X4wZL3ssRwXLcsmWXxhMq2BS/x94gK6cDZJp5Ea2HHPE2TPF6JheN0uYzGuVAWZln6TdxtmibiVVfhjF1xW/AyDpNm6Z/xJJ+Xpa7jbMs/RfFsTld2Tar3KBy/zrJ0s6TL3ZnWtHiVmxchOxXtv56Hk/SbUPSmUyt65fo7rdvs0kuhit/TdCEUZNG6ak465TSmerJaptkkyugyVJbEy1e+0ayP0MFZmsKR+G/x9hQl2Mms+8rDniVbq/bLoqVwbdkBtuUZhh4ERjia+Jbp3jt+eYqvYbKhu6Emy99ZL32bx3n0sgrHuP4NoHhnPc7zRQJrBvwt+iHCC0ATPlZNjSuzJFzj3eL/cbqIx/Q/CUdR8lh14lOapNhOy3QJl3hc51n6GrFC6NsPLi6wZRonCVf+bOKC5ekyJ3RbxX6wzu1nfsQFysMknmG/jqG5sGce6eajLI+IqlqadNtRQIlRuojy7B0RxMiQAFSuWtTR37Z4tj0qm3NYNgxWGhIeZtWptx0If6gP9+3PoNGfP1uNHoW7hWrwnSi2OXUE39xUxFowiaZ4Bmy5GOj5gYpHaZ4joTy2YSaFvadJAY55PJlEcIAMPFil48DDQcEInCYWPgS4qOl6i46grg8YW+X73iWGwve9xXZU2vU+cTKun6MJsFtaTbN8ns7SZZh83JbW2p8DRPQW5//BYg0bEdf+y7YsoablJqS9YhW30Z64+muUxXBDBfMr+jUPs/wBBQZP5VD2DAjj96GeQxqOlpPaEVDC7f+/KM/faf9wk6cIsOoWf0pTQByHbCZe/BpEGPfguYWBC5SvkjBe3o+QkIqGxdbsRgo0frrJCswjZ7Aj04nc0PYDZzQxg3vGKuBOZxEd1+jGgv82IZdFSZjHX8UKtOGnOBRaLsSj2A6rNF7ma+7Mv2IBx8QMkYsZhlMTJLUDbGi5Xge44v7wp6zzFvvVzR9HDh610U2yHcveXEvsshbR5tqnE20e1Ybr0Ic/XwaQbVUb1qXbAqRWwTUvQroBv29Kt0dc1HS/b5Hoou4npZwXbjZpG3zvmwYd1qfzPWsy8s3A9acRcpbg3uhPzZKW3doODSqsypt0a+Oipp09XWxnj1EP39KgyjTVCGb/KSWzJpXdmW6CJDWJvwoN7v5/g3bLI1LcPRHPA1qLJf1U2+HfjH6L86zRuGo7EYL5vjSr8DyGtXqDn+JINJyie3b3xVbQPhqX+PfLLz/Dtqd0OY1nIO/KC0IblNcU6wHFxS2x0hqcgFxX+HedR4ikU8sKntRx7xql68WrjWuRXapregBi3UOlrNRkVptsBTfXH7G2RWhkspytc4g12ySDSfxCLWCbnECB3sv+c5otrClWbMeIDMQDp9vihZXotoUOK0MNp9sKGn2lwjNt/zjVV8ZVOjVfpzBg+qq+Dc3T0F1DMzwXzHDH903LIR8ZE2s2rbMzlnWkk2xxeahK7TJ9pVJ4y5rLFGTDYEBuP0C9hmyT3OmSqciaVlKWQX7BcMR2J5o/QPixQ+imQeY3WQmZCqKS6Q3BS2y59ENK2ktq+SC1CiFTk01fwtEozj//Bvv8tonQqKzEUHluiRw6p+BhLGUvwVPylFkWFbqvVHkGUTyOl7OKO9ZUK8fxHNvaV7WSgFqKN2aF8vCyyPbl4WXbGkjOAQBGUN5Nc3Jbrxc57t1gzOhzNGoeQbi3qKOGbaFKprzJWPcMy6YkPdVsl7M1Q9Oze4pmKFv/gpqhTWgdwaEb7Pn3cP2KG+EjWBH7smlRF0PfDTMgFm8zHL/T0DswnoMyqC02MMZ2P0nHm0XR8gMwcdGSrfxMUJNJDNfktj3ZuNR8TfswfhoDIH7+U7FW2iqceGqVXmkWf4eTh2ynuqzIUcNlJ/69UHfJDjxGJJSUc0EQpmvJTGzRSu2HatHmFpCOVZAhvc1cHqFJXzegRZLYy64ebPBJlXtOierUSUGiCqQW1ewUolPJDjT82r5oM08DULWmj8nXbH8IRcii0aozEwGMjd6I4IqJQKKdtBOBZ2mWz9EAaVRnowEy8JWP2BbDslftu+o0PPuOyzb6QcJJe/qdLM/RLO4l+kytoHUrO31Z34YTqjlwyyK+tqcdxJtl2bUwF68kLVm9GvtTvQZzZjnNKJeTeYEr/2kVHjFsPMTfiPSYP6bTMVzuNFxMhMDA++KQRM6QOCzGdP5WYTiqMdcJJ4nO0JPdm66vWY4Z2BD+gGMNLK6UxYGZGjcEUR8I25fd26ajudwrEK/iwKhoh1BRJAvqIY+2W/JeqYyq7e+QkiW9Sa9zf/WyozW4gPR9psHH4SrfQKNAVSoFv9q4c2R7v9HrMUR4S+0Pyej0Ms1l2v6JBgnMlriknaPTCK7agIGKiKXauDSdgA+kaFPwGRUpVe6JKIRwpdUqAVstj1Ps17qt+4+X98Vqni6h8s//PDBG4QJQ0DXavDcK+kOABUAzk4/1N4cBS28JWwqGiKVhyvmQIbkXr09C2GADGY8PuBwl3NULbsPTHM+wTb/8rgHIDzTeZUCiaYdIPfAivgcRCtU2xyPWsUM7UBIl2za4JnXD9ZRvB3vzzDZv3lO6WIQw8wfnKuEsG0COnm0qjir3x+3tzzvMcTdk2GhBXWqH9HdHvGdwaQWyuBY9yiiHY8QwwNIy8j6Ep40Fi1wRzL9EaxglpMluN3BfFrirSMYudJunQrfPpjmq9iN3TP0RAgV/3Dk+Tf8PdXCnB6KUuj00meOhMoibtHuSmGqoDKuunhQtTP3qREtpSZ4FLYM4MzvRsvVt3hhLqwpzoVAxjKa/owGeHXFB4XpVZhmYxm8IoCqCKl6nTxtQ9FVqD835PaybmSejck63GLDVRKvacHy923tOwBOtRDYIzSkZzG0hxC0xn4daXnACX0aXjlGS420eMc4jJn8lzwqaOykZ1T50bAAgI84L1mk2m3SgmM0rlBzQ29svbb2jvf1fohU4Hg6L0t83uqcen0nFKiZtiR0T+LbmopWO0yttFlXLmy+Gr7m+sV2o2YTIGIhh8DzL8e1Ah9wzbCKjWh8qqUjK+Q6M+vCDqrqN82k57mNDjJwwrqrDTKFL5kH7Ololo8NtkQ2qRvmZctA9zG8UrGCACWAqvK0tnAvmiHDnEQctfTdo26p4KLZxa0Qt8jqL061q+w/AbJv+5TSDaVBQdJ1s1HB8zYNpa9Uiiq/Ah5hxHWYweYYb+BXuz89XJfqB0DPgaYSWv9qugeFfzbedahEj46A3NC8ABxwkNoA4YZYt5wIlnsHCVm+mlDJTCqixZks155mezpYiSXfrYYU9bHoivZ+5h1kiwbNOrmZTJ1mT4JyfekAMk9BinoaauqII9dQjN9QfgHoZtDomPbha4FdLc5KDYZkakEK10EXFqW9t51CMhjY7/IYG1WgINB3HK7cv0d3iuZoTwPglezfHMT1P45UiNoLEw8V3NUh0yC2D4IVQqMgRIBvK1GAK8PXFT3ch7iD/o1yS7bDwqc93WPh9U7z0gM8eaQRu7KYvu7FAtuigVFSLqJQZMCcKEuP4MB0IsvLgn4tlN1Xu6KHZTcklbuxmCHZztjgLHPnpnafClmQSOio/xWXmxVTJJXmEsnwWfDR6sRw91VjK+VjmKsgyZuqB77mQvgj+tOjdpqW5NvciDIs5HcFJBRGBlu24xZ9BsKkgyxViswHMly9QG+Cbz/D9Ei3XacbnYLzB8xzwZIJZB+em51eL6A4DvV+zmUhG2dzmtw40GtMulxbBfBr0tgWaHIheV5ajDRzf6ziH/DTwWIzumNs+WSpkl4c7O3teiSuJ9G2bdDYsBRmOpQUQnVAttezYwP5h0Ee3A8sv/1wsCe2Y83HZKX6f5tH4tQqO/+ULKkJY9BmaBXD0Y6b8babg4rIAD5QDWIS/3eJuP10OYIM9iuM8qVQ46w6Yu2jfwVjh1Rl4bY8aqLjrBUzZc5kvsMpGcmT6lHr62caJJHEaSmadMwoaMlXENvget90DPoH+xGwRRbLVGz5V4jOoTX6DkIHj8GnoLEmz7EwDArTMxy3oCWjUbVo04JcoA2lyoJQdly7TM0rZwx6pUpOyW6H6Dg0JlVIQpaDXGFuRoK6Ro6ztWRCDPHLFYBlEzixWDU2HfCoC2zIgUfgPzrZUpFYqp6udOkrcYoph5X4o6yrPJlbbn6J5hssm1ozPkbG+pwSj2a6O9RWxzBfE+mpzXcwW8xkesNfC+Jjmr5jxDTLb5cB0cqCtbQejy2N8aJcb2+tie/vMqOz9pJEewDrBUxprIPJg3hg/kQpQdZ2ZCdue5zkckPaacNlbfh6NpB0ZLS7ciUdDl/o0g8fFNh+IcvPdyX13cO4kXv1BtcL/n4RnNSl9tJfF8mmdya030AT0Q916NdsDGukK+eclmh9KHvl1msyu7Iauk+N+gpRZwOZeb1y2D5fdO1P9Li5bs2dZoP4AXBZWsxShsKUDfBrNZ8g1inv8BQ==</div>
</div></div>
<script type="text/javascript" src="https://www.draw.io/embed.js?s=flowchart"></script>',
            'slug' => str_slug('Sensu Process Diagram'),
            'order' => 1,
            'created_by' => 1,
            'approved' => 1
        ]);

        Page::create([
            'chapter_id' => $serverChapter->id,
            'title' => 'Server Map Diagram',
            'description' => "A diagram showing the iaptus servers, their associated modules and databases, and places where communication happens between servers and modules.",
            'content' => '<div class="diagram"><div class="mxgraph" style="position:relative;overflow:auto;width:100%;">
<div style="width:1px;height:1px;overflow:hidden;">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</div>
</div></div>',
            'slug' => str_slug('Server Map Diagram'),
            'order' => 2,
            'created_by' => 1,
            'approved' => 1
        ]);

        Page::create([
            'chapter_id' => $generalChapter->id,
            'title' => 'iaptus Dictionary / Thesaurus',
            'description' => "A summary of terms used in the iaptus system and synonyms you will often hear them being referred to as.",
            'content' => "
            <h3 id='clinicalcontacts'>Clinical Contacts</h3>In the iaptus system, clinical contacts are synonymous with 'sessions' and 'episodes'. Read about sessions <a href='#sessions'>here</a>.<br/><br />

            <h3 id='episodes'>Episodes</h3>In the iaptus system, episodes are synonymous with 'sessions'. Read about sessions <a href='#sessions'>here</a>.<br/><br />

            <h3 id='referrals'>Referrals</h3>Referrals are also known as treatments and are stored in the <code>nh_treatment</code> table. As far as the system is concerned, 'referrals' and 'treatments' are synonomous and refer to a specific avgenue of treatment that a patient receives. A patient may receive multiple avenues of treatment depending on their problem descriptor or stages of other treatments at the time. Sessions/episodes belong to specific referrals/treatments, and each referral/treatment belongs to a patient.<br/><br />

            <h3 id='sessions'>Sessions</h3>Sessions are also known as 'episodes' and 'clinical contacts', and are stores in the <code>nh_session</code> table. The word 'session' describes any official contact that a patient has had with a therapist during the course of a <a href='#referrals'>treatment or referral</a>. This could be face to face in a therapist's office, over the phone, in group sessions and more - there are many different types of sessions a patient can participate in. Each session belongs to one iaptus <a href='#referrals'>referral</a>.<br/><br />

            <h3 id='treatments'>Treatments</h3>In the iaptus system, treatments are synonymous with 'referrals'. Read about referrals <a href='#referrals'>here</a>.<br/><br />

            ",
            'slug' => str_slug('iaptus Thesaurus'),
            'order' => 1,
            'created_by' => 1,
            'approved' => 1
        ]);
    }
}
