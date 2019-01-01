<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/1
 * Time: 20:14
 */

namespace app\api\validate;


class AddressNew extends BaseValidate
{
    protected $rule = [
        'name'     => 'require|isNotEmpty',
        'mobile'   => 'require|isMobile',
        'province' => 'require|isNotEmpty',
        'city'     => 'require|isNotEmpty',
        'country'  => 'require|isNotEmpty',
        'detail'   => 'require|isNotEmpty',
    ];

}