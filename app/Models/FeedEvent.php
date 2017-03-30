<?php

namespace App\Models;

use App\Repositories\FeedEventRepository;

use Illuminate\Database\Eloquent\Model;

class FeedEvent extends Model
{
    public $guarded = [];
    public $modelService;

    public function __get($name)
    {
        $repository = new FeedEventRepository($this);

        if (method_exists($repository, $name)) {
            return $repository->$name();
        }

        return parent::__get($name);
    }

    public function type()
    {
        return $this->belongsTo('App\Models\FeedEventType', 'feed_event_type_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function getImage()
    {
        return $this->modelService->getImage();
    }
    
    public function getText()
    {
        return $this->modelService->getText();
    }
    
    public function resourceExists()
    {
        return $this->modelService->resourceExists();
    }
}
