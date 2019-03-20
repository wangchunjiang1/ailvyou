<?php
namespace app\index\controller;

use think\Controller;
use app\common\model\User;
use app\common\model\Blog;
use app\common\model\Spot;
use app\common\model\Money;
use app\common\model\Adress;
use app\common\model\Order;

class TourController extends Controller
{
    public function index()
    {
        $spot=spot::paginate(8);
        $this->assign('adress',adress::all());
        $this->assign('money',money::all());
        $this->assign('spots',$spot);
        return $this->fetch();
    }
    //搜索
    public function search()
    {
        //获取表单提交数据
        $condition=[];
        $condition['aid']=input('aid');
        $condition['sid']=input('sid');
        $condition['ftime']=input('ftime');
        $condition['people']=input('people');
        $money=money::where($condition)->find();
        if($money)
        {
            $this->assign('adress',adress::all());
            $this->assign('money',$money);
            $this->assign('spots',spot::paginate(8));
            return $this->fetch();
        }else{
            echo "<script type='text/javascript'>alert('暂时还没这项套餐，请再看一下其他套餐吧☺');window.history.go(-1);</script>";
        }
    }
    //订单
    public function order($id)
    {
        $this->assign('adress',adress::all());
        $this->assign('spots',spot::all());
        $this->assign('money',money::get($id));
        return $this->fetch();
    }
    public function sub()
    {
        $user=session('loginedUsers');
        $users=user::where('username',$user)->find();
        $order=new order();
        $order->mid=input('mid');
        $order->uid=$users->Id;
        $condition=[];
        $condition['mid']=input('mid');
        $condition['uid']=$order->uid;
        $orders = order::where($condition)->find();
        if($orders){
            echo "<script type='text/javascript'>alert('你已经预定过这个套餐了，请不要重复预定☺');window.history.go(-1);</script>";
        }else{
            if($order->save()){
                return $this->success('预定成功！','/index/tour');
            }else{
                return $this->error('预定失败，请重试！');
            }
        }   
    }
    //个人订单
    public function userorder()
    {
        $user=session('loginedUsers');
        $users=user::where('username',$user)->find();
        $order=order::where('uid',$users->Id)->select();
        $this->assign('order',$order);
        $this->assign('adress',adress::all());
        $this->assign('spots',spot::all());
        $this->assign('money',money::all());
        $this->assign('users',user::all());
        return $this->fetch();
    }
    //取消订单
    public function delete($id)
    {
        $order=order::get($id);
        if($order->delete()){
            return $this->redirect('/index/tour/userorder');
        }else{
            return "error";
        }
    }
}