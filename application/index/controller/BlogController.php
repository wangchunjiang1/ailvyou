<?php
namespace app\index\controller;

use think\Controller;
use app\common\model\User;
use app\common\model\Blog;
use app\common\model\Spot;
use app\common\model\Money;
use think\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs=blog::order('Id','desc')->paginate(2);
        $blogss=blog::order('Id','desc')->limit(3)->select();
        $this->assign('blogss',$blogss);
        $this->assign('blogs',$blogs);
        $this->assign('users',user::all());
        return $this->fetch();
    }
    //用户评论
    public function userblog()
    {
        $user=session('loginedUsers');
        $blogs=blog::order('Id','desc')->paginate(3);
        $blogss=blog::order('Id','desc')->limit(3)->select();
        $users=user::where('username',$user)->select();
        // var_dump($users);
        $this->assign('val',$users);
        $this->assign('blogs',$blogs);
        $this->assign('blogss',$blogss);
        $this->assign('users',user::all());
        return $this->fetch();
    }
    //编写博客
    public function create($id)
    {
        $blogs=blog::order('Id','desc')->paginate(3);
        $blogss=blog::order('Id','desc')->limit(3)->select();
        $this->assign('userss',user::get($id));
        $this->assign('blogs',$blogs);
        $this->assign('blogss',$blogss);
        $this->assign('users',user::all());
        return $this->fetch();
    }
    public function save()
    {
        $user=session('loginedUsers');
        $users=user::where('username',$user)->find();
        $blog=new blog();
        $blog->uid=$users->Id;
        $blog->title=input('title');
        $blog->spot=input('spot');
        $blog->content=input('content');
        $file=request()->file('bphoto1');
        if($file)
        {
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'uploads');
            if($info){
                // 成功上传后 获取上传信息
                $path= "/uploads/" . date('Y').date('m') .date('d').'/' . $info->getFilename();
                $blog->bphoto1=$path;
                // $spot->photo2=$path;
            }else{
                // 上传失败获取错误信息
                echo $file->getError();
            }  
        }
         //插入到数据库中
         if($blog->save()){
            return $this->success('评论发布成功','/index/blog/userblog');
        }else{
            return $this->error('评论发布失败');
        }
    }
    //显示单个
    public function luserblog($id)
    {
        $blogss=blog::order('Id','desc')->limit(3)->select();
        $this->assign('blogss',$blogss);
        $this->assign('users',user::all());
        $this->assign('blogs',blog::get($id));
        return $this->fetch();
    }
}