<?php

namespace app\shop\controller;

use think\Controller;
use think\Request;
use app\shop\model\CartMod;

class Cart extends Controller
{
    public function ShowCart()
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

        if(Request::instance()->isPost()) {
            $add=new CartMod();
            $post['mobile'] = input('post.mobile');
            $res = $add->show($post);
            return json($res);
        }else{
            return json(['code'=>2,'msg'=>'非法调用']);
        }
    }

    public function DelCart()
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

        if(Request::instance()->isPost()) {
            $del=new CartMod();
            $post['mobile'] = input('post.mobile');
            $res = $del->del($post);
            return json($res);
        }else{
            return json(['code'=>2,'msg'=>'非法调用']);
        }
    }

}
