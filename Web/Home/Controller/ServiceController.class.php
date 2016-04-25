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
        $sortId=$serviceInfo['sort_id'];
        $serviceSort=M('service_sort');
        $serviceSortData=$serviceSort->where("id=$sortId")->find();
        $sortTitle=$serviceSortData['title'];
    	$this->assign('serviceInfo',$serviceInfo);
        $this->assign('root','service_info');
        $this->assign('sortTitle',$sortTitle);
        $this->display();
    }

    public function list(){
        $serviceId=I('get.serviceId');
        $service=M('service_sort');
        $serviceInfo=M('service');
        $services=$service->where('type=1 and status=1 and parent_id=0')->select();
        $serviceList=array();
        foreach($services as $list){
            $id=$list['id'];
            $serviceList[]=array(
                'id'=>$id,
                'title'=>$list['title'],
                'description'=>$list['description'],
                'logo'=>$list['logo'],
                'sortList'=>$serviceInfo->where("sort_id= $id and status=1")->select()
            );
        }
        $this->assign('service',$services);
        $this->assign('serviceList',$serviceList);
        $this->assign('serviceId',$serviceId);
        $this->assign('root','service_list');
        $this->display();
    }
}