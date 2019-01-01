<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/30
 * Time: 21:19
 */

namespace app\api\controller\v1;


use app\api\model\Product as ProductModel;
use app\api\validate\Count;
use app\api\validate\IDMustBePostiveInt;
use app\lib\exception\ProductException;

class Product
{
    /**
     * @param int $count
     * @return $this|false|\PDOStatement|string|\think\Collection
     * @throws ProductException
     * @throws \app\lib\exception\ParameterException
     */
    public function getRecent($count=15)
    {

        (new Count())->goCheck();
        $products = ProductModel::getMostRecent($count);
        if ($products->isEmpty()){
            throw new ProductException();
        }

        $products = $products->hidden(['summary']);
        return $products;

    }

    public function getAllInCategory($id)
    {
        (new IDMustBePostiveInt())->goCheck();
        $products = ProductModel::getProductsByCategoryID($id);
        if ($products->isEmpty()){
            throw new ProductException();
        }
        $products = $products->hidden(['summary']);
        return $products;

    }

    public function getOne($id)
    {
        (new IDMustBePostiveInt())->goCheck();

        $product = ProductModel::getProductDetail($id);
        if (!$product){
            throw new ProductException();
        }

        return $product;

    }

}