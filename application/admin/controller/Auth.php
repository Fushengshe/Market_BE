<?php

/**
 * Created by PhpStorm.
 * User: hequanli
 * Date: 17/6/21
 * Time: 下午7:49
 */
namespace app\admin\controller;
use think\Controller;
use think\Response;
use think\Request;
use app\admin\model\AuthMod;
class Auth extends Controller
{


    public function register()
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
        $loginup = new AuthMod();
        if(Request::instance()->isPost()){
            $post['username'] = input('post.username');
            $post['password'] = input('post.password');
            $post['confirm'] = input('post.confirm');
            $post['mobile'] = input('post.mobile');
            $res = $loginup->signup($post);
//            if($res == 1){
//                return json(['code'=>1,'msg'=>'验证成功']);
//            }else if($res == 0)
//                return json(['code'=>0,'msg'=>'验证失败']);
            if($res['code'] == 1){
                return json($res);
            }else if ($res['code'] == 0){
                return json($res);
            }else{

            }
        }else{
            return json(['code'=>2,'msg'=>'非法调用']);
        }



    }

    public function login()
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
            $my = new AuthMod();
            return $my->login(input('post.'));
        }
    }
    public function validateToken()
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


        if(Request::instance()->isGet()){
            $Auth = new AuthMod();
            $token = input('get.token');
            $res = $Auth -> checkTokens($token);
            if($res == 90001){
                return json(['code'=>0,'msg'=>'token正常','token'=>$token]);
            }else if($res == 90003){
                return json(['code'=>1,'msg'=>'token过期，请重新登录','token'=>$token]);
            }else if($res == 90002){
                return json(['code'=>2,'msg'=>'token错误，请重新登录','token'=>$token]);
            }

        }else{

        }
    }


}