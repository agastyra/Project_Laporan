<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class APIController extends Controller
{
    public function get_provinsi()
    {
        $response = Http::get('http://dev.farizdotid.com/api/daerahindonesia/provinsi');
        $data = $response->json();

        return $data;
    }
}
