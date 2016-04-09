<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends CommonController {
	public function index(){//list关键字,不能用来命名
		$num=I('get.num');
		$num=!empty($num)?$num:5;
		$search=I('get.search');
		$where='';
		if($search){
			$where="email like '%$search%'";
		}
		$model=M('user');
    	$count=$model->where($where)->count();
    	$Page = new \Think\Page($count, $num);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		//获取页码的字符串
		$pages = $Page->show();// 分页显示输出
		//获取limit参数
		$limit = $Page->firstRow.','.$Page->listRows;
		$data=$model->limit($limit)->where($where)->select();
		$this->assign('data',$data);
		$this->assign('search',$search);
		$this->assign('pages',$pages);
		$this->assign('count',$count);
		$this->assign('num',$num);
		$this->display();
	}
	public function add(){
		$this->display();
	}
	public function insert(){
		$id=I('post.id');
		$model=M('user');
		$email=$_POST['email'];
		if($model->where("email='$email'")->select()){
			$this->error('该邮箱已经被注册',U('User/add'),2);
		}
		$upload = new \Think\Upload();// 实例化上传类  
		$upload->maxSize=5242880 ;// 设置附件上传大小5242880
		$upload->exts=array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
		$upload->rootPath = "./Public";//需要手动设置上传的根目录
		$upload->savePath='./Uploads/headPic/'; // 设置附件上传目录        
		$info=$upload->uploadOne($_FILES['upload']); // 上传文件 
	    if($info) {// 上传错误提示错误信息        
			$_POST['headPic']=$upload->rootPath.$info['savepath'].$info['savename'];
		}
		$_POST['password']=md5($_POST['password']);
		$model->create();
		if($model->add()){
			$this->success('添加成功',U('User/index'),2);
		}else{
			$this->error('添加失败',U('User/add'),2);
			@unlink($_POST['headPic']);
		}
		
	}
	public function ajaxCheck(){
		$email=$_POST['email'];
		$model=M('user');
		if($model->where("email='$email'")->select()){
			$this->ajaxReturn('1');
		}else{
			$this->ajaxReturn('0');

		}
	}
	public function edit(){
		$id=I('get.id');
		$model=M('user');
		$data=$model->find($id);
		$this->assign('data',$data);
		$this->display();
	}
	public function update(){
		$id=I('post.id');
		$model=M('user');
		$path=$model->find($id);
		$upload = new \Think\Upload();// 实例化上传类  
		$upload->maxSize=5242880 ;// 设置附件上传大小5242880
		$upload->exts=array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
		$upload->rootPath = "./Public";//需要手动设置上传的根目录
		$upload->savePath='./Uploads/'; // 设置附件上传目录        
		$info=$upload->uploadOne($_FILES['upload']); // 上传文件 
	    if($info) {// 上传错误提示错误信息        
			$_POST['headPic']=$upload->rootPath.$info['savepath'].$info['savename'];
		}
		$model->create();
		if($model->save()){
			$this->success('更新成功',U('User/index'),2);
			@unlink($path['headPic']);
		}else{
			$this->error('更新失败',U('User/edit',array('id'=>$id)),2);
			@unlink($_POST['headPic']);
		}
	}
	public function delete(){
		$id=I('get.id');
		$model=M('user');
		//删除操作
		if($model->delete($id)){
			$this->success('删除成功', U('User/index'), 2);
		}else{
			$this->error('删除失败', U('User/index'), 2);
		}
	}
	public function ajaxUpdate(){
		$model=M('user');
		$model->create();
		if($model->save()){
			$this->ajaxReturn('0');
		}else{
			$this->ajaxReturn('1');
		}
	}
}