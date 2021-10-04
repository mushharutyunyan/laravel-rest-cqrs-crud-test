<?php

namespace App\Http\Requests\Posts;

use App\Http\Requests\Api\FormRequest;
use App\Http\Response\ClientResponse;
use App\Models\Post;

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
        if($this->id) {
            $post = Post::byHash($this->id);
            $rules['title'] = ['required', 'regex:/(^[A-Za-z0-9 ]+$)+/', 'min:2', 'max:50','unique:posts,title,'.$post->id];
        } else {
            $rules['title'] = ['required', 'regex:/(^[A-Za-z0-9 ]+$)+/', 'min:2', 'max:50','unique:posts,title'];
        }
        $rules['body'] = ['required', 'regex:/(^[A-Za-z0-9 !-]+$)+/', 'min:10', 'max:2000'];
        return $rules;
    }
}
