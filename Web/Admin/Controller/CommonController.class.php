<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {

	//当前类自动执行的一个方法
	public function _initialize(){
		$id = session('login');
		if(!$id) $this->error('页面不存在',U('Login/login'), 3);
		//类库位置应该位于ThinkPHP\Library\Think\
		// $AUTH = new \Think\Auth();
		// if(!$AUTH->check(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME, session('id'))){
		//     $this->error('没有权限',U('Login/login'));
		// }
	}
	
}