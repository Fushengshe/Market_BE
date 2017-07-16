<?php

/**
 * Created by PhpStorm.
 * User: hequanli
 * Date: 17/7/16
 * Time: 上午11:34
 */
namespace app\admin\validate;

use think\Validate;

class Auth extends Validate
{
    protected $rule = [
        'username'  =>  'require',
        'password' => 'require',
        'confirm'=>'require|confirm:password',
        'mobile'=>'require|max:18|min:11',
    ];

    protected $message = [
        'username.require' =>'用户名必须',
        'password.require'=>'密码必须',
        'confirm.require'=>'重复密码必须',
        'mobile.require'=>'手机号必须填写',
        'mobile.max'=>'手机号最多十八位',
        'mobile.min'=>'手机号最短11位',
        'confirm.confirm'=>'确认密码必须和密码一致'
    ];



}