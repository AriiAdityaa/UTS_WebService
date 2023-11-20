<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/ulasan', 'UlasanController@index');
$router->get('/ulasan/{id}', 'UlasanController@show');
$router->post('/ulasan','UlasanController@store');
$router->put('/ulasan/{id}','UlasanController@update');
$router->delete('/ulasan/{id}','UlasanController@destroy');
