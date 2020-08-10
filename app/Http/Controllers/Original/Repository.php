<?php

namespace App\Http\Controllers\Original;

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
        $data->name = $request['name'] ?? null;
        $data->description = $request['description'] ?? null;
        $data->save();
        return $data;
    }

    public function edit($id, $request)
    {
        $data = $this->getFind($id);
        $data->name = $request['name'] ?? null;
        $data->description = $request['description'] ?? null;
        $data->save();
        return $data;
    }

    public function delete($id)
    {
        $data = $this->getFind($id);
        $data->delete();
        return $data;
    }
}
