<?php
namespace app\admin\controller;
use think\Controller;
use think\Response;
use think\Request;
use app\admin\model\ForgetMod;

class Forget extends Controller
{
    public function sendCode()
    {
        if (isset($_SERVER["HTTP_REFERER"])) {
            $url       = $_SERVER["HTTP_REFERER"];   //获取完整的来路URL
            $str   = str_replace("http://", "", $url);  //去掉http://
            $strdomain = explode("/", $str);               // 以“/”分开成数组
            $domain    = $strdomain[0];              //取第一个“/”以前的字符
            header('Access-Control-Allow-Methods: POST,GET,PUT,DELETE,OPTIONS');
            header("Access-Control-Allow-Credentials: true");
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


        } else {
            header('Access-Control-Allow-Methods: POST,GET,PUT,DELETE,OPTIONS');
            header("Access-Control-Allow-Credentials: true");
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

        }

        $create=new ForgetMod();
        if(Request::instance()->isPost())
        {
            $data['mobile']=input('post.mobile');
            $res=$create->createCode($data);
            return json($res);
        }else{
            return json(['code'=>2,'msg'=>'非法调用']);
        }

    }

    public function resetPassword()
    {
        if (isset($_SERVER["HTTP_REFERER"])) {
            $url       = $_SERVER["HTTP_REFERER"];   //获取完整的来路URL
            $str   = str_replace("http://", "", $url);  //去掉http://
            $strdomain = explode("/", $str);               // 以“/”分开成数组
            $domain    = $strdomain[0];              //取第一个“/”以前的字符
            header('Access-Control-Allow-Methods: POST,GET,PUT,DELETE,OPTIONS');
            header("Access-Control-Allow-Credentials: true");
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


        } else {
            header('Access-Control-Allow-Methods: POST,GET,PUT,DELETE,OPTIONS');
            header("Access-Control-Allow-Credentials: true");
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

        }

        $set=new ForgetMod();
        if(Request::instance()->isPost())
        {
            $data['password'] = input('post.password');
            $data['confirm'] = input('post.confirm');
            $data['mobile'] = input('post.mobile');
            $data['verify'] = input('post.verify');
            $res=$set->checkCode($data);
            return json($res);
        }else{
            return json(['code'=>2,'msg'=>'非法调用']);
        }
    }
}