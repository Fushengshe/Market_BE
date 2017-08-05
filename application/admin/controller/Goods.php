<?php
/**
 * Created by PhpStorm.
 * User: hasee
 * Date: 2017/7/19
 * Time: 10:01
 */

namespace app\admin\controller;
use think\Controller;
use app\admin\model\GoodsMod;

class Goods extends Controller
{
    public function add()
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
        $goods = new GoodsMod();
        return $goods->add();
    }

    public function edit()
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
        $goods = new GoodsMod();
        return $goods->edit();
    }

    public function del()
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
        $goods = new GoodsMod();
        return $goods->del();
    }

    public function show()
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
        $goods = new GoodsMod();
        return $goods->show();
    }
    public function collect(){
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
        $goods = new GoodsMod();
        return $goods->collect();
    }
}