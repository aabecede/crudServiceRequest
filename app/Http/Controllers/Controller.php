<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /** ajax user */
    public function resJsonSuccess($message, $redirect, $data = [])
    {
        $response = [
            'response' => [
                'status'  => 'success',
                'message' => $message
            ],
            'data' => $data,
            'redirect' => $redirect,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }
        return response()->json($response, 200)->original;
    }

    public function resJsonError($message, $error = [])
    {
        $response = [
            'response' => [
                'status'  => 'error',
                'message' => $message
            ],
            'error' => $error,
            'redirect' => '',
        ];
        // return json_encode($response);
        return response()->json($response, 200)->original;
    }
    /** end ajax user */

    /** post biasa */
    public function resSuccess($route, $message)
    {
        return redirect($route)
            ->with('success', $message);
    }

    public function resError($error)
    {
        $error = Helper::parsingAlert($error);
        return back()
            ->with('error', $error);
    }
    /** end post biasa */
}
