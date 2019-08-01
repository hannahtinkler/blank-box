<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageForgeLinkBranchRequest extends FormRequest
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
            'branch' => [
                'required',
                'regex:/((^release\/(v\d+\.\d+){1}$)|(^candidate\/(\d+){1}$)|master)/',
            ],
        ];
    }

    public function messages()
    {
        return [
            'regex' => 'You can only switch the active branch to a release, candidate or master.',
        ];
    }
}
