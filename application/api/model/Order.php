<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/5
 * Time: 14:05
 */

namespace app\api\model;


class Order extends BaseModel
{
    protected $hidden = [
        'user_id','delete_time','update_time'
    ];
    protected $autoWriteTimestamp = true;

    public function getSnapItemsAttr($value)
    {
        if (empty($value)){
            return null;
        }

        return json_decode($value);

    }

    public function getSnapAddressAttr()
    {
        if (empty($value)){
            return null;
        }

        return json_decode($value);
    }

    public static function getSummaryByUser($uid,$page=1,$size)
    {
       $pagingData =  self::where('user_id','=',$uid)
            ->order('create_time','desc')
            ->paginate($size,true,['page'=>$page]);
        return $pagingData;

    }
}