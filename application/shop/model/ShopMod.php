<?php
namespace app\shop\model;

use think\Db;
use think\Model;
use app\shop\validate\Shop;
class ShopMod extends Model
{
    public function add($data)
    {
        $validate=validate('Shop');
        if($validate->check($data)) {
            $msg=$this->upload();
            if($msg['statusCode']==1){
                return $msg;
            }else{
                $db=Db::table('user')
                    ->where('mobile','=',$data['shop_owner'])
                    ->select();
                $data['shop_ownerid']=$db[0]['id'];
                $data['shop_avatar']=$msg['path'];
                Db::table('shop')
                    ->insert($data);
                $msg['res']['code'] = 0;
                $msg['res']['msg'] ="创建成功";
                $msg['list']['store']=$data;
                return $msg;
            }
        }else{
            $err_msg = $validate->getError();
            $msg['code'] = 1;
            $msg['err_msg'] = $err_msg;

            return $msg;
        }
    }

    public function del($data)
    {
        $db=Db::table('shop')
            ->where('shop_name','=',$data['shop_name'])
            ->delete();
        if($db){
            $msg['code']=0;
            $msg['msg']="删除成功";
            return $msg;
        }else{
            $err_msg['code']=1;
            $err_msg['msg']="删除商店失败，请重试";
            return $err_msg;
        }
    }

    public function edit($data)
    {
        $validate=validate('Shop');
        if($validate->check($data)) {
            $msg=$this->upload();
            if($msg['statusCode']==1){
                return $msg;
            }else{
                $data['shop_avatar']=$msg['path'];
                Db::table('shop')
                    ->where('shop_id','=',$data['shop_id'])
                    ->update($data);
                $msg['res']['code'] = 0;
                $msg['res']['msg'] ="修改成功";
                $msg['list']['store']=$data;
                return $msg;
            }
        }else{
            $err_msg = $validate->getError();
            $msg['code'] = 1;
            $msg['err_msg'] = $err_msg;

            return $msg;
        }

    }

    public function show($data)
    {
        $db=Db::table('shop')
            ->where('shop_ownerid','=',$data['shop_ownerid'])
            ->select();
        if($db){
            $msg['res']['code']=0;
            $msg['res']['msg']="查询成功";
            $msg['list']['store']=$db;
            return $msg;
        }else{
            $err_msg['code']=1;
            $err_msg['msg']="操作失败，请重试";
            return $err_msg;
        }
    }

    public function upload(){
        $file = $_FILES;
        $path = ROOT_PATH . 'public' . DS . 'uploads/';
        $msg = $this->nFileUpload($file, $path);
        return $msg;

    }

    function nFileUpload($file, $path, $saveName = false)
    {
        if ($file['image']['error']) {
            $msg['statusCode'] = 1;
            $msg['message'] = '图片上传失败！请重试';
        } else {
            if ($saveName == false) {
                move_uploaded_file($file['image']['tmp_name'], $path . $file['image']['name']);
            } else {
                $arr = explode(".", $file['image']['name']);
                move_uploaded_file($file['image']['tmp_name'], $path . $saveName . "." . end($arr));
            }
            $msg['statusCode'] = 0;
            $msg['message'] = '图片上传成功！';
            $msg['path']=$path;
        }
        return $msg;

    }

}