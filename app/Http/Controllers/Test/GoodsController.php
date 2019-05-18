<?php

namespace App\Http\Controllers\Test;
use App\Http\Controllers\Controller;
use App\Model\Goods\GoodsModel;

class GoodsController extends Controller
{
    //商品列表
    public function goodsList()
    {
        $goods = GoodsModel::get();
        return json_encode($goods);
    }
    //商品详情
    public function goodsDetail()
    {
        $info = GoodsModel::where(['gid'=>$_POST])->first();
        return json_encode($info);
    }
}
