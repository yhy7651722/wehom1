<?php
//namespace app\index\controller;
//
//class Index
//{
//    public function index()
//    {
//        return 'Hello,World！';
//    }
//    public function index1()
//    {
//        return 'index模块-index控制器-index1方法';
//    }
//    public function index2()
//    {
//        return 'index模块-index控制器-index2方法';
//    }
//}
namespace app\index\controller;
use think\Controller;
use think\Db;
class Index extends Base
{
    public function index()
    {
        $this->assign('cid',0);
        $this->assign('title','首页');
        return $this->fetch();
    }
}
