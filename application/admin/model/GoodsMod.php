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
            'shop_name' => input('shop_name'),
            'cat_id' => input('cat_id'),
            'goods_name' => input('goods_name'),
            'goods_desc' => input('goods_desc'),
            'goods_detail' => input('goods_detail'),
            'goods_rate' => input('goods_rate'),
            'monthly_sales' => input('monthly_sales'),
            'goods_purchases' => input('goods_purchases'),
            'goods_price' => input('goods_price'),
//            'shop_desc' => input('shop_desc'),
//            'shop_rate' => input('shop_rate'),
            'goods_address' => input('goods_address'),
            'goods_distance' => input('goods_distance'),
            'goods_img' => input('goods_img'),

            'goods_click' => input('goods_click'),
            'is_on_sale' => input('is_on_sale'),
            'sales_volume' => input('sales_volume'),
            'goods_weight' => input('goods_weight'),
            'goods_size' => input('goods_size'),

        ];
        if(Db::table('goods')->where('goods_id',$data['goods_id'])->find()){
            return json(['code'=>2,'msg' => '该商品id已存在！']);
        }elseif($data['goods_id'] == ''){
            $data =[
                'shop_name' => input('shop_name'),
                'cat_id' => input('cat_id'),
                'goods_name' => input('goods_name'),
                'goods_desc' => input('goods_desc'),
                'goods_detail' => input('goods_detail'),
                'goods_rate' => input('goods_rate'),
                'monthly_sales' => input('monthly_sales'),
                'goods_purchases' => input('goods_purchases'),
                'goods_price' => input('goods_price'),
//            'shop_desc' => input('shop_desc'),
//            'shop_rate' => input('shop_rate'),
                'goods_address' => input('goods_address'),
                'goods_distance' => input('goods_distance'),
                'goods_img' => input('goods_img'),

                'goods_click' => input('goods_click'),
                'is_on_sale' => input('is_on_sale'),
                'sales_volume' => input('sales_volume'),
                'goods_weight' => input('goods_weight'),
                'goods_size' => input('goods_size'),
            ];
            $validate = \think\Loader::validate('Goods');
            if (!$validate->check($data)) {
                return json(['code'=>1,'msg'=>$validate->getError()]);
            }else{
                if($files = request()->file('goods_img')){
                    foreach ($files as $file){
                        $info = $file->move(ROOT_PATH . 'public' . DS . '/static/uploads/');
                        if ($info) {
                            $data['goods_img'] = '/static/uploads/' . date('ymd') . '/' . $info->getFilename();
                        } else {
                            // 上传失败获取错误信息
                            return json(['code' => 1, 'msg' => $file->getError()]);
                        }
                    }
                }else{
                    return json(['code'=>3,'msg'=>'商品图不能为空']);
                }
                Db::table('goods')->insert($data);
                return json(['code'=>0,'msg'=>'添加数据成功']);
            }
        }else{
            $validate = \think\Loader::validate('Goods');
            if (!$validate->check($data)) {
                return json(['code'=>1,'msg'=>$validate->getError()]);
            }else{
                if($files = request()->file('goods_img')){
                    foreach ($files as $file){
                        $info = $file->move(ROOT_PATH . 'public' . DS . '/static/uploads/');
                        if ($info) {
                            $data['goods_img'] = '/static/uploads/' . date('ymd') . '/' . $info->getFilename();
                        } else {
                            // 上传失败获取错误信息
                            return json(['code' => 1, 'msg' => $file->getError()]);
                        }
                    }
                }else{
                    return json(['code'=>2,'msg'=>'商品图不能为空']);
                }
                Db::table('goods')->insert($data);
                return json(['code'=>0,'msg'=>'添加数据成功']);
            }
        }
    }

    public function edit(){
        if($id = input('goods_id')){
            $data =[
                'shop_name' => input('shop_name'),
                'cat_id' => input('cat_id'),
                'goods_name' => input('goods_name'),
                'goods_desc' => input('goods_desc'),
                'goods_detail' => input('goods_detail'),
                'goods_rate' => input('goods_rate'),
                'monthly_sales' => input('monthly_sales'),
                'goods_purchases' => input('goods_purchases'),
                'goods_price' => input('goods_price'),
//            'shop_desc' => input('shop_desc'),
//            'shop_rate' => input('shop_rate'),
                'goods_address' => input('goods_address'),
                'goods_distance' => input('goods_distance'),
                'goods_img' => input('goods_img'),

                'goods_click' => input('goods_click'),
                'is_on_sale' => input('is_on_sale'),
                'sales_volume' => input('sales_volume'),
                'goods_weight' => input('goods_weight'),
                'goods_size' => input('goods_size'),
            ];
            $validate = \think\Loader::validate('Goods');
            if (!$validate->check($data)) {
                return json(['code'=>1,'msg'=>$validate->getError()]);
            }else{
                if($files = request()->file('goods_img')){
                    foreach ($files as $file){
                        $info = $file->move(ROOT_PATH . 'public' . DS . '/static/uploads/');
                        if ($info) {
                            $data['goods_img'] = '/static/uploads/' . date('ymd') . '/' . $info->getFilename();
                        } else {
                            // 上传失败获取错误信息
                            return json(['code' => 1, 'msg' => $file->getError()]);
                        }
                    }
                }else{
                    return json(['code'=>3,'msg'=>'商品图不能为空']);
                }
                Db::table('goods')
                    ->where('goods_id', $id)
                    ->update($data);
                return json(['code'=>0,'msg'=>'修改数据成功']);
            }
        }else{
            return json(['code'=>2,'msg'=>'请输入要修改商品的id']);
        }
    }
    public function del(){
        $id = input('goods_id');
        if(Db::table('goods')->where('goods_id',$id)->delete()){
            return json(['code'=>0,'msg'=>'删除成功']);
        }else{
            return json(['code'=>1,'msg'=>'删除失败，请稍后再试']);
        }
    }

    public function show()
    {
        if ($ids = input('goods_id')) {
            $id = explode(',', $ids);
            for ($i = 0; $i < sizeof($id); $i++) {
                if ($data = Db::table('goods')->where('goods_id', $id[$i])->find()) {
                    $code = array('code' => 0);
                    $shop_name = Db::table('shop')->where('shop_id', $data['shop_name'])->find();
                    $data['shop_name'] = $shop_name['shop_name'];
                    $msg[$i] = array_merge($code, $data);
                } else {
                    return json(['code' => 1, 'msg' => '查询数据失败,请检查商品id：' . $id[$i] . '是否存在，且稍后再试']);
                }
            }
            return  json($msg) ;
        } else {
            return json(['code' => 2, 'msg' => '请输入商品id']);
        }
    }
}