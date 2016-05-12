<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChapterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'category_id' => 'required|numeric|exists:categories,id',
            'title' => 'required|min:3',
            'description' => 'required|min:10',
        ];
    }
}
