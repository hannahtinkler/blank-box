<?php

namespace App\Services\ModelServices;

use Illuminate\Http\Request;

use App\Models\Page;
use App\Models\Badge;
use App\Models\FeedEvent;
use App\Models\FeedEventType;
use App\Interfaces\SearchableModelService;

class FeedEventModelService
{
    public $feedEvent;

    public function __construct($feedEvent)
    {
        $this->feedEvent = $feedEvent;
    }

    public function getText()
    {
        $type = $this->feedEvent->type->name;

        switch ($type) {
            case 'Page Added':
                $page = Page::find($this->feedEvent->resource_id);
                $text = sprintf($this->feedEvent->type->text, $this->feedEvent->user->name, $page->chapter->title, $page->title);
                break;

            case 'Badge Earned':
                $badge = Badge::find($this->feedEvent->resource_id);
                $text = sprintf($this->feedEvent->type->text, $this->feedEvent->user->name, $badge->name);
                break;

            default:
                throw new Exception("FeedEventType '$type' does not exist");
        }

        return $text;
    }

    public function getImage()
    {
        $type = $this->feedEvent->type->name;

        switch ($type) {
            case 'Page Added':
                $image = '<i class="feed-icon fa fa-file"></i>';
                break;

            case 'Badge Earned':
                $badge = Badge::find($this->feedEvent->resource_id);
                $image = '<img src="' . $badge->image . '" />';
                break;

            default:
                throw new Exception("FeedEventType '$type' does not exist");
        }

        return $image;
    }
}
