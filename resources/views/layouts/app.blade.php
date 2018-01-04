<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title> Posts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
  </head>


  <body>

    <div class="container">

        <div class="row">

          <div class="col-md-12">

              <h1>Reddit Clone</h1>
              <small class="pull-right">

                <a href="{{ route('create_post_path')}}" > Crear </a>

              </small>


          </div>

        </div>

        <hr>

        {{-- Agegando mensaje de errores a la vista parcial --}}
        @include('layouts._errors')

        {{-- Agregando mensaje de exitos a la vista --}}
        @include('layouts._messages')
          {{-- Para indicarle al archivo de donde vamos a reutilizar --}}
          @yield('content')

    </div>


  </body>
</html>
