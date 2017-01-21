<?php

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

$app->get('/', function () use ($app) {
    $res['success'] = true;
    $res['result'] = 'Hello world with lumen';
    return response($res);
});

$app->post('/login', 'LoginController@index');
$app->post('/register', 'UserController@register');
$app->get('/user/{id}', ['middleware' => 'auth', 'uses' =>  'UserController@get_user']);

/* Route products */
$app->get('/products', 'ProductsController@index');
$app->get('/products/{id}', 'ProductsController@read');
$app->get('/products/delete/{id}', 'ProductsController@delete');
$app->post('/products/create', 'ProductsController@create');
$app->post('/products/update/{id}', 'ProductsController@update');