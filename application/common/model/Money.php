<?php

namespace app\common\model;

use think\Model;
use traits\model\SoftDelete;

class Money extends Model
{
    protected $table='money';//可以不加，默认是类名

    //引入软删除机制
    use SoftDelete;
    public function spot()
    {
        return $this->belongsTo('Spot','sid');
    }
}