<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'chapter_id' => 'required|integer|exists:chapters,id',
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'content' => 'required|min:10'
        ];
    }
}
