<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
	public function login(){
		$arr = cookie('login_r');
		$str = json_encode($arr);//转换json格式以便模版页的js能够接受这个数组
		$this->assign('login_r',$str);
		$this->display();
	}
	public function doLogin(){
		$model=M('user');
		$email=I('post.email');
		$password=md5(I('post.password'));
		$remember=I('post.remember');
		$data=$model->where("email='$email' and password='$password' and auth=2")->find();
		if($data){
			session('id',$data['id']);
			session('login',1);
			if($remember){//记住密码后产生cookie
				$num=count(cookie('login_r'));
				cookie("login_r[$num][0]",$email,86400);
				cookie("login_r[$num][1]",I('post.password'),86400);
			}
			$this->success('登陆成功',U('Index/index'),1);
		}else{
			$this->success('登陆失败',U('Login/login'),1);
		}
	}
}