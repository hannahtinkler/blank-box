<?php

namespace App\Repositories;

use App\Models\PageResource;

class PageResourceRepository
{
    /**
     * @var Page
     */
    private $resource;
    
    /**
     * @param Page $resource
     */
    public function __construct(PageResource $resource)
    {
        $this->resource = $resource;
    }

    /**
     * @return string
     */
    public function searchResultString()
    {
        return sprintf(
            'Project Resource: %s for %s (%s%s)',
            $this->resource->name,
            $this->resource->page->title,
            strlen($this->resource->content) > 30 ? substr($this->resource->content, 0, 30) : $this->resource->content,
            strlen($this->resource->content) > 30 ? '...' : ''
        );
    }

    /**
     * @return string
     */
    public function searchResultUrl()
    {
        return sprintf(
            '/p/%s/%s/%s',
            $this->resource->page->chapter->category->slug,
            $this->resource->page->chapter->slug,
            $this->resource->page->slug
        );
    }

    /**
     * @return string
     */
    public function searchResultIcon()
    {
        return '<i class="fa fa-cubes"></i>';
    }
}
