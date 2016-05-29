<?php
/**
 * Created by PhpStorm.
 * User: tengwanll
 * Date: 2016/5/25
 * Time: 10:15
 */

namespace Admin\Controller;


class CarouselController extends CommonController
{
    public function lists(){
        $page=$this->getPage();
        $carouselModel=M('carousel');
        $fileModel=M('file');
        $newsModel=M('news');
        $serviceModel=M('service');
        $activityModel=M('activity');
        $where='status=1';
        $carouselList=$carouselModel->where($where)->page($page)->select();
        $total=$carouselModel->where($where)->count();
        $arr=array();
        foreach($carouselList as $lists){
            $type=$lists['type'];
            $id=$lists['type_id'];
            if($type=='news'){
                $news=$newsModel->where("status=1 and id=$id")->find();
                $title=$news['title'];
            }elseif($type=='activity'){
                $activity=$activityModel->where("status=1 and id=$id")->find();
                $title=$activity['title'];
            }elseif($type=='service'){
                $service=$serviceModel->where("status=1 and id=$id")->find();
                $title=$service['title'];
            }else{
                $title='主页';
            }
            $photoId=$lists['photo'];
            $photo=$fileModel->where("id=$photoId")->find();
            $photoUrl=$photo?__ROOT__.'/'.$photo['url']:'';
            $arr[]=array(
                'id'=>$lists['id'],
                'title'=>$title,
                'description'=>$lists['desc'],
                'photo'=>$photoUrl,
                'type'=>$type,
                'detailId'=>$id,
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
        $id=I('get._id');
        $carouselModel=M('carousel');
        $fileModel=M('file');
        $newsModel=M('news');
        $serviceModel=M('service');
        $activityModel=M('activity');
        $where="status=1 and id=$id ";
        $carousel=$carouselModel->where($where)->find();
        if(!$carousel){
            $this->buildResponse(10218);
        }
        $type=$carousel['type'];
        $id=$carousel['type_id'];
        if($type=='news'){
            $news=$newsModel->where("status=1 and id=$id")->find();
            $title=$news['title'];
        }elseif($type=='activity'){
            $activity=$activityModel->where("status=1 and id=$id")->find();
            $title=$activity['title'];
        }elseif($type=='service'){
            $service=$serviceModel->where("status=1 and id=$id")->find();
            $title=$service['title'];
        }else{
            $title='主页';
        }
        $photoId=$carousel['photo'];
        $photo=$fileModel->where("id=$photoId")->find();
        $photoUrl=$photo?__ROOT__.'/'.$photo['url']:'';
        $arr=array(
            'id'=>$carousel['id'],
            'title'=>$title,
            'description'=>$carousel['desc'],
            'photo'=>$photoUrl,
            'type'=>$type,
            'detailId'=>$id,
            'createTime'=>$carousel['create_time']
        );
        $this->buildResponse(0,$arr);
    }

    public function update(){
        $json=$this->getContent();
        $id=$json['_id'];
        $desc=$json['description'];
        $photo=$json['photo'];
        $type=$json['type'];
        $typeId=$json['detailId'];
        $carouselModel=M('carousel');
        $where="status=1 and id=$id ";
        $carousel=$carouselModel->where($where)->find();
        if(!$carousel){
            $this->buildResponse(10218);
        }
        $data=array();
        if($desc){
            $data['desc']=$desc;
        }
        if($photo){
            $data['photo']=$photo;
        }
        if($type&&$id!=1){
            $data['type']=$type;
        }
        if($typeId){
            $data['type_id']=$typeId;
        }
        $thesisId=$carouselModel->where($where)->save($data);
        if(!$thesisId){
            $this->buildResponse(10214);
        }
        $this->buildResponse(0);
    }

    public function create(){
        $json=$this->getContent();
        $desc=$json['description'];
        $photo=$json['photo'];
        $type=$json['type'];
        $typeId=$json['detailId'];
        $carouselModel=M('carousel');
        $date=date('Y-m-d H:i:s',time());
        $data=array(
            'desc'=>$desc?$desc:'',
            'photo'=>$photo?$photo:0,
            'type'=>$type?$type:'',
            'type_id'=>$typeId?$typeId:0,
            'status'=>1,
            'create_time'=>$date,
            'update_time'=>$date
        );
        $id=$carouselModel->data($data)->add();
        if(!$id){
            $this->buildResponse(10214);
        }
        $this->buildResponse(0,$id);
    }

    public function delete(){
        $json=$this->getContent();
        $id=$json['_id'];
        if($id==1){
            $this->buildResponse(10219);
        }
        $carouselModel=M('carousel');
        $where="status=1 and id=$id ";
        $carousel=$carouselModel->where($where)->find();
        if(!$carousel){
            $this->buildResponse(10218);
        }
        $data=array('status'=>0);
        $id=$carouselModel->where($where)->save($data);
        if(!$id){
            $this->buildResponse(10214);
        }
        $this->buildResponse(0);
    }
}