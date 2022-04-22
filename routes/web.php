<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['middleware' => 'auth'], function ($router) {
    $router->group(['prefix' => 'permission'], function ($route) {
        $route->get('/', 'PermissionController@index');
        $route->post('/', 'PermissionController@store');
        $route->get('/{id}', 'PermissionController@show');
        $route->put('/{id}', 'PermissionController@update');
        $route->delete('/{id}', 'PermissionController@destroy');
    });

    $router->group(['prefix' => 'role'], function ($route) {
        $route->get('/', 'RoleController@index');
        $route->post('/', 'RoleController@store');
        $route->get('/{id}', 'RoleController@show');
        $route->put('/{id}', 'RoleController@update');
        $route->delete('/{id}', 'RoleController@destroy');
    });

    $router->group(['prefix' => 'user'], function ($route) {
        $route->get('/', 'UserController@index');
        $route->post('/', 'UserController@store');
        $route->get('/{id}', 'UserController@show');
        $route->put('/{id}', 'UserController@update');
        $route->delete('/{id}', 'UserController@destroy');
    });
});

$router->group(['prefix' => 'auth'], function ($router) {
    $router->post('login', 'AuthController@login');
    $router->post('logout', 'AuthController@logout');
    $router->post('refresh', 'AuthController@refresh');
    $router->post('me', 'AuthController@me');
});
