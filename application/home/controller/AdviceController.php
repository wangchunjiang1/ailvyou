<?php
namespace app\home\controller;

use think\Controller;
use app\common\model\Advice;
use think\Request;

class AdviceController extends Controller
{
    public function index()
    {
        $this->assign('advice',advice::paginate(5));
        return $this->fetch();
    }
    public function delete($id)
    {
        $advice=advice::get($id);
        if($advice->delete())
        {
            return $this->redirect('/home/advice');
        }else{
            return "error";
        }
    }
}