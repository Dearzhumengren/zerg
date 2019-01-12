<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/3
 * Time: 22:30
 */
namespace app\api\controller;

use think\Controller;
use app\api\service\Token as TokenService;

class BaseController extends Controller
{
    protected function checkPrimaryScope()
    {
        TokenService::needPrimaryScope();
    }


    protected function checkExclusiveScope()
    {
        TokenService::needExclusiveScope();
    }



}