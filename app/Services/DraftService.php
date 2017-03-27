<?php

namespace App\Services;

use App\Models\PageDraft;

class DraftService
{
    /**
     * @param  int $id
     * @return boolean
     */
    public function delete($id)
    {
        return PageDraft::where('id', $id)->delete();
    }
}
