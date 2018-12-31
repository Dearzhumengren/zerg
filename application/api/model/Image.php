<?php

namespace app\api\model;

class Image extends BaseModel
{
    //
    protected $hidden = ['from','id','delete_time','update_time'];

    /**读取器的使用
       get获取,Url数据表字段,Attr值，data是所有字段
     */

    public function getUrlAttr($value,$data)
    {
        return $this->prefixImgUrl($value,$data);
    }


}
