<?php

namespace App\Models;

use App\Repositories\FeedEventRepository;

use Illuminate\Database\Eloquent\Model;

class FeedEvent extends Model
{
    public $guarded = [];
    public $repository;

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
        return $this->repository->getImage();
    }

    public function getText()
    {
        return $this->repository->getText();
    }

    public function resourceExists()
    {
        return $this->repository->resourceExists();
    }
}
