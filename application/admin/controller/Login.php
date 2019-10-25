<?php
/**
 * Created by PhpStorm.
 * User: yhy
 * Date: 2019/10/9
 * Time: 9:44
 */

namespace app\admin\controller;


use think\Db;
use think\Request;
use think\Session;

class Login
{

    public function index()
    {


        return view();

    }

    public function check()
    {

        $data = input('post.');
        if(!captcha_check($data['code'])){
            return json(['code' => 404, 'msg' => "登陆失败"]);
        }
        $username = $data['username'];
//        $password = md5(crypt($data['password'], md5('wehome')));
        $password = md5($data['password']);
        $res = Db::table('manage')->where(['username' => $username, 'password' => $password])->find();
        if ($res) {
            Session::set('user',$res);
            return json(['code' => 200, 'msg' => "登陆成功"]);
        } else {
            return json(['code' => 404, 'msg' => "登陆失败"]);
        }
    }


}