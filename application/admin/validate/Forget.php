<?php

/**
 * Created by PhpStorm.
 * User: hequanli
 * Date: 17/7/16
 * Time: 上午11:34
 */
namespace app\admin\validate;

use think\Validate;

class Forget extends Validate
{
    protected $rule = [
        'mobile'=>'require|max:18|min:11',
    ];

    protected $message = [
        'mobile.require'=>'手机号必须填写',
        'mobile.max'=>'手机号最多十八位',
        'mobile.min'=>'手机号最短11位',
    ];


}