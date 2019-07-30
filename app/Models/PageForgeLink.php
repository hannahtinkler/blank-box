<?php

namespace App\Models;

use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model;

use App\Repositories\PageResourceRepository;

class PageForgeLink extends Model
{
    public $guarded = [];

    public function page()
    {
        return $this->belongsTo('App\Models\Page');
    }
}
