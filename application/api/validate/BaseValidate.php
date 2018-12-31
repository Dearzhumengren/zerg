<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/27
 * Time: 22:08
 */

namespace app\api\validate;


use app\lib\exception\ParameterException;
use think\Exception;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{

    public function goCheck()
    {
        //获取    http传入的参数
        //对这些参数做校验
        $request = Request::instance();
        $params = $request->param();
        $result = $this->batch()->check($params);
        if (!$result){
            $e = new ParameterException([
                'msg'=>$this->error,
            ]);
//            $e->msg = $this->error;
//            $e->errorCode = 10002;
            throw $e;
        }
        else{
            return true;
        }
    }

    protected function isPositiveInteger($value,$rule='',$data='',$field='')
    {
        if(is_numeric($value)&& is_int($value + 0)&&($value + 0)>0){
            return true;
        }else{
            return false;
        }

    }

    public function isNotEmpty($value,$rule='',$data='',$field='')
    {
        if (empty($value)){
            return false;
        }
        else{
            return true;
        }

    }


}