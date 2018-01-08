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

      //Comparamos el id del usuario que inició sessión con el id del posts
      //si es el usuario que creó el post puedemodificar de lo contrario no.
      //
        return $this->user()->id == $this->post->user_id;

    }


}
