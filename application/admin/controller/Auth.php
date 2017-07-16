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
            $url = $_SERVER["HTTP_REFERER"];   //获取完整的来路URL
            $str = str_replace("http://", "", $url);  //去掉http://
            $strdomain = explode("/", $str);               // 以“/”分开成数组
            $domain = $strdomain[0];              //取第一个“/”以前的字符
            header("Access-Control-Allow-Credentials: true");
            header("Access-Control-Allow-Origin: http://".$domain);
            header("Access-Control-Allow-Headers: content-type");
        } else {
            header("Access-Control-Allow-Credentials: true");
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Headers: content-type");
        }
        $loginup = new AuthMod();
        $data = Request::instance()->post();
        //$data_decoded = json_decode($data[0],true);
        //var_dump($data);

        $username = input('username');
        $password = input('password');
        $mobile = input('mobile');
        $confirm = input('confirm');
        $status = $loginup->signup($username,$password,$mobile,$confirm);
        if($status == 1){
            $intermediateSalt = uniqid(rand(), true);
            $salt = substr($intermediateSalt, 0, 4);
            $password = sha1(md5($password.$salt));

            $data = [
                'username' => $username,
                'password' => $password,
                'mobile' => $mobile,
                'usergroup' => 1,
                'created_at' => date("Y-m-d"),
                'updated_at' => date("Y-m-d"),
                'salt' => $salt,
            ];
            \think\Db::table('user')->insert($data);
            return json(['status' => '1','msg' => '注册成功！']);
        }elseif($status == 5){
            return json(['status' => '5','msg' => '注册失败，用户名已存在！']);
        }elseif($status == 4){
            return json(['status' => '4','msg' => '注册失败，用户名不能为空！']);
        }elseif($status ==2){
            return json(['status' => '2','msg' => '注册失败，手机号不能为空！']);
        }elseif($status ==22){
            return json(['status' => '22','msg' => '注册失败，手机号必须为数字！']);
        }elseif($status ==3){
            return json(['status' => '3','msg' => '注册失败，密码不能为空！']);
        }elseif($status ==33){
            return json(['status' => '33','msg' => '注册失败，密码不一致！！']);
        }


    }

    public function login()
    {
        if (isset($_SERVER["HTTP_REFERER"])) {
            $url = $_SERVER["HTTP_REFERER"];   //获取完整的来路URL
            $str = str_replace("http://", "", $url);  //去掉http://
            $strdomain = explode("/", $str);               // 以“/”分开成数组
            $domain = $strdomain[0];              //取第一个“/”以前的字符
            header("Access-Control-Allow-Credentials: true");
            header("Access-Control-Allow-Origin: http://".$domain);
            header("Access-Control-Allow-Headers: content-type");
        } else {
            header("Access-Control-Allow-Credentials: true");
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Headers: content-type");
        }
        if(Request::instance()->isPost()) {
            $my = new AuthMod();
            return $my->login(input('post.'));
        }
    }


}