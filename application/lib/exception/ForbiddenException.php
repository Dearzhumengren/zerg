<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/3
 * Time: 21:06
 */

namespace app\lib\exception;


class ForbiddenException extends BaseException
{
    public $code = 403;
    public $msg  ='权限不够';
    public $errorCode = 10001;
}