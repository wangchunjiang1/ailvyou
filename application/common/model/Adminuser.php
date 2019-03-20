<?php

namespace app\common\model;

use think\Model;
use traits\model\SoftDelete;

class Adminuser extends Model
{
    protected $table='adminuser';//可以不加，默认是类名

    //引入软删除机制
    use SoftDelete;
}