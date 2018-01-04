
@if( $post->exists )

  <form  action="{{ route('update_post_path', ['post'=>$post->id]) }}" method="POST">

    {{  method_field('PUT') }}

@else

  <form  action="{{ route('store_post_path') }}" method="POST">

@endif

 {{--
      Simplificando formulario
      Se verifica todo lo que se asemeja uno del otro, y se adapta
      para así convertirla una vista parcial, y simplificar formularios.


      --}}

      {{--
       Esto significa si existe la variable post se crea uno nuevo y me envía
      al formulario nuevo, de lo contrario me envia al de actualizar.

      Ejemplo: si el post existe se actualiza sino se crea una nueva.
       --}}



  {{ csrf_field() }}

  {{-- Title field --}}
    <div class="form-group">
      <label for="title">Title:</label>
      <input type="text" name="title" class="form-control" value="{{ $post->title or old('title') }}">

    </div>

  {{-- Description Input --}}

      <div class="form-group">

        <label for="description"></label>
        <textarea name="description" rows="5" cols="80" class="form-control"> {{ $post->description or  old('description') }}</textarea>

      </div>

      <div class="form-group">
        <label for="url">Url:</label>
        <input type="text" name="url" value="{{ $post->url or old('url')  }}">
      </div>

      <div class="form-group">
        <button type="submit" class='btn btn-primary' > Save Post</button>
      </div>

</form>
