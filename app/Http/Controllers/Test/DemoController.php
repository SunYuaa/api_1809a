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
    public function reg()
    {
        var_dump($_POST);
        
    }
}
