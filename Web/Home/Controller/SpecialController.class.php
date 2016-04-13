<?php
namespace Home\Controller;
use Think\Controller;
class SpecialController extends Controller {
    public function index(){
        $model=M('service_sort');
        $serviceInfo=M('service');
        $services=$model->where('type=2 and status=1 and parent_id=0')->select();
        $serviceList=array();
        foreach($services as $list){
            $id=$list['id'];
            $serviceList[]=array(
                'id'=>$id,
                'title'=>$list['title'],
                'description'=>$list['description'],
                'sortList'=>$serviceInfo->where("sort_id= $id and status=1")->select()
            );
        }
        $this->assign('root','special_list');
        $this->assign('service',$services);
        $this->assign('serviceList',$serviceList);
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
        $this->assign('root','special_info');
        $this->assign('sortTitle',$sortTitle);
        $this->display();
    }
}