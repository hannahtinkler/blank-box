<?php

namespace App\Services;

use App\Models\Chapter;
use App\Traits\Sluggable;
use App\Interfaces\SearchableService;

class ChapterService implements SearchableService
{
    use Sluggable;
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

        return Chapter::searchByQuery($query, null, null, 100);
    }

    /**
     * @param  int $id
     * @return Chapter
     */
    public function getById($id)
    {
        return Chapter::findOrFail($id);
    }

    /**
     * @param  string $slug
     * @return Chapter
     */
    public function getBySlug($slug)
    {
        return Chapter::where('slug', $slug)->firstOrFail();
    }

    /**
     * @param  int $id
     * @return Chapter
     */
    public function getByCategoryId($id)
    {
        return Chapter::where('category_id', $id)->orderBy('title')->get();
    }

    /**
     * @param  array  $data
     * @return Chapter
     */
    public function store(array $data)
    {
        $slug = $this->getSlug(Chapter::class, $data['title']);

        return Chapter::create([
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'slug' => $slug,
            'order' => 0,
        ]);
    }

    /**
     * @param  Chapter $chapter
     * @param  array  $data
     * @return Chapter
     */
    public function update($chapter, array $data)
    {
        if ($chapter->title != $data['title']) {
            $chapter->slug = $this->getSlug(Chapter::class, $data['title']);
        }

        $chapter->category_id = $data['category_id'];
        $chapter->title = $data['title'];
        $chapter->description = $data['description'];
        $chapter->save();

        return $chapter;
    }
}
