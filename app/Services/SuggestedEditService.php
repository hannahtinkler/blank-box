<?php

namespace App\Services;

use App\Models\SuggestedEdit;

class SuggestedEditService
{
    public function getById()
    {
        return SuggestedEdit::find($id);
    }

    public function getAllUnapproved()
    {
        return SuggestedEdit::where('approved', null)->get();
    }

    public function approve($id)
    {
        $edit = SuggestedEdit::findOrFail($id);
        $edit->approved = true;
        $edit->save();
    }

    public function reject($id)
    {
        $edit = SuggestedEdit::findOrFail($id);
        $edit->approved = false;
        $edit->save();
    }
}
