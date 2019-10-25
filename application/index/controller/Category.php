<?php
/**
 * Created by PhpStorm.
 * User: yhy
 * Date: 2019/10/8
 * Time: 17:57
 */

namespace app\index\controller;


use think\Db;

class Category extends Base
{
    public function index()
    {
        $cid = $this->request->get('cid');
        $current = Db::table('nav')->where('id', $cid)->find();

        $tpl = $current['ntpl'];
        $this->assign('title', $current['nname']);


        $navdata2 = Db::table("category")->select();

        $navdata1 = [["id" => '0', "cname" => "全部", 'cid' => '-1']];
        $navdata = array_merge($navdata1, $navdata2);
        $data = Db::table("goods")->select();
        $count = count($navdata);
        for ($i = 0; $i < $count; $i++) {
            if ($i == 0) {
                $datas[$i] = $data;
                continue;
            }
            $key0 = $navdata[$i];
            $id = $key0['id'];
            $va = array_filter($data, function ($v) use ($id) {
                return $v['cid'] == $id;
            });
            $datas[$i] = $va;
        }
        $this->assign('datas', $datas);
        $this->assign('navdata', $navdata);


        $news = Db::table("new")->select();
        $this->assign('news', $news);

        switch ($tpl) {

            case 'about';

                break;


        }

        $this->assign('cid', $cid);
        $this->assign('current', $current);

        return $this->fetch($tpl);

    }

    public function insert()
    {
        //插入逻辑
        //验证请求的方式 参数
        $data = input('post.');
        $method = $this->request->method();
        if ($method != 'POST') {
            return json(['code' => 404, 'msg' => "插入失败"]);
        }

//        $validata=validate('Category');
//        if(! $validata->scene('insert')->check($data)){
//            return json(['code'=>404,'msg'=>$validata->getError()]);
//        };


        $result = Db::table('sub')->insert($data);
        if ($result > 0) {
            return json(['code' => 200, 'msg' => "插入成功"]);
        } else {
            return json(['code' => 404, 'msg' => "插入失败"]);
        }

    }

    public function product()
    {


        $id = $_GET['gid'];
        $oo = Db::table('goods')->where('gid', $id)->find();
        $this->assign('oo', $oo);

        $this->assign('title', '产品详情');
        $this->assign('cid', 73);

        $sub = explode(',', $oo['banner']);
        $this->assign('sub', $sub);


        return view();
    }
       public function news1(){
           $id = $_GET['id'];
           $oo = Db::table('new')->where('id', $id)->find();
           $this->assign('oo', $oo);
           $this->assign('title', '新闻详情');
           $this->assign('cid', 16);
           // 上一篇开始
           $id=$_GET['id'];
           $front=Db::table('new')->where("id<".$id)->order('id asc')->limit('1')->find();
           $this->assign('front',$front);
           $prevstr = "";
           if ($front){
               $prevstr = "<a href='/wehome1/public/index.php/index/category/news1?id={$front['id']}'> {$front['nname']}";
           }else{
               $prevstr = "<a>没有了</a>";
           }
//        下一篇开始
           $fron=Db::table('new')->where("id>".$id)->order('id asc')->limit('1')->find();
           $this->assign('front',$fron);
           
           $netxet = "";
           if ($fron){
               $netxet = "<a href='/wehome1/public/index.php/index/category/news1?id={$fron['id']}'> {$fron['nname']}";
           }else{
               $netxet = "<a>没有了</a>";
           }
           $this->assign('netxet',$netxet);
           $this->assign('prevstr',$prevstr);
        return view();
}

}