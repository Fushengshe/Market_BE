<?php
namespace app\admin\model;
use think\Model;
use think\Db;
use think\Validate;

class ForgetMod extends Model
{
    protected $table="user";
    public function createCode($data)
    {
        $validate=validate('Forget');
        if($validate->check($data)){
            $db=Db::table('user')
                ->where('mobile','=',$data['mobile'])
                ->select();
            if($db[0]['verify_exp']-time()>0){
                $msg['verify']=$db[0]['verify'];
                $msg['code']=0;
                $msg['msg']='已发送验证码，请注意查收';
                return $msg;
            }
            if ($db[0]['mobile']==$data['mobile']){
                $code=ForgetMod::sendCode();
                $res=Db::table('user')
                    ->where('mobile','=',$data['mobile'])
                    ->update($code);
                if($res){
                    $msg['verify']=$code['verify'];
                    $msg['code']=0;
                    $msg['msg']='已发送验证码，请注意查收';
                    return $msg;
                }
                else{
                    $err_msg['code']=1;
                    $err_msg['msg']='操作失败，请重试';
                    return $err_msg;
                }
            }else{
                $err_msg['code']=1;
                $err_msg['msg']="手机号不存在";
                return $err_msg;
            }
        }else {
            $err_msg = $validate->getError();
            $msg['code'] = 1;
            $msg['err_msg'] = $err_msg;
            return $msg;
        }


    }
    public function checkCode($data)
    {
        $validate=validate('Verify');
        if($validate->check($data))
        {
            $db=Db::table('user')
                ->where('mobile','=',$data['mobile'])
                ->select();
            if($db[0]['verify_exp']-time()>0){
                if($db[0]['verify']=$data['verify']){
                    $data['password']=sha1(md5($data['password'].$db[0]['salt']));
                    $res=Db::table('user')
                        ->where('mobile','=',$data['mobile'])
                        ->update(['password'=>$data['password']]);
                    if($res){
                        $msg['code']=0;
                        $msg['msg']='已重置密码，请重新登录';
                        return $msg;
                    }else{
                        $err_msg['code']=1;
                        $err_msg['msg']='操作失败，请重试';
                        return $err_msg;
                    }
                }else{
                    $err_msg['code']=1;
                    $err_msg['msg']="验证码错误";
                    return $err_msg;
                }
            }else{
                $err_msg['code']=1;
                $err_msg['msg']="验证码已失效";
                return $err_msg;
            }
        }else{
            $err_msg = $validate->getError();
            $msg['code'] = 1;
            $msg['err_msg'] = $err_msg;
            return $msg;
        }
    }
    public function sendCode()
    {
        return ['verify_exp' => (time()*2),'verify' => 123456];


    }
}