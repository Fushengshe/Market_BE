<?php
namespace app\shop\validate;

use think\Validate;

class Shop extends Validate
{
    protected $rule = [
        'shop_name'  =>  'require',
        'shop_location'=>'require',
        'shop_owner'=>'require'
    ];

    protected $message = [
        'shop_name.require' =>'商店名必须',
        'shop_location.require'=>'商店位置必须',
        'shop_owner.require'=>'用户名必须',
    ];
}