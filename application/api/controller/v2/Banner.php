<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/22
 * Time: 10:19
 */
namespace app\api\controller\v2;

use app\api\model\Banner as BannerModel;
use app\api\validate\IDMustBePostiveInt;
use app\lib\exception\BannerMissException;

class Banner
{
    /*获取指定id的banner信息
     * @url /banner/：id
     *
     * @id banner的ID号
     *

     * */
    public function getBanner()
    {
       return 'This is v2 version';
    }
}
