<?php
namespace Home\Controller;
use Think\Controller;
class ServiceController extends Controller {
    public function index(){
        $service=M('service_sort');
        $services=$service->where('type=1 and status=1 and parent_id=0')->limit('4')->select();
        $this->assign('service',$services);
        $this->assign('root','service');
        $this->display();
    }

    public function info(){
    	$serviceId=I('get.serviceId');
    	$service=M('service');
    	$serviceInfo=$service->find($serviceId);
    	$this->assign('serviceInfo',$serviceInfo);
        $this->assign('root','service_info');
        $this->display();
    }

    public function lists(){
        $serviceId=I('get.serviceId');
        $service=M('service_sort');
        $serviceInfo=$service->find($serviceId);
        $serviceList=$service->where("parent_id=$serviceId and status=1")->select();
        $services=$service->where('type=1 and status=1 and parent_id=0')->select();
        $this->assign('service',$services);
        $this->assign('serviceInfo',$serviceInfo);
        $this->assign('serviceList',$serviceList);
        $this->assign('serviceId',$serviceId);
        $this->assign('root','service_list');
        $this->display();
    }
}