<?php

namespace App\Http\Controllers\Original;

use App\Http\Controllers\Admin\Dashboard\FormRequestController as Request;
use App\Http\Controllers\Controller;
use DB;

/**
 * berisikan hanya logic tidak ada yang lain
 * proses crud (logic)
 * */
class PostController extends Controller
{
    //

    public function createCoba(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'name'        => $request->name,
                'description' => $request->description
            ];

            app('App\Http\Controllers\Original\Repository')
                ->create($data);
            DB::commit();
            $route   = route('alamat.index');
            $message = 'Berhasil tambah data';
            return $this->resSuccess($route, $message);
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->resError($th);
        }
    }

    public function editCoba(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'description' => $request->description
            ];

            app('App\Http\Controllers\Original\Repository')
                ->edit($request->id, $data);
            DB::commit();
            $route   = route('alamat.index');
            $message = 'Berhasil edit data';
            return $this->resSuccess($route, $message);
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
            return $this->resError($th);
        }
    }

    public function deleteCoba($id)
    {
        try {
            DB::beginTransaction();

            $find = app('App\Http\Controllers\Original\Repository')
                ->getFind($id);

            if (empty($find)) {
                return $this->resError('Data tidak ditemukan');
            }

            app('App\Http\Controllers\Original\Repository')
                ->delete($id);
            DB::commit();
            $route   = route('alamat.index');
            $message = 'Berhasil hapus data';
            return $this->resSuccess($route, $message);
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
            return $this->resError($th);
        }
    }
}
