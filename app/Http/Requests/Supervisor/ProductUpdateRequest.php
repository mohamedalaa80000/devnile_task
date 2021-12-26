<?php

namespace App\Http\Requests\Supervisor;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
        $id = $this->product->id;
        return [
             'category_id' => "required|exists:categories,id",
             'name' => "required|string|unique:products,name,$id,id",
             'description' => "required|string|min:8|max:255",
             'image_file' => 'nullable|file|mimes:jpeg,jpg,png,gif|min:10|max:100000'
        ];
    }
}
