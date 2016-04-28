<?php
namespace Admin\Controller;

class CommonController extends BaseController {

	//当前类自动执行的一个方法
	public function _initialize(){
		$id = session('adminLogin');
		if(!$id){
			$this->buildResponse(10200);
		}
	}
	
}