<?php
namespace app\home\controller;

use think\Controller;
use app\common\model\Money;
use app\common\model\Spot;
use app\common\model\Adress;
use think\Request;

class MoneyController extends Controller
{
    protected $fields=['sid','aid','ftime','endtime','people','money'];
    //旅游管理首页
    public function index()
    {
         //获取分页数据
         $money=money::paginate(4);
         $spot=spot::all();
         $adress=adress::all();
         $this->assign('money',$money);
         $this->assign('adress',$adress);
         $this->assign('spots',$spot);
        return $this->fetch();
    }
    //前往增加旅游管理信息页
    public function addmoney()
    {
        $this->assign('adress',adress::all());
        $this->assign('spots',spot::all());
        return $this->fetch();
    }
    public function save()
    {
        $mon=new money();
        foreach ($this->fields as $f){
            $mon->$f=input($f);
        }
        if($mon->save()){
            return $this->success('数据插入成功','/home/money');
        }else{
            return $this->error('数据插入失败');
        }
    }
    //修改旅游管理页
    public function edit($id)
    {
        $this->assign('spots',spot::all());
        $this->assign('money',money::get($id));
        return $this->fetch();
    }
    //更新
    public function update($id)
    {
        $mon=money::get($id);
        foreach ($this->fields as $f){
            $mon->$f=input($f);
        }
        if($mon->save()){
            return $this->success('数据修改成功','/home/money');
        }else{
            return $this->error('数据修改失败');
        }
    }
    //删除
    public function delete($id)
    {
        $money=money::get($id);
        if($money->delete()){
            return $this->redirect('/home/money');
        }else{
            return "error";
        }
    }
}