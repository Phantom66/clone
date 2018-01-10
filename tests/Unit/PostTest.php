<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */

    public function post_determines_its_author(){

      // Creando Test para validar si es o no el creador de la publicación.
      // Creando user con Factory
      $user = factory(\App\User::class)->create();

      //Creando post con Factory
      $post = factory(\App\Post::class)->create( ['user_id' => $user->id] );

      //Creando otro usuario
      $postAnotherByUser = factory(\App\Post::class)->create();

      //Comparamos usuario, con un método que estamos creando para validar
      //dicha acción, este método se encuentra el Model Post
      //Recibe un array de tipo Post, debe retornar true, porque debe
      //permitir el  usuario que creó la publicación.

      $postByAuthor = $post->wasCreatedBy($user);

      //Recibe un array de tipo Post, debe retornar false, porque no debe
      //permitir el usuario que no creó la publicación
      $postAnotherByAuthor = $postAnotherByUser->wasCreatedBy($user);

      //verificamos que sea verdadero.
      $this->assertTrue($postByAuthor);

      //verificamos que sea falso.
      $this->assertFalse($postAnotherByAuthor);

    }

    /** @test */

    public function post_determines_its_author_if_null_return_false(){


      // Creando un PostTest si el usuario no ha iniciado sessión retorne Post
      //
      $post = factory(\App\Post::class)->create();

      //
      $postByAuthor = $post->wasCreatedBy(null);

          //verificamos que sea falso.
      $this->assertFalse($postByAuthor);

    }


}
