<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/test/reqSec','Test\TestController@reqSec');
$router->post('/test/unSec','Test\TestController@unSec');
$router->post('/test/reqSign','Test\TestController@reqSign');
$router->get('/test/demo','Test\DemoController@demo');

$router->post('/login/register','Exam\ThirdController@register');
$router->get('/login/redis','Exam\ThirdController@redis');

//demo APP
$router->post('/demo/reg/','Test\DemoController@reg'); //注册
$router->post('/demo/login/','Test\DemoController@login'); //登录
$router->get('/demo/center','Test\DemoController@center'); //个人中心

$router->get('/demo/goods/goodsList/','Test\GoodsController@goodsList'); //商品列表
$router->post('/demo/goods/goodsDetail/','Test\GoodsController@goodsDetail'); //商品详情

$router->post('/demo/cart/cartAdd/','Test\CartController@cartAdd'); //加入购物车
$router->get('/demo/cart/cartList/','Test\CartController@cartList'); //购物车

$router->get('/demo/order/order/','Test\OrderController@order'); //
$router->post('/demo/order/orderDo/','Test\OrderController@orderDo'); //