<?php

namespace App\Http\Requests\Posts;

use App\Http\Requests\Api\FormRequest;

class PostFilterRequest extends FormRequest
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
        $rules = [];
        if($this->exists('search')) {
            $rules['search'] = [
                'required',
                'regex:/(^[A-Za-z0-9 ]+$)+/',
                'min:2',
                'max:25'
            ];
        }
        if($this->exists('date_start')) {
            $rules['date_start'] = 'required|date|date_format:Y-m-d';
            if($this->exists('date_end')) {
                $rules['date_end'] = 'required|date|date_format:Y-m-d|after:date_start';
            }
        } else {
            if($this->exists('date_end')) {
                $rules['date_end'] = 'required|date|date_format:Y-m-d';
            }
        }
        return $rules;
    }
}
