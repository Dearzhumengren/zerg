<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/31
 * Time: 14:38
 */

namespace app\api\service;


class Token
{
    public static function generateToken(){
        //32个字符组成一组随机字符串
        $randChars = getRandChar(32);
        //用三组字符串，进行MD5加密
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        //salt盐；
        $salt = config('secure.token_salt');

        return md5($randChars.$timestamp.$salt);
    }
}