<?php

namespace app\common\model;

use think\Model;
use traits\model\SoftDelete;

class Order extends Model
{
    protected $table='order';//可以不加，默认是类名

    //引入软删除机制
    use SoftDelete;
    public function user()
    {
        return $this->belongsTo('users','uid');
    }
}