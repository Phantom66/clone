<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('posts', 'PostController@index')->name('posts_path');

// Con esta ruta nos dirige hacia el formulario posts.index
Route::get('posts/create', 'PostController@create')->name('create_post_path');


//Ruta para visitar un post en específico
// Es importante crear las rutas que no se le va a pasar un parámetro después
// a la que  se le pasa un parámetro, debido a que este le puede pasar el nombre
// como parámetro, ejemplo: posts/create y posts/{key}
Route::get('posts/{post}', 'PostController@show')->name('post_path');

// Está ruta dirige hacia inserción de los datos en la BD.
Route::post('posts', 'PostController@store')->name('store_post_path');

// Te enruta hacia una id en específico
Route::get('posts/{post}/edit', 'PostController@edit')->name('edit_post_path');

// Te enruta hacia una vista en específica para actualizar
Route::put('posts/{post}', 'PostController@update')->name('update_post_path');

// Te enruta hacia una vista en específica para eliminar
Route::delete('posts/{post}', 'PostController@delete')->name('delete_post_path');
