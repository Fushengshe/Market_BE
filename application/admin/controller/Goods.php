<?php
/**
 * Created by PhpStorm.
 * User: hasee
 * Date: 2017/7/19
 * Time: 10:01
 */

namespace app\admin\controller;
use think\Controller;
use app\admin\model\GoodsMod;

class Goods extends Controller
{
    public function add()
    {
        $goods = new GoodsMod();
        $goods->add();
    }

    public function edit()
    {
        $goods = new GoodsMod();
        $goods->edit();
    }

    public function del()
    {
        $goods = new GoodsMod();
        $goods->del();
    }

    public function show()
    {
        $goods = new GoodsMod();
        $goods->show();
    }

}