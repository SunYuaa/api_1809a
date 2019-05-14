<?php

namespace App\Http\Controllers\Test;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    //对称加密
    public function reqSec()
    {
        $str = file_get_contents('php://input');
        var_dump($str);

        //解密
        $method = 'AES-256-CBC';
        $key = 'abcd';
        $options = OPENSSL_RAW_DATA;
        $iv = 'aabbccddeeffgghh';
        $str = openssl_decrypt(base64_decode($str),$method,$key,$options,$iv);
        echo $str;
    }

    //非对称加密
    public function unSec()
    {
        $response = file_get_contents('php://input');
        //解密
        $pk = openssl_get_publickey('file://'.storage_path('app/keys/public.pem'));
        openssl_public_decrypt($response,$str,$pk);
        echo $str;
    }

    //非对称签名加密
    public function reqSign()
    {
        $response = file_get_contents('php://input');
        echo $response;echo '<hr>';
        $res_sign = $_GET['sign'];

        //验签
        $pk = openssl_get_publickey('file://'.storage_path('app/keys/public.pem'));
        $r = openssl_verify($response,base64_decode($res_sign),$pk);
        var_dump($r);
    }
}
