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
        $data = [
                'user_name' => $name,
                'password' => $pwd,
                'email' => $email
        ];
        $json_data = json_encode($data);

        //传输
//        $url = 'http://passport.1809a.com/demo/reg/';
        $url = 'http://passport.suyna.top/demo/reg/';
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$json_data);
        curl_setopt($ch,CURLOPT_HTTPHEADER,['Content-Type:text/plain']);
        curl_exec($ch);
        $code = curl_errno($ch);
        if($code > 0){
            echo $code;die;
        }
        curl_close($ch);
        return ;
    }
    //登录
    public function login(){
        $name = $_POST['name'];
        $pwd = $_POST['pwd'];

        $data = [
            'user_name' => $name,
            'password' => $pwd,
        ];
        $json_data = json_encode($data);

        //传输
//        $url = 'http://passport.1809a.com/demo/login/';
        $url = 'http://passport.suyna.top/demo/login/';
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$json_data);
        curl_setopt($ch,CURLOPT_HTTPHEADER,['Content-Type:text/plain']);
        curl_exec($ch);
        $code = curl_errno($ch);
        if($code>0){
            echo $code;die;
        }
        curl_close($ch);
        return ;
       
    }
    //个人中心
    public function center(){
        $uid = $_GET['uid'];
        $token = $_GET['token'];    

        //传输
        // $url = 'http://passport.1809a.com/demo/center?uid='.$uid.'&token='.$token;
        $url = 'http://passport.suyna.top/demo/center?uid='.$uid.'&token='.$token;

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_exec($ch);
        $code = curl_errno($ch);
        if($code>0){
            echo $code;die;
        }
        curl_close($ch);
        return ;

    }
}
