<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/22
 * Time: 12:32
 */
namespace app\api\validate;

use app\api\validate\BaseValidate;
class IDMustBePostiveInt extends BaseValidate
{
    protected $rule = [
        'id'=>'require|isPositiveInteger',

    ];
    protected $message = [
        'id'=>'id必须是正整数'
    ];

}