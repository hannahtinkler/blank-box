<?php

namespace App\Services;

use App\Models\ResourceType;

class ResourceTypeService
{
    /**
     * @return Collection
     */
    public function getAll()
    {
        return ResourceType::orderBy('name')->get();
    }

    /**
     * @param  int $id
     * @return ResourceType
     */
    public function getById($id)
    {
        return ResourceType::findOrFail($id);
    }

    /**
     * @return array
     */
    public function getAllCategorised()
    {
        $all = [];

        foreach ($this->getAll() as $type) {
            if (!isset($all[$type->category])) {
                $all[$type->category] = [];
            }

            $all[$type->category][] = $type;
        }

        return $all;
    }
}
