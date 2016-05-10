<?php
namespace Home\Controller;
use Think\Controller;
class ServiceController extends Controller {
    public function index(){
        $service=M('service_sort');
        $fileModel=M('file');
        $services=$service->where('type=1 and status=1 and parent_id=0')->limit('4')->select();
        foreach($services as $key=>$item){
            $photoId=$item['logo'];
            $photo=$fileModel->where("id=$photoId")->find();
            $services[$key]['logo']=$photo?$photo['url']:'';
        }
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
        $navigation=array();
        $navigation[]=array(
            'title'=>$sortTitle,
            'url'=>__ROOT__.'/Home/service/lists/serviceId/'.$sortId
        );
        $navigation[]=array(
            'title'=>$serviceInfo['title'],
            'url'=>__ROOT__.'/Home/service/info/serviceId/'.$serviceId
        );
        $this->assign('navigation',$navigation);
    	$this->assign('serviceInfo',$serviceInfo);
        $this->assign('root','service_info');
        $this->assign('sortTitle',$sortTitle);
        $this->display();
    }

    public function lists(){
        $serviceId=I('get.serviceId');
        $service=M('service_sort');
        $serviceInfo=M('service');
        $fileModel=M('file');
        $serviceSortData=$service->where("id=$serviceId")->find();
        $sortTitle=$serviceSortData['title'];
        $photoId=$serviceSortData['photo'];
        $photo=$fileModel->where("id=$photoId")->find();
        $serviceSortData['photo']=$photo?$photo['url']:'';
        $sortList=$serviceInfo->where("sort_id= $serviceId and status=1")->select();
        foreach($sortList as $k=>$value){
            $logoId=$value['logo'];
            $logo=$fileModel->where("id=$logoId")->find();
            $sortList[$k]['logo']=$logo?$logo['url']:'';
        }
        $navigation=array();
        $navigation[]=array(
            'title'=>$sortTitle,
            'url'=>__ROOT__.'/Home/service/lists/serviceId/'.$serviceId
        );
        $this->assign('navigation',$navigation);
        $this->assign('service',$serviceSortData);
        $this->assign('serviceList',$sortList);
        $this->assign('serviceId',$serviceId);
        $this->assign('root','service_list');
        $this->display();
    }
}