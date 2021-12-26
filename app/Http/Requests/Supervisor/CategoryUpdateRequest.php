<?php

namespace App\Http\Requests\Supervisor;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
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
        $id = $this->category->id;
        return [
            'name' => "required|unique:categories,name,$id,id",
            'icon_file' => 'nullable|file|mimes:jpeg,jpg,png,gif|min:10|max:100000'
        ];
    }
}
