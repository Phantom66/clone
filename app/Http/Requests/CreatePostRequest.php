<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{


    public function authorize(){

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
            //
            'title' => 'required',
            'url' => 'required|url'
        ];
    }
}
