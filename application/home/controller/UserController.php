<?php
namespace app\home\controller;

use think\Controller;
use app\common\model\User;
use think\Request;

class UserController extends Controller
{
    public function index()
    {
        $user=user::paginate(4);
        $this->assign('users',$user);
        return $this->fetch();
    }
    //删除
    public function delete($id)
    {
        $users=user::get($id);
        if($users->delete()){
            return $this->redirect('/home/user');
        }else{
            return "error";
        }
    }
}