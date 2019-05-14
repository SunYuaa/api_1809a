<?php

namespace App\Http\Controllers\Test;
use App\Http\Controllers\Controller;

class DemoController extends Controller
{
    //
    public function demo()
    {
        header('Access-Control-Allow-Origin: http://client.1809a.com');
        echo time();
    }

    //注册
    public function reg(){
        header('Access-Control-Allow-Origin: http://127.0.0.1:8848');
        return (request()->input());
    }
}
