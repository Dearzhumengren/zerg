<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/1
 * Time: 21:26
 */

namespace app\lib\exception;


class SuccessMessage extends BaseException
{
    public $code = 201;
    public $msg = 'ok';
    public $errorCode = 0;

}