<?php

namespace app\shop\controller;

use think\Controller;
use app\shop\model\ShopMod;
use think\Request;

class Shop extends Controller
{
    public function addShop()
    {
        if (isset($_SERVER["HTTP_REFERER"])) {
            $url       = $_SERVER["HTTP_REFERER"];   //获取完整的来路URL
            $str   = str_replace("http://", "", $url);  //去掉http://
            $strdomain = explode("/", $str);               // 以“/”分开成数组
            $domain    = $strdomain[0];              //取第一个“/”以前的字符
            header('Access-Control-Allow-Methods: POST,GET,PUT,DELETE,OPTIONS');
            header("Access-Control-Allow-Credentials: true");
            header("Access-Control-Allow-Origin: *");
            header('Access-Control-Allow-Headers: token,accept,content-type,X-Requested-With');
            
        } else {
            header('Access-Control-Allow-Methods: POST,GET,PUT,DELETE,OPTIONS');
            header("Access-Control-Allow-Credentials: true");
            header("Access-Control-Allow-Origin: *");
            header('Access-Control-Allow-Headers: token,accept,content-type,X-Requested-With');
            
        }
        $add = new ShopMod();
        if(Request::instance()->isPost()) {
            $post['shop_name'] = input('post.shop_name');
            $post['shop_tag'] = input('post.shop_tag');
            $post['shop_location'] = input('post.shop_location');
            $post['shop_owner'] = input('post.shop_owner');
            $res = $add->add($post);
            return json($res);
        }else{
            return json(['code'=>2,'msg'=>'非法调用']);
        }

    }

    public function delShop()
    {
        if (isset($_SERVER["HTTP_REFERER"])) {
            $url       = $_SERVER["HTTP_REFERER"];   //获取完整的来路URL
            $str   = str_replace("http://", "", $url);  //去掉http://
            $strdomain = explode("/", $str);               // 以“/”分开成数组
            $domain    = $strdomain[0];              //取第一个“/”以前的字符
            header('Access-Control-Allow-Methods: POST,GET,PUT,DELETE,OPTIONS');
            header("Access-Control-Allow-Credentials: true");
            header("Access-Control-Allow-Origin: *");
            header('Access-Control-Allow-Headers: token,accept,content-type,X-Requested-With');
            
            
        } else {
            header('Access-Control-Allow-Methods: POST,GET,PUT,DELETE,OPTIONS');
            header("Access-Control-Allow-Credentials: true");
            header("Access-Control-Allow-Origin: *");
            header('Access-Control-Allow-Headers: token,accept,content-type,X-Requested-With');
            
            
        }
        $del = new ShopMod();
        if(Request::instance()->isPost()) {
            $post['shop_name'] = input('post.shop_name');
            $post['shop_owner'] = input('post.shop_owner');
            $res = $del->del($post);
            return json($res);
        }else{
            return json(['code'=>2,'msg'=>'非法调用']);
        }

    }

    public function editShop()
    {
        if (isset($_SERVER["HTTP_REFERER"])) {
            $url       = $_SERVER["HTTP_REFERER"];   //获取完整的来路URL
            $str   = str_replace("http://", "", $url);  //去掉http://
            $strdomain = explode("/", $str);               // 以“/”分开成数组
            $domain    = $strdomain[0];              //取第一个“/”以前的字符
            header('Access-Control-Allow-Methods: POST,GET,PUT,DELETE,OPTIONS');
            header("Access-Control-Allow-Credentials: true");
            header("Access-Control-Allow-Origin: *");
            header('Access-Control-Allow-Headers: token,accept,content-type,X-Requested-With');
            
            
        } else {
            header('Access-Control-Allow-Methods: POST,GET,PUT,DELETE,OPTIONS');
            header("Access-Control-Allow-Credentials: true");
            header("Access-Control-Allow-Origin: *");
            header('Access-Control-Allow-Headers: token,accept,content-type,X-Requested-With');
            
        }
        $edit = new ShopMod();
        if(Request::instance()->isPost()) {
            $post['shop_name'] = input('post.shop_name');
            $post['shop_tag'] = input('post.shop_tag');
            $post['shop_location'] = input('post.shop_location');
            $post['shop_owner'] = input('post.shop_owner');
            $post['shop_id'] = input('post.shop_id');
            $res = $edit->edit($post);
            return json($res);
        }else{
            return json(['code'=>2,'msg'=>'非法调用']);
        }

    }

    public function  showShop()
    {
        if (isset($_SERVER["HTTP_REFERER"])) {
            $url       = $_SERVER["HTTP_REFERER"];   //获取完整的来路URL
            $str   = str_replace("http://", "", $url);  //去掉http://
            $strdomain = explode("/", $str);               // 以“/”分开成数组
            $domain    = $strdomain[0];              //取第一个“/”以前的字符
            header('Access-Control-Allow-Methods: POST,GET,PUT,DELETE,OPTIONS');
            header("Access-Control-Allow-Credentials: true");
            header("Access-Control-Allow-Origin: *");
            header('Access-Control-Allow-Headers: token,accept,content-type,X-Requested-With');


        } else {
            header('Access-Control-Allow-Methods: POST,GET,PUT,DELETE,OPTIONS');
            header("Access-Control-Allow-Credentials: true");
            header("Access-Control-Allow-Origin: *");
            header('Access-Control-Allow-Headers: token,accept,content-type,X-Requested-With');

        }
        $show = new ShopMod();
        if(Request::instance()->isPost()) {
            $post['shop_id'] = input('post.shop_id');
            $res = $show->show($post);
            return json($res);
        }else{
            return json(['code'=>2,'msg'=>'非法调用']);
        }

    }


}