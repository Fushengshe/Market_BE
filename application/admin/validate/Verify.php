<?php
namespace app\admin\validate;

use think\Validate;

class Verify extends Validate
{
    protected $rule = [
        'password' => 'require',
        'confirm'=>'require|confirm:password',
        'mobile'=>'require|max:18|min:11',
        'verify'=>'require'
    ];

    protected $message = [
        'password.require'=>'密码必须',
        'confirm.require'=>'重复密码必须',
        'confirm.confirm'=>'确认密码必须和密码一致',
        'mobile.require'=>'手机号必须填写',
        'mobile.max'=>'手机号最多十八位',
        'mobile.min'=>'手机号最短11位',
        'verify.confirm'=>'验证码必须'
    ];


}