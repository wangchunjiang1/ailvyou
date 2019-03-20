<?php
namespace app\index\controller;

use think\Controller;
use app\common\model\User;
use app\common\model\Blog;
use app\common\model\Spot;
use app\common\model\Money;

class TouradController extends Controller
{
    public function index()
    {
        $spot=spot::paginate(9);
        $this->assign('spots',$spot);
        return $this->fetch();
    }
    //查看
    public function view($id)
    {
        $spots=spot::order('Id','desc')->limit(3)->select();
        $this->assign('spot',spot::get($id));
        $this->assign('spots',$spots);
        return $this->fetch();
    }
}