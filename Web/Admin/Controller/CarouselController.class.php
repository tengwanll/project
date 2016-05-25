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
        $where='status=1';
        $carouselList=$carouselModel->where($where)->page($page)->select();
        $total=$carouselModel->where($where)->count();
        $arr=array();
        foreach($carouselList as $lists){
            $photoId=$lists['photo'];
            $photo=$fileModel->where("id=$photoId")->find();
            $photoUrl=$photo?__ROOT__.'/'.$photo['url']:'';
            $arr[]=array(
                'id'=>$lists['id'],
                'title'=>$lists['title'],
                'description'=>$lists['desc'],
                'photo'=>$photoUrl,
                'type'=>$lists['type'],
                'detailId'=>$lists['type_id'],
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
        $where="status=1 and id=$id ";
        $carousel=$carouselModel->where($where)->find();
        if(!$carousel){
            $this->buildResponse(10218);
        }
        $photoId=$carousel['photo'];
        $photo=$fileModel->where("id=$photoId")->find();
        $photoUrl=$photo?__ROOT__.'/'.$photo['url']:'';
        $arr=array(
            'id'=>$carousel['id'],
            'title'=>$carousel['title'],
            'description'=>$carousel['desc'],
            'photo'=>$photoUrl,
            'type'=>$carousel['type'],
            'detailId'=>$carousel['type_id'],
            'createTime'=>$carousel['create_time']
        );
        $this->buildResponse(0,$arr);
    }

    public function update(){
        $json=$this->getContent();
        $id=$json['carouselId'];
        $title=$json['title'];
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
        if($title){
            $data['title']=$title;
        }
        if($desc){
            $data['desc']=$desc;
        }
        if($photo){
            $data['photo']=$photo;
        }
        if($type){
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
        $title=$json['title'];
        $desc=$json['description'];
        $photo=$json['photo'];
        $type=$json['type'];
        $typeId=$json['detailId'];
        $carouselModel=M('carousel');
        $date=date('Y-m-d H:i:s',time());
        $data=array(
            'title'=>$title?$title:'',
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
        $id=$json['carouselId'];
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