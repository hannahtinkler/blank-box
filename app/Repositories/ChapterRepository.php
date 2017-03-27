<?php

namespace App\Repositories;

use App\Models\Chapter;
use App\Interfaces\SearchableRepository;

class ChapterRepository implements SearchableRepository
{
    /**
     * @var Chapter
     */
    private $chapter;
    
    /**
     * @param Chapter $chapter
     */
    public function __construct(Chapter $chapter)
    {
        $this->chapter = $chapter;
    }

    /**
     * @return string
     */
    public function searchResultString()
    {
        return sprintf(
            'Chapter: %s - %s...',
            $this->chapter->title,
            substr($this->chapter->description, 0, 60)
        );
    }

    /**
     * @return string
     */
    public function searchResultUrl()
    {
        return sprintf(
            '/p/%s/%s',
            $this->chapter->category->slug,
            $this->chapter->slug
        );
    }

    /**
     * @return string
     */
    public function searchResultIcon()
    {
        return '<i class="fa fa-folder-open-o"></i>';
    }
}
