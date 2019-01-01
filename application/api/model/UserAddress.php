<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/1
 * Time: 22:11
 */

namespace app\api\model;


class UserAddress extends BaseModel
{
    protected $hidden = [
        'id','delete_time','user_id'
    ];

}