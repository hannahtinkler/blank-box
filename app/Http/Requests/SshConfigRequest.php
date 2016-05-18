<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SshConfigRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ssh_username' => 'required|min:3',
            'bracknell_key' => 'required|min:3',
            'bournemouth_key' => 'required|min:3'
        ];
    }
}
