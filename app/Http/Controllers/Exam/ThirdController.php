<?php

namespace App\Http\Controllers\Exam;
use App\Http\Controllers\Controller;
use App\Model\Exam\UserModel;
use App\User;
use Illuminate\Support\Facades\Redis;

class ThirdController extends Controller
{
    //注册信息
    public function register()
    {
        $response = file_get_contents('php://input');

        //解密
        $k = openssl_get_publickey('file://'.storage_path('app/keys/public.pem'));
        openssl_public_decrypt($response,$json_info,$k);
        $userInfo = json_decode($json_info);

        //注册
        $data = [
            'email' => $userInfo->email,
            'user_name' => $userInfo->user_name,
            'password' => $userInfo->password,
        ];
        $e = UserModel::where(['email'=>$userInfo->email])->get()->toArray();
        if($e){
            return json_encode([
                'error' => 20001,
                'errmsg' => '邮箱已存在'
            ]);
        }
        $id = UserModel::insertGetId($data);
        if($id){
            return json_encode([
                'error' => 0,
                'errmsg' => '注册成功',
            ]);
        }else{
            return json_encode([
                'error' => 20002,
                'errmsg' => '注册失败'
            ]);
        }
    }

    //redis
    public function redis()
    {
        $k = 'aaaaa';
        $v = '12321';
        Redis::set($k,$v);
        echo Redis::get($k);
    }

}
