<?php

namespace App\Services;

use App\Models\PageResource;
use App\Traits\Sluggable;
use App\Services\TagService;
use App\Interfaces\SearchableService;

class PageResourceService implements SearchableService
{
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

        return PageResource::searchByQuery($query, null, null, 100);
    }

    /**
     * @return Collection
     */
    public function getAll()
    {
        return PageResource::orderBy('name')->get();
    }

    /**
     * @param  int $id
     * @return PageResource
     */
    public function getById($id)
    {
        return PageResource::findOrFail($id);
    }
    
    /**
     * @param  int $userId
     * @return Page
     */
    public function getByUserId($userId)
    {
        return PageResource::where('created_by', $userId)->get();
    }

    /**
     * @return array
     */
    public function getAllCategorised()
    {
        $all = [];

        foreach ($this->getAll() as $resource) {
            if (!isset($all[$resource->resourceType->category])) {
                $all[$resource->resourceType->category] = [];
            }

            $all[$resource->resourceType->category][] = $resource;
        }

        foreach ($all as $category) {
            uasort($category, function ($a, $b){
                return strcmp($a->resourceType->name, $b->resourceType->name);
            });
        }

        ksort($all);

        return $all;
    }

    /**
     * @param  array $data
     * @return PageResource
     */
    public function store($data)
    {
        $resource = PageResource::create([
            'page_id' => $data['id'],
            'name' => $data['name'],
            'type' => $data['type'],
            'content' => $data['content'],
            'created_by' => $data['user_id'],
        ]);

        if (isset($data['tags'])) {
            $this->tags->store($resource->id, $data['tags']);
        }

        return $resource;
    }

    /**
     * @param  int $id
     * @param  array  $data
     * @return PageResource
     */
    public function update($id, array $data)
    {
        $resource = $this->getById($id);

        $resource->name = $data['name'];
        $resource->type = $data['type'];
        $resource->content = $data['content'];

        $resource->save();

        return $resource;
    }

    /**
     * @param  int $id
     */
    public function delete($id)
    {
        $resource = $this->getById($id);
        $resource->delete();
    }
}
