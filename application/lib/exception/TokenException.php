<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/31
 * Time: 14:59
 */

namespace app\lib\exception;


class TokenException extends BaseException
{
    public $code = 401;
    public $msg = 'Token已过期或无效Token';
    public $errorCode = 10001;

}