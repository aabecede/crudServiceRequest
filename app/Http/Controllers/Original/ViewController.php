<?php

namespace App\Http\Controllers\Original;

/**
 * Berisikan interaski antara backend dengan front-end alias view ajah
 */
class ViewController
{
    public function index()
    {
        $coba_crud = app('App\Http\Controllers\Original\Repository')
            ->getAll();
        $data['data'] = $coba_crud;
        return view('coba-crud.index', $data);
    }
}
