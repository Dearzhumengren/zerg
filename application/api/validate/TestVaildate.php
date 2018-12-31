<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/22
 * Time: 10:58
 */

namespace app\api\validate;

use think\Validate;

class TestVaildate extends Validate
{
    protected $rule = [
        'name'=>'require|max:10',
        'email'=>'email'
    ];

}