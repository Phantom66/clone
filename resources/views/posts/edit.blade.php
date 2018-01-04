@extends('layouts.app')

@section('content')

  <h2>Actualizando Post</h2>
  @include('layouts._form', ['post' =>$post])



@endsection
