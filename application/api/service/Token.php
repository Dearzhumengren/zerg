<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/31
 * Time: 14:38
 */

namespace app\api\service;


use app\lib\exception\TokenException;
use think\Cache;
use think\Exception;
use think\Request;

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

    public static function getCurrentTokenVar($key)
    {
        $token = Request::instance()->header('token');
        $vars = Cache::get($token);
        if (!$vars){
            throw new TokenException();
        }
        else{
            if (!is_array($vars)){
                $vars = json_decode($vars,true);
            }
            if (array_key_exists($key,$vars)){
                return $vars[$key];
            }
            else{
                throw new Exception('尝试获取的Token变量并不存在');
            }

        }

    }


    public static function getCurrentUid()
    {
        //token
        $uid = self::getCurrentTokenVar('uid');
        return $uid;
    }
}