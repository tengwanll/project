<?php

namespace Admin\Controller;


class ServiceController extends CommonController
{
    /**
     * 服务查询
     */
    public function serviceList(){
        $page=$this->getPage();
        $type=I('get.type');
        $title=I('get.title');
        $sortId=I('get.sortId');
        $fileModel=M('file');
        $serviceModel=M('service s,service_sort t');
        $where=array();
        $where[]=' s.status=1 and s.sort_id=t.id ';
        if($type){
            $where[]=" t.type=$type ";
        }
        if($sortId){
            $where[]=" s.sort_id=$sortId ";
        }
        if($title){
            $where[]=" s.title like '%$title%' ";
        }
        $where=$this->makeQueryString($where);
        $serviceList=$serviceModel->field('s.id,s.title,s.logo,s.short_desc,s.description,s.experiment_flow,s.user_notice,s.result_show,s.server_circle,s.experiment_theory,s.advantage,s.literature,s.create_time')->where($where)->page($page)->select();
        $total=$serviceModel->where($where)->count();
        $arr=array();
        foreach($serviceList as $lists){
            $logoId=$lists['logo'];
            $photo=$fileModel->where("id=$logoId")->find();
            $photoUrl=$photo?__ROOT__.'/'.$photo['url']:'';
            $arr[]=array(
                'id'=>$lists['id'],
                'title'=>$lists['title'],
                'logo'=>$photoUrl,
                'shortDesc'=>$lists['short_desc'],
                'description'=>$lists['description'],
                'experimentFlow'=>$lists['experiment_flow'],
                'userNotice'=>$lists['user_notice'],
                'resultShow'=>$lists['result_show'],
                'serverCircle'=>$lists['server_circle'],
                'experimentTheory'=>$lists['experiment_theory'],
                'advantage'=>$lists['advantage'],
                'literature'=>$lists['literature'],
                'createTime'=>$lists['create_time']
            );
        }
        $result=array(
            'serviceList'=>$arr,
            'total'=>$total
        );
        $this->buildResponse(0,$result);
    }

    public function create(){
        $serviceModel=M('service');
        $json=$this->getContent();
        $title=$json['title'];
        $logo=$json['logo'];
        $shortDesc=$json['shortDesc'];
        $description=$json['description'];
        $experimentFlow=$json['experimentFlow'];
        $userNotice=$json['userNotice'];
        $resultShow=$json['resultShow'];
        $serverCircle=$json['serverCircle'];
        $experimentTheory=$json['experimentTheory'];
        $advantage=$json['advantage'];
        $literature=$json['literature'];
        $date=date('Y-m-d H:i:s',time());
        $sortId=$json['sortId'];
        $data=array(
            'title'=>$title?$title:'',
            'logo'=>$logo?$logo:0,
            'short_desc'=>$shortDesc?$shortDesc:'',
            'description'=>$description?$description:'',
            'experiment_flow'=>$experimentFlow?$experimentFlow:'',
            'user_notice'=>$userNotice?$userNotice:'',
            'result_show'=>$resultShow?$resultShow:'',
            'server_circle'=>$serverCircle?$serverCircle:'',
            'experiment_theory'=>$experimentTheory?$experimentTheory:'',
            'advantage'=>$advantage?$advantage:'',
            'literature'=>$literature?$literature:'',
            'create_time'=>$date,
            'status'=>1,
            'update_time'=>$date,
            'sort_id'=>$sortId
        );
        $id=$serviceModel->data($data)->add();
        $this->buildResponse(0,$id);
    }

    public function update(){
        $serviceModel=M('service');
        $json=$this->getContent();
        $serviceId=$json['serviceId'];
        $title=$json['title'];
        $logo=$json['logo'];
        $shortDesc=$json['shortDesc'];
        $description=$json['description'];
        $experimentFlow=$json['experimentFlow'];
        $userNotice=$json['userNotice'];
        $resultShow=$json['resultShow'];
        $serverCircle=$json['serverCircle'];
        $experimentTheory=$json['experimentTheory'];
        $advantage=$json['advantage'];
        $literature=$json['literature'];
        $sortId=$json['sortId'];
        $service=$serviceModel->where("id=$serviceId")->find();
        if(!$service){
            $this->buildResponse(10206);
        }
        $data=array();
        if($title){
            $data['title']=$title;
        }
        if($logo){
            $data['logo']=$logo;
        }
        if($shortDesc){
            $data['short_desc']=$shortDesc;
        }
        if($description){
            $data['description']=$description;
        }
        if($experimentFlow){
            $data['experiment_flow']=$experimentFlow;
        }
        if($userNotice){
            $data['user_notice']=$userNotice;
        }
        if($resultShow){
            $data['result_show']=$resultShow;
        }
        if($serverCircle){
            $data['server_circle']=$serverCircle;
        }
        if($experimentTheory){
            $data['experiment_theory']=$experimentTheory;
        }
        if($advantage){
            $data['advantage']=$advantage;
        }
        if($literature){
            $data['literature']=$literature;
        }
        if($sortId){
            $data['sort_id']=$sortId;
        }
        $serviceModel->where("id=$serviceId")->save($data);
        $this->buildResponse(0);
    }

    public function delete(){
        $serviceId=I('get.serviceId');
        $serviceModel=M('service');
        $service=$serviceModel->where("id=$serviceId")->find($serviceId);
        if(!$service){
            $this->buildResponse(10206);
        }
        $data=array('status'=>0);
        $serviceModel->where("id=$serviceId")->save($data);
        $this->buildResponse(0);
    }

    public function sortList(){
        $title=I('get.title');
        $type=I('get.type');
        $sortModel=M('service_sort');
        $where=array();
        $where[]=' status=1 ';
        $fileModel=M('file');
        if($title){
            $where[]=" title like '%$title%' ";
        }
        if($type){
            $where[]=" type=$type ";
        }
        $where=$this->makeQueryString($where);
        $sortList=$sortModel->where($where)->select();
        $arr=array();
        foreach($sortList as $lists){
            $logoId=$lists['logo'];
            $photoId=$lists['photo'];
            $logo=$fileModel->where("id=$logoId")->find();
            $photo=$fileModel->where("id=$photoId")->find();
            $logoUrl=$logo?__ROOT__.'/'.$logo['url']:'';
            $photoUrl=$photo?__ROOT__.'/'.$photo['url']:'';
            $arr[]=array(
                'id'=>$lists['id'],
                'title'=>$lists['title'],
                'logo'=>$logoUrl,
                'photo'=>$photoUrl,
                'description'=>$lists['description'],
                'createTime'=>$lists['create_time']
            );
        }
        $this->buildResponse(0,$arr);
    }
}