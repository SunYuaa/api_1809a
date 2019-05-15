<?php

namespace App\Http\Controllers\Test;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use App\Model\Exam\UserModel;

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

//        $name = $_POST['name'];
//        $pwd = $_POST['pwd'];
//        $email = $_POST['email'];

        $name = $request->input('name');
        $pwd = $request->input('pwd');
        $email = $request->input('email');
        $e = UserModel::where(['email'=>$email])->first();
        if($e){
            $response = [
                'errcode' => 2001,
                'errmsg' => '该邮箱已存在'
            ];
        }else{
            $data = [
                'user_name' => $name,
                'password' => $pwd,
                'email' => $email
            ];
            $id = UserModel::insertGetId($data);
            if($id){
                $response = [
                    'errcode' => 0,
                    'errmsg' => 'success'
                ];
            }else{
                $response = [
                    'errcode' => 1001,
                    'errmsg' => 'fail'
                ];
            }
        }
        return json_encode($response);
    }


}
