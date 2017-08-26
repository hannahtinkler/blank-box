<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageResourceRequest extends FormRequest
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
            'id' => 'required|integer|exists:pages,id',
            'name' => 'required|min:2',
            'type' => 'required|integer|exists:resource_types,id',
            'content' => 'required|min:2',
        ];
    }
}
