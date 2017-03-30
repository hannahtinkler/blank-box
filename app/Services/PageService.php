<?php

namespace App\Services;

use App\Models\Page;
use App\Traits\Sluggable;
use App\Services\TagService;
use App\Interfaces\SearchableService;

class PageService implements SearchableService
{
    use Sluggable;

    private $tags;
    
    public function __construct(TagService $tags)
    {
        $this->tags = $tags;
    }

    /**
     * @param  string $term
     * @return Collection
     */
    public function search($term)
    {
        $query = [
            "bool" => [
                "should" => [
                    [ "wildcard" => [ "_all" => "*$term*"]],
                    [ "match" => [ "_all" => "$term" ]]
                ]
            ]
        ];

        return Page::searchByQuery($query, null, null, 100);
    }

    /**
     * @param  int $id
     * @return Page
     */
    public function getById($id)
    {
        return Page::findOrFail($id);
    }

    /**
     * @param  string $slug
     * @return Page
     */
    public function getBySlug($slug)
    {
        $page = Page::where('slug', $slug)->first();

        if (!$page) {
            $page = $this->getByForwardedSlug($slug);
        }
            
        return $page;
    }

    public function getByForwardedSlug($slug)
    {
        return Page::select('pages.*')
            ->leftJoin('slug_forwarding_settings', 'pages.slug', '=', 'slug_forwarding_settings.new_slug')
            ->where('old_slug', $slug)
            ->firstOrFail();
    }
    
    /**
     * @param  int $userId
     * @return Page
     */
    public function getApprovedByUserId($userId)
    {
        return Page::where('created_by', $userId)
            ->where('approved', 1)
            ->get();
    }

    /**
     * @return Page
     */
    public function getAllUnapproved()
    {
        return Page::where('approved', null)->get();
    }

    /**
     * @return Page
     */
    public function getRandom()
    {
        return Page::where('approved', 1)->orderByRaw("RAND()")->first();
    }

    public function store($data)
    {
        $page = Page::create([
            'chapter_id' => $data['chapter_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'content' => $data['content'],
            'created_by' => $data['user_id'],
            'slug' => $this->getSlug(Page::class, $data['title']),
            'order' => 0,
            'approved' => $data['approved']
        ]);

        if (isset($data['tags'])) {
            $this->tags->store($page->id, $data['tags']);
        }

        return $page;
    }

    /**
     * @param  int $id
     * @param  array  $data
     * @return Page
     */
    public function update($id, array $data)
    {
        $page = $this->getById($id);

        if ($page->title != $data['title']) {
            $oldSlug = $page->slug;
            $page->slug = $this->getSlug(Page::class, $data['title']);
            $this->registerNewSlug($oldSlug, $page->slug);
        }
        
        if (isset($data['approved'])) {
            $page->approved = $data['approved'];
        }

        $page->chapter_id = $data['chapter_id'];
        $page->title = $data['title'];
        $page->description = $data['description'];
        $page->content = $data['content'];

        $page->save();

        if (isset($data['tags'])) {
            $this->tags->store($page->id, $data['tags']);
        }

        return $page;
    }

    /**
     * @param  int $id
     * @return void
     */
    public function approve($id)
    {
        $page = $this->getById($id);
        $page->approved = 1;
        $page->save();

        return $page;
    }

    /**
     * @param  int $id
     * @return void
     */
    public function reject($id)
    {
        $page = $this->getById($id);
        $page->approved = 0;
        $page->save();
    }

    /**
     * If curation is turned off, doesn't need approving so return 1. If
     * curation is enabled and user is a curator, consider it approved. If
     * new data specifies it should be approved, use this value. If no other
     * data available use the old value.
     *
     * @param  array        $data
     * @param  Page|null    $currentPage
     * @return int |null
     */
    public function shouldBeApproved($user, array $data, $currentPage = null)
    {
        if (!env('FEATURE_CURATION_ENABLED')) {
            $approved = 1;
        } else if (env('FEATURE_CURATION_ENABLED') && $user->curator) {
            $approved = 1;
        } else if (isset($data['approved']) && $data['approved']) {
            $approved = 1;
        } else if ($currentPage) {
            $approved = $currentPage->approved;
        } else {
            $approved = null;
        }

        return $approved;
    }
}
