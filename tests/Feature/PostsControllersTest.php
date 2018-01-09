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

}
