<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/30
 * Time: 21:22
 */

namespace app\api\validate;


class Count extends BaseValidate
{
    protected $rule = [
        'count'=>'isPositiveInteger|between:1,15',
    ];



}