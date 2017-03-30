<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageDraftRequest extends FormRequest
{
    /**
     * @return boolean
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'chapter_id' => 'numeric',
            'title' => 'min:5',
            'description' => 'min:10',
            'content' => 'min:10'
        ];
    }
}
