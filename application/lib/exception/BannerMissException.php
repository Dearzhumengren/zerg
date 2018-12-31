<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/28
 * Time: 21:59
 */

namespace app\lib\exception;

class BannerMissException extends BaseException
{
    public $code = 404;
    public $msg = '请求的banner存在';
    public $errorCode = 40000;

}