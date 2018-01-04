@extends('layouts/app')

@section('content')


    @foreach ($posts as $key)

      <div class="row">

        <div class="col-md-12">

            <h2>
              <a href="{{ route('post_path', ['key' => $key->id])}}"> {{ $key->title }}
              </a>
            </h2>

            <small class="pull-right">

                <a href="{{ route('edit_post_path', ['post'=>$key->id] ) }}" class="btn btn-info" >Update Post</a>

                {{-- Hay que emular el tipo de petición delete de la siguiente manera  --}}

                <form  action="{{ route('delete_post_path', ['post'=>$key->id] ) }}" method="POST">

                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}

                  <button type="submit" class="btn btn-danger">Delete</button>

                </form>

            </small>



            <p>Posted  {{ $key->created_at->diffForHumans () }}</p>

        </div>

      </div>

        <hr>


    @endforeach


    {{--
      Para paginar en Laravel traemos la variable declarada en
      PostController@index
      --}}
    {{ $posts->render() }}



@endsection
