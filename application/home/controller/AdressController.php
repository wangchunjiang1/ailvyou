<?php
namespace app\home\controller;

use think\Controller;
use app\common\model\Blog;
use app\common\model\User;
use app\common\model\Adress;
use think\Request;

class AdressController extends Controller
{
    protected $fields=['adress'];
    public function index()
    {
        $adress=adress::paginate(7);
        $this->assign('adress',$adress);
        return $this->fetch();
    }
    //增加
    public function add()
    {
        return $this->fetch();
    }
    public function create()
    {
        $ad=new adress();
        foreach ($this->fields as $f){
            $ad->$f=input($f);
        }
        if($ad->save()){
            return $this->success('数据插入成功','/home/adress');
        }else{
            return $this->error('数据插入失败');
        }
    }
}