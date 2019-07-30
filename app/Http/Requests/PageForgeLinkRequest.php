<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageForgeLinkRequest extends FormRequest
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
            'page_id' => [
                'required',
                'integer',
                'exists:pages,id',
            ],
            'server_id' => [
                'required',
                'integer',
            ],
            'site_id' => [
                'required',
                'integer',
                'validForgeSite:' . $this->input('server_id'),
            ],
        ];
    }
}
