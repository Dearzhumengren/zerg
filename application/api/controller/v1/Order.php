<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/3
 * Time: 21:25
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\validate\IDMustBePostiveInt;
use app\api\validate\OrderPlace;
use app\api\validate\PagingParameter;
use app\lib\exception\ForbiddenException;
use app\lib\exception\OrderException;
use app\lib\exception\TokenException;
use think\Controller;
use app\api\service\Token;
use app\api\service\Order as OrderService;
use app\api\model\Order as OrderModel;

class Order extends BaseController
{
    /***
     * 用户在选择商品后，向API提交包含它所选择商品的相关信息
     * API在接收到信息后，需要检查订单相关商品的库存量
     * 有库存，把订单数据存入数据库中=下单成功了，返回客户端消息，告诉客户端可以支付了
     * 调用我们的支付接口，进行支付
     * 还需要再次进行库存量检测
     * 服务器这边就可以调用微信的支付接口进行支付
     * 小程序根据服务器返回的结果拉起微信支付
     * 微信会返回给我们一个支付的结果（异步）
     * 成功：也需要进行库存量的检查
     * 成功：进行库存量的扣除，
     */
    protected $beforeActionList = [
        'checkExclusiveScope'=>['only'=>'placeOrder'],
        'checkPrimaryScope'=>['only'=>'getDetail,getSummaryByUser']
    ];

    /**
     * @param int $page
     * @param int $size
     * @return array
     * @throws \app\lib\exception\ParameterException
     */
    public function getSummaryByUser($page=1,$size=15)
    {
        (new PagingParameter())->goCheck();
        $uid = Token::getCurrentUid();
        $pageingOrders  = OrderModel::getSummaryByUser($uid,$page,$size);
        if ($pageingOrders->isEmpty()){
            return [
                'data'=>[],
                'current_page'=>$pageingOrders->getCurrentPage()
            ];
        }
        $data = $pageingOrders->hidden(['snap_items','snap_address','prepay_id'])->toArray();
        return [
            'data'=>$data,
            'current_page'=>$pageingOrders->getCurrentPage()
        ];
    }


    public function getDetail($id)
    {
        (new IDMustBePostiveInt())->goCheck();
        $orderDetail = OrderModel::get($id);
        if (!$orderDetail){
            throw new OrderException();
        }
        return $orderDetail->hidden(['prepay_id']);

    }





    public function placeOrder()
    {
        (new OrderPlace())->goCheck();
        $products = input('post.products/a');
        $uid = Token::getCurrentUid();

        $order = new OrderService();
        $status = $order->place($uid,$products);
        return $status;

    }


}