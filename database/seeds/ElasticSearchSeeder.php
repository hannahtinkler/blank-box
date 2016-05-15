<?php

use Illuminate\Database\Seeder;
use Elasticsearch\Common\Exceptions\BadRequest400Exception;

class ElasticSearchSeeder extends Seeder
{
    private $modelsToIndex = [
        'Category',
        'Chapter',
        'Page',
        'Server',
        'User',
        'Service'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->modelsToIndex as $modelName) {
            try {
                $modelPath = 'App\Models\\' . $modelName;
                $model = new $modelPath;

                $model::createIndex($shards = null, $replicas = null);
                $model::putMapping($ignoreConflicts = true);
                $model::addAllToIndex();

            } catch (BadRequest400Exception $e) {
                if ($e->getMessage() == "index_already_exists_exception: already exists") {
                    $model::reindex();
                }
            }
        }
    }
}
