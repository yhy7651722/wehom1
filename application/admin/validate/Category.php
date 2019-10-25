<?php
/**
 * Created by PhpStorm.
 * User: yhy
 * Date: 2019/10/11
 * Time: 10:45
 */

namespace app\admin\validate;




use think\Validate;

class Category extends Validate
{protected $rule = [
    'cname' => 'require',

    'id' => 'number',
    'value'=>'require',
    'filed'=>'filed'

];
//    protected  $message=[
//
//    ];
    protected $scene = [
        'insert'=>['cnmae'],
        'del'=>['id'],
        'update'=>['id','value','filed']
    ];

}