<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/1
 * Time: 12:48
 */

namespace app\api\model;


class ProductImage extends BaseModel
{
    protected $hidden = [
        'img_id','delete_time','product_id'
    ];

    public function imgUrl()
    {
        return $this->belongsTo('Image','img_id','id');
    }
}