<?php
namespace app\index\controller;

use think\Controller;
use app\common\model\{User,Blog,Spot,Money,Adress,Advice};
use think\Request;

class IndexController extends Controller
{

    public function index()
    {
        $spot=spot::all();
        $money=money::all();
        $user=user::all();
        $this->assign('adress',adress::all());
        $this->assign('user',$user);
        $this->assign('blogs',blog::all());
        $this->assign('money',$money);
        $this->assign('spots',$spot);
        return $this->fetch();
    }
    //联系我们
    public function contact()
    {
        return $this->fetch();
    }
    public function cont()
    {
        $advice=new Advice();
        $advice->email=input('email');
        $advice->subject=input('subject');
        $advice->advice=input('advice');
        if($advice->save())
        {
            return $this->success('提交成功，我们会采取您的意见☺','/index/index/contact');
        }else{
            return $this->error('提交失败，请重新提交','/index/index/contact');
        }
    }
    //登录
    public function login()
    {
        $this->view->engine->layout(false);
        return $this->fetch();
    }
    //登录管理
    public function dologin()
    {
         //获取表单提交数据
         $condition=[];
         $condition['email']=input('email');
         $condition['password']=md5(input('password'));
         //获取匹配记录
         $user = user::where($condition)->find();
         //判断
         
         if ($user){
             //写入session
             session('loginedUsers',$user->username);
             //跳转
             echo "<script type='text/javascript'>window.history.go(-2);</script>   ";
         }else{
            return "<script>alert('邮箱或密码错误！');window.history.go(-2);</script>";
            //  return $this->error('用户名或密码错误!');
         }
    }
    //注销
    public function logout()
    {
        session('loginedUsers',null);
        echo "<script type='text/javascript'>window.history.go(-1);</script>   ";
    }
    //注册
    public function register()
    {
        $this->view->engine->layout(false);
        return $this->fetch();
    }
    public function doregister(Request $request)
    {
        $user = new user();
        //获取表单数据
        $user->email = $request->param('email');
        $user->password = md5(input('password'));
        $user->username=input('username');
        //插入到数据库中
        if ($user->save()){
            //注册成功
            echo "<script type='text/javascript'>alert('注册成功！');window.history.go(-2);</script>   ";
        }else{
            //注册失败
            return $this->error('注册失败，请重试！');
        }
    }
}
