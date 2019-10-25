<?php
/**
 * Created by PhpStorm.
 * User: yhy
 * Date: 2019/10/17
 * Time: 18:33
 */

namespace app\admin\controller;


use think\Db;

class Zxyy extends Base
{
    public function openinsert()
    {


        return $this->fetch();
    }

    public function insert()
    {
        $method = $this->request->method();
        if ($method != 'POST') {
            return json(['code' => 404, 'msg' => "插入失败"]);
        }
        $data = input('post.');
//       $validata=validate('Nav');
//       if(! $validata->scene('insert')->check($data)){
//           return json(['code'=>404,'msg'=>$validata->getError()]);
//       };



        $result = Db::table('sub')->insert($data);
        if ($result > 0) {
            return json(['code' => 200, 'msg' => "插入成功"]);
        } else {
            return json(['code' => 404, 'msg' => "插入失败"]);
        }

    }

    public function index()
    {
        $cate = Db::table('sub')->select();
        $this->assign('cate', $cate);
        return $this->fetch();
    }

    public function query()
    {
        $data = Db::table('sub')->select();
        $count=Db::table('sub')->count();
        return json([
            'code' => 0,
            'msg' => 'success',
            'data' => $data,
            'count' => $count
        ]);
    }

    public function delete()
    {
        $method = $this->request->method();
        if ($method != 'POST') {
            return json(['code' => 404, 'msg' => "插入失败"]);
        }
//        $data=input('post.');
//        $validata=validate('Category');
//        if(! $validata->scene('del')->check($data)){
//            return json(['code'=>404,'msg'=>$validata->getError()]);
//        };
        $id = input('post.id');

        $data = Db::table('sub')->where('id', $id)->delete();

        if ($data > 0) {
            return json(['code' => 200, 'msg' => "插入成功"]);
        } else {
            return json(['code' => 404, 'msg' => "插入失败"]);
        }
    }

}