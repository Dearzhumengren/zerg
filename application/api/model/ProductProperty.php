<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/1
 * Time: 12:51
 */

namespace app\api\model;


class ProductProperty extends BaseModel
{
    protected $hidden = [
        'product_id','delete_time','id'
    ];

}