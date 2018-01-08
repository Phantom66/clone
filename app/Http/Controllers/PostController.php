<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;



class PostController extends Controller
{
    //

    /**
     * Retornar un listado de Posts de.
     *
     * @var array
     */

    public function index(){

      // $posts = Post::all();
      // $posts = Post::orderBy('id', 'desc')->get();

      $posts = Post::orderBy('id', 'desc')->paginate(10);
      return view('posts.index')->with(['posts'=>$posts]);

    }

    /**
     * Muestra un recurso en específico
     *
     * @param  Post   $post [Parámetro de nuestra clase Modelo]
     * @return [$post]       [envia un array de los datos de la BD]
     */


    public function show(Post $post){

      // Declarando en el parámetro la Clase laravel nos ahorra todo este código
      // el se encarga de buscar y si no lo encuentra nos arroja un error 404
      // $post = Post::find($key);
      //
      // // revisa el funcionamiento
      // if( is_null($key) ){
      //
      //   abort(404);
      //
      //   }

      return view('posts.show')->with('post', $post);

    }

    /**
     * Se crea una instancia de nuestro modelo
     * para reutilzar en formulario para crear y actualizar
     *
     * @return [array] [ retornar un array con la instancia Post]
     * @var array
     */

    public function create(){

      $post = new Post;
      return view('posts.create')->with(['post'=>$post]);
    }


    /**
     * [store description]
     * @param  CreatePostRequest $request
     * [
     *  Para utilizar clase request en vez de utilizar el método store
     *  (Request $request), le pasamos la clase para que se encargue de
     *  realizar nuestra validaciones aravel es inteligente para entender
     *  en donde se encuentra este archivo.
     *  Inserta los datos a la BD desde una vista.
     * ]
     * @return  view
     */

    public function store(CreatePostRequest $request){


      //1.-$post = new Post;
      //recomendado realizarlo así $request->get('name'), también se
      //puede realizar $request-title
      // $post->title = $request->get('title');
      // $post->description = $request->get('description');
      // $post->url = $request->get('url');
      // $post->save();

      // 2.-Otra manera de realizarlo
      //$post = Post::create($request->only('title','description', 'url'));

      //3.-Creando un variable de tipo Post para pasasrle el user_id
      //del usuario qué está creando el post esto se debe a que como no estamos
      //relacionando las tablas en la base de datos le pasamos el id por el
      //Controller

      $post = new Post;

      $post->fill(
          $request->only('title','description', 'url')

        );

        //Existen diferentes formas de tener el usuario que inicia session
        //Por medio del Facade \Auth::user()->id;
        //Por medio del Request $request->user()->id;
        //o por medio del helper, todas son correctas.
        $post->user_id = $request->user()->id;
        $post->save();

        //dd($post);

      //Luego de crear nuestro Post, enviar un mensaje mediante un session_flash
      //Una session de tipo flash es una que una vez leída se elimina.
      // flash recibe dos parámetros, el nombre de la session y el otro el valor.
      session()->flash('message', 'Post created!');


      return redirect()->route('posts_path');

    }

    /**
     * [edit un recurso en específico]
     * @param  Post   $post [espera un parámetro de tipo Post (Modelo)]
     * @return [@var array]       [Envia a una vista un array del Modelo Post]
     */

    public function edit(Post $post){

       return view('posts.edit')->with(['post'=> $post]);

    }

    /**
     * [update Actualiza un dato en específico]
     * @param  Post              $post    [espera un parámetro de tipo Post (Modelo)]
     * @param  UpdatePostRequest $request [instancia de Request para validar]
     * @return  $post a la vista post_path que muestra un recurso en específico
     * @var array
     */
    public function update(Post $post, UpdatePostRequest $request){

      // una forma de hacerlo correctamente
        // $key->title = $request->get('title');
        // $key->description = $request->get('description');
        // $key->url = $request->get('url');
        // $key->save();

        //Otra manera de hacerlo, más simplificada, utilizando el método update
        // del modelo
      // Este recibe un array asociativo
        $post->update(

            $request->only('title', 'description', 'url')

        );

        session()->flash('message', 'Post updated!!');

        return redirect()->route('post_path', ['post' => $post->id]);

    }

    /**
     * [delete elimina un recurso en específico]
     * @param  Post   $post [espera un parámetro de tipo Post (Modelo)]
     * @return [ view]       [elminia y muestra el listado.]
     */
    public function delete(Post $post){

       $post->delete();

      return redirect()->route('posts_path');


    }


}
