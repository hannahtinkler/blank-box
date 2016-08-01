<?php

namespace App\Models;

use App\Services\ModelServices\FeedEventModelService;

use Illuminate\Database\Eloquent\Model;

class FeedEvent extends Model
{
    public $guarded = [];
    public $modelService;

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->modelService = new FeedEventModelService($this);
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
}
