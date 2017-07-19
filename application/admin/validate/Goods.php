<?php
/**
 * Created by PhpStorm.
 * User: hasee
 * Date: 2017/7/19
 * Time: 10:38
 */

namespace app\admin\validate;
use think\Validate;

class Goods extends Validate
{
    protected $rule = [
        'shop_id'  =>  'require',
        'cat_id' => 'require',
        'goods_name' => 'require',
        'goods_price' => 'require',
    ];

    protected $message = [
        'shop_id.require' =>'商家id必须',
        'cat_id.require'=>'商品类型必须',
        'goods_name.require' =>'商品名必须',
        'goods_price.require'=>'商品价格必须',

    ];
}