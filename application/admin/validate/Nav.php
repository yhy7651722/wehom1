<?php
/**
 * Created by PhpStorm.
 * User: yhy
 * Date: 2019/10/10
 * Time: 16:15
 */

namespace app\admin\validate;


use think\Validate;

class Nav extends Validate
{
    protected $rule = [
        'nname' => 'require',
        'ename' => 'require',
        'nsort' => 'require',
        'ntpl' => 'require',
        'id' => 'number',
        'value'=>'require',
        'filed'=>'filed'

    ];
//    protected  $message=[
//
//    ];
    protected $scene = [
       'insert'=>['nnmae','ename','nsort','ntpl'],
        'del'=>['id'],
        'update'=>['id','value','filed']
    ];

}