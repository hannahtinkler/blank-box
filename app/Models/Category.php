<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;
use App\Models\Page;

class Category extends Model
{
    use ElasticquentTrait;

    public $table = 'categories';
    public $guarded = [];
    protected $mappingProperties = array(
        'title' => [
          'type' => 'string',
          "analyzer" => "standard",
        ],
        'description' => [
          'type' => 'string',
          "analyzer" => "standard"
        ]
    );

    public function chapters()
    {
        return $this->hasMany('App\Models\Chapter')->orderBy('title')->orderBy('order');
    }

    public function chaptersWithApprovedPages()
    {
        return $this->hasMany('App\Models\Chapter')->where(function ($q) {
          $pages = Page::join('chapters', 'pages.chapter_id', '=', 'chapters.id')
            ->where('category_id', $this->id)
            ->where('pages.approved', 1)
            ->get()
            ->count();

          $q->whereRaw("$pages > 0");
        })
        ->orderBy('title')
        ->orderBy('order');
    }
}
