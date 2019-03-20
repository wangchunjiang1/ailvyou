<?php

namespace app\common\model;

use think\Model;
use traits\model\SoftDelete;

class Spot extends Model
{
    protected $table='spot';//可以不加，默认是类名

    //引入软删除机制
    use SoftDelete;
    public function money()
    {
        return $this->hasMany('Money','sid');
    }
}