<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
            'chapter_id' => 'required|integer|exists:chapters,id',
            'title' => 'required|min:3',
            'description' => 'required|min:10',
        ];
    }
}
