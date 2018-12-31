<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/30
 * Time: 22:25
 */

namespace app\api\controller\v1;


use app\api\model\Category as CategoryModel;
use app\lib\exception\CategoryException;

class Category
{
    /**
     * @return false|static[]
     * @throws CategoryException
     * @throws \think\exception\DbException
     */
    public function getAllCategories()
    {
        $categories = CategoryModel::all([],'img');
        if ($categories->isEmpty()){
            throw new CategoryException();
        }

        return $categories;



    }

}