<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends CreatePostRequest
{

    /**
     * Determinar si que solo el usuario que creo el posts
     * pueda a modificar
     *
     * @return bool
     */
    public function authorize()
    {

        return $this->user()->id = $this->post->user_id;

    }


}
