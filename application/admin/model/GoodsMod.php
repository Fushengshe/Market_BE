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
                'shop_id' => input('shop_id'),
                'cat_id' => input('cat_id'),
                'goods_name' => input('goods_name'),
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
                'shop_id' => input('shop_id'),
                'cat_id' => input('cat_id'),
                'goods_name' => input('goods_name'),
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
        if ($id = input('goods_id')) {
            if ($data = Db::table('goods')->where('goods_id', $id)->find()) {
                $code = array('code' => 0);
                $shop_name = Db::table('shop')->where('shop_id', $data['shop_id'])->find();
                $data2['goods_id'] = $data['goods_id'];
                $data2['shop_name'] = $shop_name['shop_name'];
                $data2['goods_name'] = $data['goods_name'];
                $data2['goods_detail'] = $data['goods_detail'];
                $data2['goods_rate'] = $data['goods_rate'];
                $data2['monthly_sales'] = $data['monthly_sales'];
                $data2['goods_purchases'] = $data['goods_purchases'];
                $data2['goods_price'] = $data['goods_price'];
                $data2['shop_desc'] = $data['shop_desc'];
                $data2['shop_rate'] = $data['shop_rate'];
                $data2['goods_address'] = $data['goods_address'];
                $data2['goods_distance'] = $data['goods_distance'];
                $msg= array_merge($code, $data2);
            } else {
                return json(['code' => 1, 'msg' => '查询数据失败,请检查商品id：' . $id . '是否存在，且稍后再试']);
            }
            return json($msg);
        } else {
            return json(['code' => 2, 'msg' => '请输入商品id']);
        }
    }
//    public function duoshow()
//    {
//        if ($ids = input('goods_id')) {
//            $id = explode(',', $ids);
//            for ($i = 0; $i < sizeof($id); $i++) {
//                if ($data = Db::table('goods')->where('goods_id', $id[$i])->find()) {
//                    $code = array('code' => 0);
//                    $shop_name = Db::table('shop')->where('shop_id', $data['shop_id'])->find();
//                    $data2['shop_name'] = $shop_name['shop_name'];
//                    $data2['goods_name'] = $data['goods_name'];
//                    $data2['goods_detail'] = $data['goods_detail'];
//                    $data2['goods_rate'] = $data['goods_rate'];
//                    $data2['monthly_sales'] = $data['monthly_sales'];
//                    $data2['goods_purchases'] = $data['goods_purchases'];
//                    $data2['goods_price'] = $data['goods_price'];
//                    $data2['shop_desc'] = $data['shop_desc'];
//                    $data2['shop_rate'] = $data['shop_rate'];
//                    $data2['goods_address'] = $data['goods_address'];
//                    $data2['goods_distance'] = $data['goods_distance'];
//                    $msg[$i] = array_merge($code, $data2);
//                } else {
//                    return json(['code' => 1, 'msg' => '查询数据失败,请检查商品id：' . $id[$i] . '是否存在，且稍后再试']);
//                }
//            }
//            return  json($msg) ;
//        } else {
//            return json(['code' => 2, 'msg' => '请输入商品id']);
//        }
//    }
    public function collect(){
        $id = input('id');
        $goods_id = input('goods_id');
        $user = Db::table('user')->where('id', $id)->find();
        $user['goods_collect'] = $user['goods_collect'].','.$goods_id;
        Db:;table('user')->where('id',$id)->update($user);
    }
}