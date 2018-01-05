<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
    /**
     * Determinar si que solo el usuario que creo el posts
     * pueda a modificar
     *
     * @return bool
     */
    public function authorize()
    {


        return $this->user()->id = $post->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'title' => 'required',
            'url' => 'required|url'
        ];
    }
}
