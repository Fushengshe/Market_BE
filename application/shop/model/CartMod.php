<?php

namespace app\shop\model;

use think\Db;
use think\Model;

class CartMod extends Model
{
    public function add($data)
    {
        if(isset($data['user_name'])&&isset($data['goods_ids'])){
            $db=Db::table('user')
                ->where('username','=',$data['username'])
                ->select();
            $data['uid']=$db[0]['id'];
            $data['is_del']=0;
            $row=Db::table('cart')
                ->insert($data);
            if($row)
            {
                $msg['code'] = 0;
                $msg['msg'] = "收藏成功";
                return $msg;
            }else{
                $err_msg['code']=1;
                $err_msg['msg']='操作失败，请重试';
                return $err_msg;
            }
        }else{
            $err_msg['code']=1;
            $err_msg['msg']='操作失败，请重试';
            return $err_msg;
        }
    }

    public function del($data)
    {
        if(isset($data['user_name'])&&isset($data['goods_ids'])){
            $row=Db::table('cart')
                ->where('')
                ->update(['is_del'=>1]);
            if($row)
            {
                $msg['code'] = 0;
                $msg['msg'] = "删除成功";
                return $msg;
            }else{
                $err_msg['code']=1;
                $err_msg['msg']='操作失败，请重试';
                return $err_msg;
            }
        }else{
            $err_msg['code']=1;
            $err_msg['msg']='操作失败，请重试';
            return $err_msg;
        }
    }

    public function show($data)
    {
        if(isset($data['mobile']))
        {
            $msg['code'] = 0;
            $db = Db::table('user')
                ->where('mobile','=',$data['mobile'])
                ->select();
            $cart = Db::table('cart')
                ->where('uid','=',$db[0]['id'])
                ->distinct(true)
                ->order('created_at','desc')
                ->field('shop_id')
                ->select();
            if($cart){
                for($i=0;$i<count($cart,0);$i++)
                {
                    $shop = Db::table('shop')
                        ->where('shop_id','=',$cart[$i]['shop_id'])
                        ->select();
                    $goodsList[$i]['storeName'] = $shop[0]['shop_name'];
                    $goodIds = Db::table('cart')
                        ->where('shop_id','=',$cart[$i]['shop_id'])
                        ->where('uid','=',$db[0]['id'])
                        ->select();
                    $totalMoney = 0;
                    for($j=0;$j<count($goodIds,0);$j++)
                    {
                        $goods = Db::table('goods')
                             ->where('goods_id','=',$goodIds[$j]['goods_id'])
                            ->select();
                        $arr = explode(',',$goods[0]['parts']);
                        $product[$j]['productId'] = $goods[0]['goods_id'];
                        $product[$j]['productName'] = $goods[0]['goods_name'];
                        $product[$j]['productPrice'] = $goods[0]['goods_price'];
                        $product[$j]['productQuantity'] = 1;//购物量未知，设默认值为一
                        $product[$j]['productImage'] = $goods[0]['goods_img'];
                        //parts未定
                        $totalMoney += $product[$j]['productPrice'] * $product[$j]['productQuantity'];
                        $goodsList[$i]['products'] = $product;
                    }
                    $goodsList[$i]['totalMoney'] = $totalMoney;
                }
                $msg['code'] = 0;
                $msg['goodsList'] = $goodsList;
                return $msg;
            }else{
                $err_msg['code']=2;
                $err_msg['msg']='购物清单为空';
                return $err_msg;
            }

        }else{
            $err_msg['code']=1;
            $err_msg['msg']='操作失败，请重试';
            return $err_msg;
        }
    }
}