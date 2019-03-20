<?php

namespace app\common\model;

use think\Model;
use traits\model\SoftDelete;

class Advice extends Model
{
    protected $table='advice';//可以不加，默认是类名

    //引入软删除机制
    use SoftDelete;
}