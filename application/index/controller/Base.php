<?php
/**
 * Created by PhpStorm.
 * User: yhy
 * Date: 2019/10/14
 * Time: 16:00
 */

namespace app\index\controller;


use think\Controller;
use think\Db;

class Base extends Controller
{
    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $nav=Db::table('nav')->order('nsort','asc')->select();
        $this->assign('nav',$nav);
    }

}