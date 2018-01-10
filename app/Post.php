<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Post extends Model
{

    /**
     * Laravel accede a la base de datos mediante el Modelo, laravel intenterá
     * acceder a una table que tenga el mismo nombre pero en plural, solo es
     * válido en inglés, en caso contrario se deberá específicAR
     *
     * Para efecto de este ejercicio nombraré la tabla.
     * @var [create_posts_table]
     */

    protected $table = 'posts';

    //Otro método para llenar los datos de la table es através del método
    // create, para ello debomos pasarle por parámetro en un array lo que se quiere
    // llenar en una table

    protected $fillable = ['title', 'description', 'url'];


    // //Este atributo se le específica para indicarle al método create que campos
    // no debe ser llenado, para efecto de la practica no se necesita .
    // protected $guarded
    //

    public function user(){

      return $this->belongsTo(User::class);

    }

    //Adaptando método para validar si el usuario que creó el post
    public function wasCreatedBy($user){

      if(is_null($user)){

        return false;
      }
      //Con este método comparamos si el usario creó la publicación
      return $this->user_id == $user->id;
    }


}
