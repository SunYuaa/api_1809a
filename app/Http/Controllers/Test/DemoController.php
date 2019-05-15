<?php

namespace App\Http\Controllers\Test;
use App\Http\Controllers\Controller;
use App\Model\Exam\UserModel;
use Illuminate\Support\Str;

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
//        header('Access-Control-Allow-Origin: *');
//        header('Access-Control-Allow-Methods:OPTIONS,GET,POST');
//        header('Access-Control-Allow-Headers:x-requested-with');

        $name = $_POST['name'];
        $pwd = $_POST['pwd'];
        $email = $_POST['email'];


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

    //登录
    public function login(){
        $name = $_POST['name'];
        $pwd = $_POST['pwd'];

        $res = UserModel::where(['user_name'=>$name,'password'=>$pwd])->first();
        if($res){
            $token = Str::random(6);
            $response = [
                'errcode' => 0,
                'errmsg' => 'success',
                'data' => [
                    'token' => $token,
                    'uid' => $res->id
                ]
            ];
        }else{
            $response = [
                'errcode' => 2002,
                'errmsg' => 'fail'
            ];
        }
        return json_encode($response);
    }
    //个人中心
    public function center(){
        $uid = $_GET['uid'];
        $token = $_GET['token'];

        $userInfo = UserModel::where(['id'=>$uid])->first()->toArray();
        if($userInfo){
            $response = [
                'errcode' => 0,
                'errmsg' => 'success',
                'data' => [
                    'userInfo' => $userInfo
                ]
            ];
        }else{
            $response = [
                'errcode' => 1002,
                'errmsg' => '用户不存在'
            ];
        }
        return json_encode($response);
    }
}
