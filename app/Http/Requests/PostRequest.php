<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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
            'title' => 'required',
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore(request('post_id'))],
            'thumbnail' => 'image|mimes:jpg,png,jpeg|max:512',
            'excerpt' => 'required',
            'body' => 'required',
            'featured' => '',
            'categories' => ['required', Rule::exists('categories', 'id')]
        ];
    }
}
