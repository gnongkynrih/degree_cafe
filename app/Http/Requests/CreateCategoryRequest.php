<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:4|max:25|unique:menus,name',
            'description' => 'nullable|string|min:4',
            'price' => 'required|numeric|min:10',
            'category_id' => 'required|exists:categories,id'
        ];
    }

    public function messages() : array{
        return [
            'name.required' => 'Item name is required',
            'name.min' => 'Item name must be at least 4 characters',
            'name.max' => 'Item name must be less than 25 characters',
            'name.unique' => 'Item already exists',
            'description.min' => 'Description must be at least 4 characters',
            'price.required' => 'Price is required',
            'price.min' => 'Minimum Price Rs 10',
            'category_id.required' => 'Category is required',
            'category_id.exists' => 'Category does not exist',
        ];
    }
}
