<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/31
 * Time: 12:32
 */

namespace app\api\validate;


class TokenGet extends BaseValidate
{
    protected $rule = [
        'code' =>'require|isNotEmpty'
    ];

    protected $message = [
        'code'=> '没有code获取不了Token'
    ];

}