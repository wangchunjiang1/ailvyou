<?php

namespace app\common\model;

use think\Model;
use traits\model\SoftDelete;

class User extends Model
{
    protected $table='users';//可以不加，默认是类名

    //引入软删除机制
    use SoftDelete;
    public function blog()
    {
        return $this->hasMany('Blog','uid');
    }
    public function order()
    {
        return $this->hasMany('order','uid');
    }
}