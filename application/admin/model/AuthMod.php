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
use think\Validate;
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
                return json(['code'=>0,'data'=>['user'=>['userId'=>$db[0]['id'],'username'=>$db[0]['username'],'mobile'=>$data['mobile']]],'token'=>$token]);
            }
            else{
                return json(['code'=>1,'msg'=>'密码错误']);
            }
        }
        else{
            return json(['code'=>2,'msg'=>'用户不存在']);
        }
    }
    public function setToken($id)
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

    public function checkTokens($token)
    {
        $res = Db::table('user')
            ->where('token','=',$token)
            ->select();
        if(empty($res[0])){
            return 90002;
        }else if ($res[0]['token']==$token){
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
    public function signup($data){
        $validate = validate('Auth');
        if($validate->check($data)){
            //数据验证通过，进行查重。用户名以及电话
            $is_username = \think\Db::name('user')
                ->where('username','=',$data['username'])
                ->find();
            $is_mobile = \think\Db::name('user')
                ->where('mobile','=',$data['mobile'])
                ->find();
            if($is_username){
                $err_msg['code'] = 1;
                $err_msg['msg'] = '用户名已经存在';
                return $err_msg;
            }else if($is_mobile){
                $err_msg['code'] = 1;
                $err_msg['msg'] = '电话号码已经注册';
                return $err_msg;
            }else{
                $user['username'] = $data['username'];
                $user['salt'] = rand(1000,9999);
                $user['password'] = sha1(md5($data['password'].$user['salt']));
                $user['mobile'] = $data['mobile'];
                $user['created_at'] = date("Y:m:d",time());
                $user['updated_at'] = date("Y:m:d",time());
                $user['usergroup'] = 1;
                //insert
                $res = Db::table('user')
                    ->insert($user);
                if($res){
                    $msg['code']=0;
                    $msg['msg'] = "注册成功";
                    return $msg;
                }else{
                    $msg['code']=1;
                    $msg['msg'] = "注册失败，请稍后重试";
                    return $msg;
                }
            }
        }else{
            $err_msg = $validate->getError();
            $return['code'] = 1;
            $return['err_msg'] = $err_msg;
            return $return;
        }
    }

}