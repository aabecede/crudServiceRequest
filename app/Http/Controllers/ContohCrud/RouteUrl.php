<?php

namespace App\Http\Controllers\Original;

use Route;

class RouteUrl
{
    public function route()
    {
        return Route::group([
            'prefix' => 'alamat',
            'as'     => 'alamat.'
        ], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'Original\ViewController@index']);

            Route::post('/create', ['as' => 'create', 'uses' => 'Original\PostController@createCoba']);
            Route::put('/edit', ['as' => 'edit', 'uses' => 'Original\PostController@editCoba']);
            Route::delete('/delete/{id}', ['as' => 'delete', 'uses' => 'Original\PostController@deleteCoba']);
        });
    }
}
