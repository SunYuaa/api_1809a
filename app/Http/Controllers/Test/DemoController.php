<?php

namespace App\Http\Controllers\Test;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class DemoController extends Controller
{
    //
    public function demo()
    {
        header('Access-Control-Allow-Origin: http://client.1809a.com');
        echo time();
    }

    //注册
    public function reg(Request $request){
//        header('Access-Control-Allow-Origin: *');
//        header('Access-Control-Allow-Methods:OPTIONS,GET,POST');
//        header('Access-Control-Allow-Headers:x-requested-with');



        echo json_encode([
            'errcode' => 0,
            'errmsg' => 'success'
        ]);
    }

    //
    public function op()
    {
        return optional('xixi',1233132);
    }
}
