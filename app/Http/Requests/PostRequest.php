<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        // get route info
        $route = $this->route()->getName();

        // set rules
        $rule = [
            'title' => 'required|string|max:50',
            'category' => 'required',
            'body' => 'required|string|max:2000',
        ];

        // if from store or update routing, set image rule
        if (
            $route === 'posts.store' ||
            ($route === 'posts.update' && $this->file('image'))
        ) {
            $rule['image'] = 'required|file|image|mimes:jpeg,png';
        }

        return $rule;
    }
}
