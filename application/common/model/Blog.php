<?php

namespace app\common\model;

use think\Model;
use traits\model\SoftDelete;

class Blog extends Model
{
    protected $table='blog';//可以不加，默认是类名

    //引入软删除机制
    use SoftDelete;
    public function user()
    {
        return $this->belongsTo('User','uid');
    }
}