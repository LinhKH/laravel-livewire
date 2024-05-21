<?php

namespace App\Http\Requests;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
            'category_id' => ['required', Rule::exists(Category::class, 'id')],
            'brand_id' => ['required', Rule::exists(Brand::class, 'id')],
            'name' => ['required','string'],
            'slug' => ['required','string'],
            'small_description' => ['nullable','string'],
            'description' => ['nullable','string'],
            'original_price' => ['required','integer'],
            'selling_price' => ['required','integer'],
            'quantity' => ['required','integer'],
            'trending' => ['nullable'],
            'featured' => ['nullable'],
            'status' => ['nullable'],
            'image.*' => ['nullable'],
            'colors.*' => ['nullable'],

            'meta_title' => ['required','string'],
            'meta_keyword' => ['required','string'],
            'meta_description' => ['required','string'],
        ];
        
    }
}
