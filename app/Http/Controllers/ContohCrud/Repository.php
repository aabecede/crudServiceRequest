<?php

namespace App\Http\Controllers\ContohCrud;

use App\Helpers\Helper;
use App\Model\CobaCrud;

/**
 * hanya berisikan crud
 * find, create, edit, delete
 */
class Repository
{
    //
    public function getAll()
    {
        $data = CobaCrud::All();
        return $data;
    }

    public function getFind($id)
    {
        $data = CobaCrud::find($id);
        return $data;
    }

    public function create($request)
    {
        $data = new CobaCrud;
        Helper::saveEloquent($data, $request);
        return $data;
    }

    public function edit($id, $request)
    {
        $data = $this->getFind($id);
        Helper::saveEloquent($data, $request);
        return $data;
    }

    public function delete($id)
    {
        $data = $this->getFind($id);
        $data->delete();
        return $data;
    }
}
