<?php

/**
 * Created by PhpStorm.
 * User: hequanli
 * Date: 17/6/21
 * Time: 下午7:55
 */

namespace app\admin\model;
use think\Model;
use think\Db;
use think\Session;
class AuthMod extends Model
{
    protected $table="user";
    public function login($data)
    {
        if(isset($data['mobile'])){
            $db = Db::name('user')
                ->where('mobile',$data['mobile'])
                ->select();
        }else
        {
            return json(['status'=>0,'msg'=>'请输入用户名']);
        }

        if($db)
        {
            $userInfo = $this->where('password',sha1(md5($data['password'].$db[0]['salt'])))->find();
            if($userInfo){
                $token=AuthMod::setToken($db[0]['id']);
                return json(['code'=>0,'data'=>['user'=>['userId'=>$db[0]['id'],'mobile'=>$data['mobile']]],'token'=>$token]);
            }
            else{
                return json(['code'=>0,'msg'=>'密码错误']);
            }
        }
        else{
            return json(['code'=>0,'msg'=>'用户不存在']);
        }
    }
    public static function setToken($id)
    {
        $str = md5(uniqid(md5(microtime(true)),true));
        $str = sha1($str);
        Db::table('user')
            ->where('id',$id)
            ->update(['token_exp'=>time()+86400,'token'=>$str]);
        $token = Db::name('user')
            ->where('id','=',$id)
            ->value('token');
        return $token;
    }

    public static function checkTokens($token)
    {
        $res = Db::table('user')
            ->where('token',$token)
            ->select();
        if ($res[0][$token]==$token){
            if (time() - $res[0]['token_exp'] > 0)
            {
                return 90003;  //token长时间未使用而过期，需重新登陆
            }
            else
            {
                Db::table('user')
                    ->where('token',$token)
                    ->update(['token_exp'=>time()+86400]);
                return 90001;  //token验证成功，time_out刷新成功，可以获取接口信息
            }
        }
        else
        {
            return 90002;  //token错误验证失败
        }


    }
    public function signup($username,$password,$mobile,$confirm){
        $admin  = \think\Db::name('user')->where('username','=',$username)->find();
        if($admin){
            return 5;
        }elseif($username == ''){
            return 4;
        }elseif($mobile == ''){
            return 2;
        }elseif(!ctype_digit($mobile)){
            return 22;
        }elseif($password == ''){
            return 3;
        }elseif(!($password === $confirm)){
            return 33;
        }else{
            return 1;
        }
    }

}