<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/31
 * Time: 12:42
 */
namespace app\api\service;

use app\lib\exception\TokenException;
use app\lib\exception\WeChatException;
use think\Exception;
use app\api\model\User;

class UserToken extends Token
{
    protected $code;
    protected $wxAppID;
    protected $wxAppSecret;
    protected $wxLoginUrl;

    /**
     * UserToken constructor.
     * @param $code
     */
    function __construct($code)
    {
        $this->code = $code;
        $this->wxAppID = config('wx.app_id');
        $this->wxAppSecret = config('wx.app_secret');
        $this->wxLoginUrl = sprintf(config('wx.login_url'),
            $this->wxAppID,$this->wxAppSecret,$this->code);

    }

    /**
     * @throws Exception
     * @throws WeChatException
     */
    public function get()
    {
        $result = curl_get($this->wxLoginUrl);

        $wxResult = json_decode($result,true);
        if (empty($wxResult)){
            throw new Exception('获取session_key及openID时异常，微信内部错误');
        }
        else{
            $loginFail = array_key_exists('errorcode',$wxResult);
            if($loginFail){
                $this->processLoginError($wxResult);
            }else{
                return  $this->grantToken($wxResult);
            }
        }

    }

    /**
     * @param $wxResult
     * @return string
     * @throws TokenException
     */
    private function grantToken($wxResult){
        //拿到openid
        //数据库里看一下，这个openid是不是已经存在
        //如果存在，则不处理，如果不存在那么新增一条user记录
        //生成令牌，准备缓存数据，写入缓存
        //把令牌返回到客户端去
        //key:令牌
        //value：wxResult,uid,scope
        $openid = $wxResult['openid'];
        $user = User::getByOpenID($openid);
        if ($user){
            $uid = $user->id;
        }
        else{
            $uid = $this->newUser($openid);
        }
        $cachedValue = $this->prepareCachedValue($wxResult,$uid);
        $token = $this->saveToCache($cachedValue);
        return $token;

    }

    /**
     * @param $cachedValue
     * @return string
     * @throws TokenException
     */
    private function saveToCache($cachedValue){
        $key = self::generateToken();
        $value = json_encode($cachedValue);
        $expire_in = config('setting.token_expire_in');

        $request = cache($key,$value,$expire_in);
        if (!$request){
            throw new TokenException([
                'msg'=>'服务器缓存异常',
                'errorCode'=>10005
            ]);
        }

        return $key;
    }


    /**
     * @param $wxResult
     * @param $uid
     * @return mixed
     */
    private function prepareCachedValue($wxResult,$uid){
        $cachedValue = $wxResult;
        $cachedValue['uid'] = $uid;
        $cachedValue['scope'] = 16;
        return $cachedValue;
    }

    private function newUser($openid){
        $user = User::create(['openid'=>$openid]);
        return $user->id;
    }


    /**
     * @param $wxResult
     * @throws WeChatException
     */
    private function processLoginError($wxResult)
    {
        throw new WeChatException([
            'msg'=>$wxResult['errmsg'],
            'errorCode'=>$wxResult['errcode'],
        ]);


    }

}