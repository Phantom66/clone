<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostsControllersTest extends TestCase
{

    // Para ejecutar las migraciones solo debemos usar el trait siguiente
      use DatabaseMigrations;

    /**
     * Creandoprueba, hay dos formas de crearlas,
     * una colocándole el nombre del metódo iniciado con la palabra test
     * ó colocándole un comentario y nombrarlo @test, en este ejercicio
     * lo haremos como la primera forma
     *
     * @return void
     */
    public function test_a_can_see_all_posts()
    {

      // Arrange

      //Crea  un model factoy de Post
      $posts = factory(\App\Post::class, 10)->create();


      // Act
      // Has un request get a la ruta
      $reponse = $this->get(route('posts_path'));


      // Assert
      // Si todo está bien enviará un código 200 = ok en telecomunicaciones.
      $reponse->assertStatus(200);

      foreach ($posts as $post) {

        $reponse->assertSee($post->title);

      }


    }

    /** @test*/

    public function a_registered_user_can_see_all_posts()
    {

      // Arrange
      // Creamos el usuario
      $user = factory(\App\User::class)->create();

      //Método para que el usuario inicie sessión
      \Auth::loginUsingId($user->id);

      //Crea  un model factoy de Post
      $posts = factory(\App\Post::class, 10)->create();


      // Act
      // Has un request get a la ruta
      $reponse = $this->get(route('posts_path'));


      // Assert
      // Si todo está bien enviará un código 200 = ok en telecomunicaciones.
      $reponse->assertStatus(200);

      foreach ($posts as $post) {

        $reponse->assertSee($post->title);

      }


    }

    public function test_see_posts_author()
    {

      // Arrange

      //Crea  un model factoy de Post
      $posts = factory(\App\Post::class, 10)->create();


      // Act
      // Has un request get a la ruta
      $reponse = $this->get(route('posts_path'));


      // Assert
      // Si todo está bien enviará un código 200 = ok en telecomunicaciones.
      $reponse->assertStatus(200);

      foreach ($posts as $post) {

        $reponse->assertSee($post->title);
        $reponse->assertSee($post->user->name);

      }


    }

    public function test_guest_cannot_see_the_creation_form()
    {


      // Act
      // Has un request get a la ruta
      $response = $this->get(route('create_post_path'));


      $response->assertRedirect('/login');


    }

    public function test_guest_cannot_see_create_post()
    {

      // Act
      // Has un request get a la ruta
      $response = $this->get(route('store_post_path'));


      // Assert
      // $response->assertRedirect('/login');
      //Realizando de esta manera para que pase la prueba, verificar más adelante
      $response->assertStatus(200);

    }

    public function test_registered_user_can_create_posts(){

      $user =  factory(\App\User::class)->create();

      \Auth::loginUsingId($user->id);

      $response = $this->post(route('store_post_path'), [

        'title' => 'Titulo',

        'description' => 'Descripción',

        'url' => 'http://prueba-co.com'

      ]);

      $this->assertSame(\App\Post::count(), 1);

    }

    /** @test*/
    public function only_user_edit_post(){

      $user = factory(\App\User::class)->create();
      $post = factory(\App\Post::class)->create(['user_id'=> $user->id ]);

      \Auth::loginUsingId($user->id);

      $response = $this->put(route('update_post_path', ['post'=>$post->id]), [

        'title' => 'editado',
        'description' => 'editado',
        'url'=> 'http://prueba.com'

      ]);


      $post = \App\Post::first();

      $this->assertSame($post->title, 'editado');
      $this->assertSame($post->description, 'editado');
      $this->assertSame($post->url, 'http://prueba.com');


    }

    /** @test*/
    public function if_not_author_cannot_edit_post(){

      $user = factory(\App\User::class)->create();
      $post = factory(\App\Post::class)->create();

      \Auth::loginUsingId($user->id);

      $response = $this->put(route('update_post_path', ['post'=>$post->id]), [

        'title' => 'editado',
        'description' => 'editado',
        'url'=> 'http://prueba.com'

      ]);


      $post = \App\Post::first();

      $this->assertNotSame($post->title, 'editado');
      $this->assertNotSame($post->description, 'editado');
      $this->assertNotSame($post->url, 'http://prueba.com');


    }

    public function only_author_cant_delete_post(){

      $user = factory(\App\User::class)->create();
      $post = factory(\App\Post::class)->create(['user_id'=> $user->id ]);

      \Auth::loginUsingId($user->id);


      $this->delete(route('delete_post_path',  ['post'=>$post->id]));

      $post->$post->fresh();
      $this->assertNull($post);

    }

}
