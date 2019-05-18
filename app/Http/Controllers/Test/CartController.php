<?php

namespace App\Http\Controllers\Test;
use App\Http\Controllers\Controller;
use App\Model\Cart\CartModel;
use App\Model\Goods\GoodsModel;

class CartController extends Controller
{
    //加入购物车
    public function cartAdd()
    {
        $uid = $_POST['uid'];
        $gid = $_POST['id'];
        $g = CartModel::where(['uid'=>$uid,'gid'=>$gid])->first();
        if($g){
            //累加
            $res = CartModel::where(['uid'=>$uid,'gid'=>$gid])->update(['buy_num'=>$g['buy_num']+1,'create_time'=>time()]);
        }else {
            //添加
            $data = [
                'gid' => $gid,
                'uid' => $uid,
                'create_time' => time()
            ];
            $res = CartModel::insertGetId($data);
        }
        if ($res) {
            $response = [
                'errcode' => 0,
                'errmsg' => '加入购物车成功'
            ];
        } else {
            $response = [
                'errcode' => 2004,
                'errmsg' => '加入购物车失败'
            ];
        }
        return json_encode($response);


    }
    //购物车列表
    public function cartList()
    {
        $info = GoodsModel::select('buy_num','goods.*')
            ->join('cart','goods.gid','=','cart.gid')
            ->get();
        return json_encode($info);
    }

}
