@extends('layouts.app')

@section('content')

  <h2>Creando Post</h2>
  @include('layouts._form', ['post' =>$post])

@endsection
