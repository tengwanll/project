<?php
namespace Home\Controller;
use Think\Controller;
class ProjectInfoController extends Controller {
    public function index(){
    	$serviceId=I('get.serviceId');
    	$service=M('service');
    	$serviceInfo=$service->find($serviceId);
    	$this->assign('serviceInfo',$serviceInfo);
        $this->display();
    }
}