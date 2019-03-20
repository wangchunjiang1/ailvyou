<?php
namespace app\home\controller;

use think\Controller;
use app\common\model\Spot;
use think\Request;

class SpotController extends Controller
{

    //数据添加或修改时，所使用的字段名称
    protected $fields=['title','introduction','content'];
    //首页
    public function index()
    {
        //获取分页数据
        $spots=spot::paginate(4);
        $this->assign('spot',$spots);
        return $this->fetch();
    }
    //前往增加景点页
    public function addspot()
    {
        return $this->fetch();
    }
    //添加景点信息
    public function save()
    {
        //上传图片
        $file1=request()->file('photo1');
        $file2=request()->file('photo2');
        $file3=request()->file('photo3');
        $file4=request()->file('photo4');
        $file5=request()->file('photo5');
        $spot=new Spot();
        foreach ($this->fields as $f){
            $spot->$f=input($f);
        }
        if($file1)
        {
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file1->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'uploads');
            if($info){
                // 成功上传后 获取上传信息
                $path= "/uploads/" . date('Y').date('m') .date('d').'/' . $info->getFilename();
                $spot->photo1=$path;
                // $spot->photo2=$path;
            }else{
                // 上传失败获取错误信息
                echo $file1->getError();
            }  
        }
        if($file2)
        {
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file2->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'uploads');
            if($info){
                // 成功上传后 获取上传信息
                $path= "/uploads/" . date('Y').date('m') .date('d').'/' . $info->getFilename();
                $spot->photo2=$path;
                // $spot->photo2=$path;
            }else{
                // 上传失败获取错误信息
                echo $file2->getError();
            }  
        }
        if($file3)
        {
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file3->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'uploads');
            if($info){
                // 成功上传后 获取上传信息
                $path= "/uploads/" . date('Y').date('m') .date('d').'/' . $info->getFilename();
                $spot->photo3=$path;
                // $spot->photo2=$path;
            }else{
                // 上传失败获取错误信息
                echo $file3->getError();
            }  
        }
        if($file4)
        {
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file4->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'uploads');
            if($info){
                // 成功上传后 获取上传信息
                $path= "/uploads/" . date('Y').date('m') .date('d').'/' . $info->getFilename();
                $spot->photo4=$path;
                // $spot->photo2=$path;
            }else{
                // 上传失败获取错误信息
                echo $file4->getError();
            }  
        }
        if($file5)
        {
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file5->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'uploads');
            if($info){
                // 成功上传后 获取上传信息
                $path= "/uploads/" . date('Y').date('m') .date('d').'/' . $info->getFilename();
                $spot->photo5=$path;
                // $spot->photo2=$path;
            }else{
                // 上传失败获取错误信息
                echo $file5->getError();
            }  
        }
        
        //插入到数据库中
        if($spot->save()){
            return $this->success('数据插入成功','/home/spot');
        }else{
            return $this->error('数据插入失败');
        }
    }
    //修改景点信息
    public function edit($id)
    {
        $this->assign('spot',Spot::get($id));
        return $this->fetch();
    }
    //更新
    public function update(Request $request, $id)
    {
        //上传图片
        $spot=Spot::get($id);
            foreach ($this->fields as $f){
                $spot->$f=input($f);
            }
        $file1=request()->file('photo1');
        $file2=request()->file('photo2');
        $file3=request()->file('photo3');
        $file4=request()->file('photo4');
        $file5=request()->file('photo5');
        if($file1)
        {
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file1->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'uploads');
            if($info){
                // 成功上传后 获取上传信息
                $path= "/uploads/" . date('Y').date('m') .date('d').'/' . $info->getFilename();
                $spot->photo1=$path;
                // $spot->photo2=$path;
            }else{
                // 上传失败获取错误信息
                echo $file1->getError();
            }  
        }
        if($file2)
        {
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file2->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'uploads');
            if($info){
                // 成功上传后 获取上传信息
                $path= "/uploads/" . date('Y').date('m') .date('d').'/' . $info->getFilename();
                $spot->photo2=$path;
                // $spot->photo2=$path;
            }else{
                // 上传失败获取错误信息
                echo $file2->getError();
            }  
        }
        if($file3)
        {
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file3->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'uploads');
            if($info){
                // 成功上传后 获取上传信息
                $path= "/uploads/" . date('Y').date('m') .date('d').'/' . $info->getFilename();
                $spot->photo3=$path;
                // $spot->photo2=$path;
            }else{
                // 上传失败获取错误信息
                echo $file3->getError();
            }  
        }
        if($file4)
        {
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file4->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'uploads');
            if($info){
                // 成功上传后 获取上传信息
                $path= "/uploads/" . date('Y').date('m') .date('d').'/' . $info->getFilename();
                $spot->photo4=$path;
            }else{
                // 上传失败获取错误信息
                echo $file4->getError();
            }  
        }
        if($file5)
        {
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file5->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'uploads');
            if($info){
                // 成功上传后 获取上传信息
                $path= "/uploads/" . date('Y').date('m') .date('d').'/' . $info->getFilename();
                $spot->photo5=$path;
            }else{
                // 上传失败获取错误信息
                echo $file5->getError();
            }  
        }
        
        //插入到数据库中
        if($spot->save()){
            return $this->success('数据修改成功','/home/spot');
        }else{
            return $this->error('数据修改失败');
        }
    }

    //删除景点信息
    public function delete($id)
    {
        $spots=Spot::get($id);
        if($spots->delete()){
            return $this->redirect('/home/spot');
        }else{
            return "error";
        }
    }

}