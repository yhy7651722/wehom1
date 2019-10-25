<?php
/**
 * Created by PhpStorm.
 * User: yhy
 * Date: 2019/10/10
 * Time: 21:37
 */

namespace app\admin\controller;


use think\Controller;
use think\Db;

class Category extends Controller
{
    public function openinsert(){
        return view();
        //展示插入页面
    }
    public function index()
    {
        return view();
    }
    public  function  insert(){
        //插入逻辑
        //验证请求的方式 参数
        $data=input('post.');
        $method=$this->request->method();
        if($method !='POST'){
            return json(['code'=>404,'msg'=>"插入失败"]);
        }

        $validata=validate('Category');
        if(! $validata->scene('insert')->check($data)){
            return json(['code'=>404,'msg'=>$validata->getError()]);
        };



        $result= Db::table('category')->insert($data);
        if($result>0){
            return json(['code'=>200,'msg'=>"插入成功"]);
        }else{
            return json(['code'=>404,'msg'=>"插入失败"]);
        }

    }
    public function delete()
    {
        $method=$this->request->method();
        if($method !='POST'){
            return json(['code'=>404,'msg'=>"插入失败"]);
        }
        $data=input('post.');
        $validata=validate('Category');
        if(! $validata->scene('del')->check($data)){
            return json(['code'=>404,'msg'=>$validata->getError()]);
        };
        $id = input('post.id');

        $data = Db::table('category')->where('id', $id)->delete();
        if ($data > 0) {
            return json(['code' => 200, 'msg' => "插入成功"]);
        } else {
            return json(['code' => 404, 'msg' => "插入失败"]);
        }
    }

    public function update()
    {
        $method=$this->request->method();
        if($method !='POST'){
            return json(['code'=>404,'msg'=>"插入失败"]);
        }
        $data=input('post.');
        $validata=validate('Category');
        if(! $validata->scene('update')->check($data)){
            return json(['code'=>404,'msg'=>$validata->getError()]);
        };

        $id = input('post.id');

        $value = input('post.value');
        $field = input('post.field');

        $data = Db::table('category')->where('id', $id)->update([$field => $value]);
        if ($data > 0) {
            return json(['code' => 200, 'msg' => "修改成功"]);
        } else {
            return json(['code' => 404, 'msg' => "修改失败"]);
        }
    }

    public function query()
    {
        $data = Db::table('category')->select();
        $count=Db::table('category')->count();
        return json([
            'code' => 0,
            'msg' => 'success',
            'data' => $data,
            'count' => $count
        ]);
    }
}