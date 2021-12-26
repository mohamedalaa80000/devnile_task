<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SupervisorSaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => "required|unique:supervisors,username,Null,id",
            'phone' => "required|unique:supervisors,phone,Null,id",
            'email' => "required|unique:supervisors,email,Null,id",
            'password' => "nullable|min:6|max:255",
            'verify_password' => "required_with:password|same:password",
            'avatar_file' => 'nullable|file|mimes:jpeg,jpg,png,gif|min:10|max:100000'
        ];
    }
}
