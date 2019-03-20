<?php
namespace app\home\controller;

use think\Controller;
use app\common\model\Adminuser;
use think\Request;

class IndexController extends Controller
{
    //后台首页
    public function index()
    {
        // var_dump(session('?loginedUser'));
        if(session('?loginedUser')==false)
        {
            $this->redirect('/home/index/login');
        }
        //  从模型中读取数据
         $adminuser = Adminuser::all();
        //数据赋值给视图
        $this->assign('adminuser',$adminuser);
        return $this->fetch();
    }
    //登录
    public function login()
    {
        $this->view->engine->layout(false);
        return $this->fetch();
    }
    //登录功能实现
    public function dologin()
    {
         //获取表单提交数据
         $condition=[];
         $condition['username']=input('username');
         $condition['password']=input('password');
         //获取匹配记录
         $user = Adminuser::where($condition)->find();
         //判断
         if ($user){
             //写入session
             session('loginedUser',$user->username);
             //跳转
             return $this->redirect('/home/index');
         }else{
            return "<script>alert('用户名或密码错误！');window.location.href = '/home/index/login';</script>";
            //  return $this->error('用户名或密码错误!');
         }
    }
    //注销
    public function logout()
    {
        session('loginedUser',null);
        return $this->redirect('/home/index/login');
    }
}