<?php

namespace App\Http\Controllers\Test;
use App\Http\Controllers\Controller;
use App\Model\Cart\CartModel;
use App\Model\Goods\GoodsModel;
use App\Model\Order\OrderModel;
use App\Model\Order\OrderDetailModel;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    //订单页面
    public function order()
    {
        $info = GoodsModel::select('buy_num','goods.*')
            ->join('cart','goods.gid','=','cart.gid')
            ->get();
        return json_encode($info);
    }
    //加入订单
    public function orderDo()
    {
        $pay_type = $_POST['pay_type'];
        $uid = $_POST['uid'];
        $gid = substr($_POST['gid'],0,-1);

        //写入订单表
        $goodsInfo = GoodsModel::select('buy_num','goods.*')
            ->join('cart','goods.gid','=','cart.gid')
            ->get();
        $order_amout = 0;
        foreach($goodsInfo as $k=>$v){
            $order_amout += $v['buy_num']*$v['goods_price'];
        }
        $data = [
            'uid' => $uid,
            'order_sn' => '1809-'.Str::random(15),
            'order_amout' => $order_amout,
            'pay_type' => $pay_type,
            'add_time' => time()
        ];
        $id = OrderModel::insertGetId($data);
        //写入订单详情表
        foreach($goodsInfo as $k=>$v) {
            $o = [
                'oid' => $id,
                'uid' => $uid,
                'gid' => $v['gid'],
                'goods_name' => $v['goods_name'],
                'goods_price' => $v['goods_price']
            ];
            $res = OrderDetailModel::insert($o);
        }

        //修改购物车表
        // $gid = explode(',',$gid);
        // foreach($id as $k=>$v){
            $res3 = CartModel::where(['uid'=>$uid])->update(['update_time'=>time(),'is_detele'=>2]);
        // }
        
        //减少商品库存 商品表
        foreach($goodsInfo as $k=>$v){
            $goodsWhere = [
                'gid'=>$v['gid']
            ];
            $updateInfo = [
                'goods_store'=>$v['goods_store']-$v['buy_num']
            ];
            $res4 = GoodsModel::where($goodsWhere)->update($updateInfo);
        }
        // echo $id;echo '--';
        // echo $res;echo '--';
        // echo $res3;echo '--';
        // echo $res4;echo '--';
        // die;
        if($id && $res && $res3 && $res4){
            $response = [
                'errcode' => 0,
                'errmsg' => '加入订单成功'
            ];
        }else{
            $response = [
                'errcode' => 2005,
                'errmsg' => '加入订单失败'
            ];
        }
        return json_encode($response);

    }




}
