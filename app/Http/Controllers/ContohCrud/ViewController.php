<?php

namespace App\Http\Controllers\ContohCrud;

/**
 * Berisikan interaski antara backend dengan front-end alias view ajah
 */
class ViewController
{
    public function index()
    {
        $coba_crud = app('App\Http\Controllers\ContohCrud\Repository')
            ->getAll();
        $data['data'] = $coba_crud;
        return view('coba-crud.index', $data);
    }
}
