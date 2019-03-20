<?php
namespace app\home\controller;

use think\Controller;
use app\common\model\User;
use app\common\model\Adress;
use app\common\model\Order;
use app\common\model\Spot;
use app\common\model\Money;
use think\Request;

class OrderController extends Controller
{
    public function index()
    {
        $order=order::paginate(5);
        $this->assign('users',user::all());
        $this->assign('money',money::all());
        $this->assign('spots',spot::all());
        $this->assign('adress',adress::all());
        $this->assign('orders',$order);
        return $this->fetch();
    }
}