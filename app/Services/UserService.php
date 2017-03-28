<?php

namespace App\Services;

use DB;

use App\Models\User;
use App\Interfaces\SearchableService;

class UserService implements SearchableService
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

        return User::searchByQuery($query, null, null, 100);
    }

    /**
     * @param  string $id
     * @return User
     */
    public function getById($id)
    {
        return User::findOrFail($id);
    }

    /**
     * @param  string $slug
     * @return User
     */
    public function getBySlug($slug)
    {
        return User::where('slug', $slug)->firstOrFail();
    }

    /**
     * @return Array
     */
    public function getAllContributionTotals()
    {
        DB::statement(DB::raw('set @row:=0'));

        return User::select([
                'id',
                'name',
                DB::raw(
                    '(
                        ((SELECT COUNT(*) FROM pages WHERE pages.created_by = users.id AND approved = 1) * 3)
                        + (SELECT COUNT(*) FROM suggested_edits WHERE suggested_edits.created_by = users.id AND approved=1)
                    ) as total'
                )
            ])
            ->orderBy('total', 'DESC')
            ->get();
    }
}
