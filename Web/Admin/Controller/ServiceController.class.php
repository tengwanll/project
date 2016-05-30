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
        $title=I('get.keyword');
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
        $serviceList=$serviceModel->field('s.id,s.title,s.logo,s.short_desc,s.description,s.experiment_flow,s.user_notice,s.result_show,s.server_circle,s.experiment_theory,s.advantage,s.literature,s.create_time,t.title as sortTitle,t.type')->where($where)->page($page)->select();
        $total=$serviceModel->where($where)->count();
        $arr=array();
        foreach($serviceList as $lists){
            $logoId=$lists['logo'];
            $photo=$fileModel->where("id=$logoId")->find();
            $photoUrl=$photo?__ROOT__.'/'.$photo['url']:'';
            $arr[]=array(
                'id'=>$lists['id'],
                'title'=>$lists['title'],
                'type'=>$lists['type'],
                'sortTitle'=>$lists['sortTitle'],
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
            'list'=>$arr,
            'total'=>$total
        );
        $this->buildResponse(0,$result);
    }

    public function detail(){
        $serviceId=I('get._id');
        $fileModel=M('file');
        $serviceModel=M('service s,service_sort t');
        $where=" s.status=1 and s.sort_id=t.id and s.id=$serviceId ";
        $service=$serviceModel->field('s.id,s.title,s.logo,s.short_desc,s.description,s.experiment_flow,s.user_notice,s.result_show,s.server_circle,s.experiment_theory,s.advantage,s.literature,s.create_time,t.title as sortTitle')->where($where)->find();
        if(!$service){
            $this->buildResponse(10206);
        }
        $logoId=$service['logo'];
        $photo=$fileModel->where("id=$logoId")->find();
        $photoUrl=$photo?__ROOT__.'/'.$photo['url']:'';
        $arr=array(
            'id'=>$service['id'],
            'title'=>$service['title'],
            'sortTitle'=>$service['sortTitle'],
            'logo'=>$photoUrl,
            'shortDesc'=>$service['short_desc'],
            'description'=>$service['description'],
            'experimentFlow'=>$service['experiment_flow'],
            'userNotice'=>$service['user_notice'],
            'resultShow'=>$service['result_show'],
            'serverCircle'=>$service['server_circle'],
            'experimentTheory'=>$service['experiment_theory'],
            'advantage'=>$service['advantage'],
            'literature'=>$service['literature'],
            'createTime'=>$service['create_time']
        );
        $this->buildResponse(0,$arr);
    }

    public function create(){
        $serviceModel=M('service');
        $json=$this->getContent();
        $title=$json['title'];              // 标题
        $logo=$json['logo'];                // 封面
        $shortDesc=$json['shortDesc'];      // 简介
        $description=$json['description'];  // 简介
        $experimentFlow=$json['experimentFlow'];    // 实验流程
        $userNotice=$json['userNotice'];    // 用户须知
        $resultShow=$json['resultShow'];    // 结果展示
        $serverCircle=$json['serverCircle'];// 服务周期
        $experimentTheory=$json['experimentTheory'];    // 实验原理
        $advantage=$json['advantage'];      // 优势
        $literature=$json['literature'];    // 文献
        $date=date('Y-m-d H:i:s',time());
        $sortId=$json['sort_id'];            // 分类
        $data=array(
            'title'=>$title?$title:'',
            'logo'=>$logo?$logo:0,
            'short_desc'=>$description?$description:'',
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
        if(!$id){
            $this->buildResponse(10214);
        }
        $this->buildResponse(0,$id);
    }

    public function update(){
        $serviceModel=M('service');
        $json=$this->getContent();
        $serviceId=$json['_id'];
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
        $sortId=$json['sort_id'];
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
        $id=$serviceModel->where("id=$serviceId")->save($data);
        if(!$id){
            $this->buildResponse(10214);
        }
        $this->buildResponse(0);
    }

    public function delete(){
        $json=$this->getContent();
        $serviceId=$json['_id'];
        $serviceModel=M('service');
        $service=$serviceModel->where("id=$serviceId")->find($serviceId);
        if(!$service){
            $this->buildResponse(10206);
        }
        $data=array('status'=>0);
        $id=$serviceModel->where("id=$serviceId")->save($data);
        if(!$id){
            $this->buildResponse(10214);
        }
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
                'type'=>$lists['type'],
                'logo'=>$logoUrl,
                'photo'=>$photoUrl,
                'description'=>$lists['description'],
                'createTime'=>$lists['create_time']
            );
        }
        $this->buildResponse(0,$arr);
    }
}