<?php

namespace App\Http\Controllers\ContohCrud;

use Route;

class RouteUrl
{
    public function route()
    {
        return Route::group([
            'prefix' => 'alamat',
            'as'     => 'alamat.'
        ], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'ContohCrud\ViewController@index']);

            Route::post('/create', ['as' => 'create', 'uses' => 'ContohCrud\PostController@createCoba']);
            Route::put('/edit', ['as' => 'edit', 'uses' => 'ContohCrud\PostController@editCoba']);
            Route::delete('/delete/{id}', ['as' => 'delete', 'uses' => 'ContohCrud\PostController@deleteCoba']);
        });
    }
}
