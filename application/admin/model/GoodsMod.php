<?php
/**
 * Created by PhpStorm.
 * User: hasee
 * Date: 2017/7/19
 * Time: 10:01
 */

namespace app\admin\model;
use think\Model;
use think\Db;

class GoodsMod extends Model
{
    public function add(){
        $data =[
            'goods_id' => input('goods_id'),
            'shop_id' => input('shop_id'),
            'cat_id' => input('cat_id'),
            'goods_name' => input('goods_name'),
            'goods_price' => input('goods_price'),
            'goods_click' => input('goods_click'),
            'goods_desc' => input('goods_desc'),
            'goods_img' => input('goods_img'),
            'is_on_sale' => input('is_on_sale'),
            'sales_volume' => input('sales_volume'),
            'goods_location' => input('goods_location'),
            'goods_weight' => input('goods_weight'),
            'goods_size' => input('goods_size'),
            'comment_num' => input('comment_num'),
            'good_comment_num' => input('good_comment_num'),
            'bad_comment_num' => input('bad_comment_num'),
            'middle_comment_num' => input('middle_comment_num'),
            'goods_distance' => input('goods_distance'),
        ];
        if(Db::table('goods')->where('goods_id',$data['goods_id'])->find()){
            return json(['msg' => '该商品id已存在！']);
        }elseif($data['goods_id'] == ''){
            $data =[
                'shop_id' => input('shop_id'),
                'cat_id' => input('cat_id'),
                'goods_name' => input('goods_name'),
                'goods_price' => input('goods_price'),
                'goods_click' => input('goods_click'),
                'goods_desc' => input('goods_desc'),
                'goods_img' => input('goods_img'),
                'is_on_sale' => input('is_on_sale'),
                'sales_volume' => input('sales_volume'),
                'goods_location' => input('goods_location'),
                'goods_weight' => input('goods_weight'),
                'goods_size' => input('goods_size'),
                'comment_num' => input('comment_num'),
                'good_comment_num' => input('good_comment_num'),
                'bad_comment_num' => input('bad_comment_num'),
                'middle_comment_num' => input('middle_comment_num'),
                'goods_distance' => input('goods_distance'),
            ];
            $validate = \think\Loader::validate('Goods');
            if (!$validate->check($data)) {
                return json(['msg'=>$this->error($validate->getError())]);
            }else{
                Db::table('goods')->insert($data);
                return json(['msg'=>'添加数据成功']);
            }
        }else{
            $validate = \think\Loader::validate('Goods');
            if (!$validate->check($data)) {
                return json(['msg'=>$this->error($validate->getError())]);
            }else{
                Db::table('goods')->insert($data);
                return json(['msg'=>'添加数据成功']);
            }
        }
    }
    public function edit(){
        $id = input('goods_id');
        $data =[
            'shop_id' => input('shop_id'),
            'cat_id' => input('cat_id'),
            'goods_name' => input('goods_name'),
            'goods_price' => input('goods_price'),
            'goods_click' => input('goods_click'),
            'goods_desc' => input('goods_desc'),
            'goods_img' => input('goods_img'),
            'is_on_sale' => input('is_on_sale'),
            'sales_volume' => input('sales_volume'),
            'goods_location' => input('goods_location'),
            'goods_weight' => input('goods_weight'),
            'goods_size' => input('goods_size'),
            'comment_num' => input('comment_num'),
            'good_comment_num' => input('good_comment_num'),
            'bad_comment_num' => input('bad_comment_num'),
            'middle_comment_num' => input('middle_comment_num'),
            'goods_distance' => input('goods_distance'),
        ];
        $validate = \think\Loader::validate('Goods');
        if (!$validate->check($data)) {
            return json(['msg'=>$this->error($validate->getError())]);
        }else{
            Db::table('goods')
                ->where('id', $id)
                ->update($data);
            return json(['msg'=>'修改数据成功']);
        }
    }
    public function del(){
        $id = input('goods_id');
        Db::table('think_user')->where('id',$id)->delete();
        return json(['msg'=>'删除成功']);
    }
    public function show(){
        $id = input('goods_id');
        return Db::table('goods')->where('info$.goods_id',$id)->find();
    }
}