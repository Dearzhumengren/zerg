<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/22
 * Time: 10:19
 */
namespace app\api\controller\v1;

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
    public function getBanner($id)
    {
        (new IDMustBePostiveInt())->goCheck();

         $banner = BannerModel::getBannerByID($id);
       if (!$banner){
           throw new BannerMissException();
       }
       //config('setting.img_prefix');

        return json($banner);
    }
}
