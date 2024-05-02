<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function unthenticathed(){
        return response(['data' => null,
        'message' => 'KO',
        'error' => 'Sesion caducada',
        'api_version' => env('APP_VERSION')], 401);
    }
}
