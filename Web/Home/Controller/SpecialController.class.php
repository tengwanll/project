<?php
namespace Home\Controller;
class SpecialController extends CommonController {
    public function index(){
        $serviceId=I('get.serviceId');
        $serviceId=$serviceId?$serviceId:5;
        $model=M('service_sort');
        $serviceInfo=M('service');
        $fileModel=M('file');
        $services=$model->where('type=2 and status=1 and parent_id=0')->select();
        $serviceList=array();
        foreach($services as $list){
            $id=$list['id'];
            $sortList=$serviceInfo->where("sort_id= $id and status=1")->select();
            foreach($sortList as $k=>$value){
                $logoId=$value['logo'];
                $logo=$fileModel->where("id=$logoId")->find();
                $sortList[$k]['logo']=$logo?$logo['url']:'';
            }
            $serviceList[]=array(
                'id'=>$id,
                'title'=>$list['title'],
                'description'=>$list['description'],
                'sortList'=>$sortList
            );
        }
        $navigation=array();
        $navigation[]=array(
            'title'=>'特殊项目',
            'url'=>__ROOT__.'/Home/special/index'
        );
        $this->assign('navigation',$navigation);
        $this->assign('serviceId',$serviceId);
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
        $navigation=array();
        $navigation[]=array(
            'title'=>$sortTitle,
            'url'=>__ROOT__.'/Home/special/index'
        );
        $navigation[]=array(
            'title'=>$serviceInfo['title'],
            'url'=>__ROOT__.'/Home/special/info/serviceId/'.$serviceId
        );
        $this->assign('navigation',$navigation);
        $this->assign('serviceInfo',$serviceInfo);
        $this->assign('root','special_info');
        $this->assign('sortTitle',$sortTitle);
        $this->display();
    }
}