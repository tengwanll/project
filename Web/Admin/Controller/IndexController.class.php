<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){
		//后台首页
		$this->display();
    }
	
	//后台欢迎界面
	public function welcome(){
		echo '欢迎来到芒果TV后台管理界面!';
	}

	//网站配置方法
	public function showConfig(){
		//实例化模型
		$website = M('website');
		//查询当前的网站状态值
		$webInfo = $website->find();
		//分配变量
		$this->assign('webInfo', $webInfo);
		//解析模板
		$this->display();
	}

	//网站配置设置方法
	public function updateConfig(){
		//实例化模型
		$web = M('website');
		//接收创建参数
		$web->create();
		//更新数据并判断返回
		if($web->save()){
			//执行成功
			$this->success('网站配置更新成功', U('Index/showConfig'), 3);
		}else{
			//执行失败
			$this->error('网站配置更新失败', U('Index/showConfig'), 3);
		}
	}
	public function quit(){
		session('id',null);
        session('login',null);
        $this->success('退出成功',U('Admin/Login/login'),1);
	}
}