<?php
namespace app\home\controller;

use think\Controller;
use app\common\model\Blog;
use app\common\model\User;
use think\Request;

class BlogController extends Controller
{
    //用户评论管理页
    public function index()
    {
        $blogs=blog::paginate(4);
        $this->assign('blog',$blogs);
        $this->assign('users',user::all());
        return $this->fetch();
    }
    //查看
    public function review($id)
    {
        $this->assign('blogs',blog::get($id));
        $this->assign('users',user::all());
        return $this->fetch();
    }
    //删除
    public function delete($id)
    {
        $blogs=blog::get($id);
        if($blogs->delete()){
            return $this->redirect('/home/blog');
        }else{
            return "error";
        }
    }
}