<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// $router->group(['middleware' => 'auth'], function ($router) {
    $router->group(['prefix' => 'role'], function ($route) {
        $route->get('/', 'RoleController@index');
        $route->post('/', 'RoleController@store');
        $route->get('/{id}', 'RoleController@show');
        $route->put('/{id}', 'RoleController@update');
        $route->delete('/{id}', 'RoleController@destroy');
    });

    $router->group(['prefix' => 'permission'], function ($route) {
        $route->get('/', 'PermissionController@index');
        $route->post('/', 'PermissionController@store');
        $route->get('/{id}', 'PermissionController@show');
        $route->put('/{id}', 'PermissionController@update');
        $route->delete('/{id}', 'PermissionController@destroy');
    });
// });
