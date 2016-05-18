<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Custom Elasticsearch Client Configuration
    |--------------------------------------------------------------------------
    |
    | This array will be passed to the Elasticsearch client.
    | See configuration options here:
    |
    | http://www.elasticsearch.org/guide/en/elasticsearch/client/php-api/current/_configuration.html
    */

    'config' => [
        'hosts'     => ['localhost:9200'],
        'retries'   => 1,
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Searchables
    |--------------------------------------------------------------------------
    |
    | This is an array of models which should be used when performing a search
    */

    'searchables' => [
        'Server',
        'Service',
        'Page',
        'Chapter',
        'User'
    ]

);
