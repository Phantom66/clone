@extends('layouts/app')

@section('content')


    @foreach ($posts as $key)

          <h2>
            <a href="{{ route('post_path', ['key' => $key->id])}}"> {{ $key->title }}
            </a>

            {{-- Colocando está condicional para validar si el usuario inició sessión
            && si el id del usuario recibido es el mismo que el usuario autorizado,
             para permitir que vea los botones solo de su publicación creada. --}}
              @if ($key->wasCreatedBy(Auth::user()))
                  {{-- Método creado en el Model --}}
                <small class="pull-right">

                  <a href="{{ route('edit_post_path', ['post'=>$key->id] ) }}" class="btn btn-info" >Update Post</a>

                  {{-- Hay que emular el tipo de petición delete de la siguiente manera  --}}

                  <form  action="{{ route('delete_post_path', ['post'=>$key->id] ) }}" method="POST">

                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button type="submit" class="btn btn-danger">Delete</button>

                  </form>

                </small>
              @endif
          </h2>
              <p>Posted  {{ $key->created_at->diffForHumans () }}</p>

      @endforeach
        {{--
        Para paginar en Laravel traemos la variable declarada en
        PostController@index
            --}}
        {{ $posts->render() }}



@endsection
