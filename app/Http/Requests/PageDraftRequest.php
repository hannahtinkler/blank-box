<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageDraftRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'chapter_id' => 'integer|exists:chapters,id',
            'title' => 'min:5',
            'description' => 'min:10',
            'content' => 'min:10'
        ];
    }
}
