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
        $title=I('get.keyword');
        $carouselModel=M('carousel');
        $fileModel=M('file');
        $where='status=1';
        if($title){
            $where.=" and title like '%$title%' ";
        }
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
                'link'=>$lists['link'],
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
            'link'=>$carousel['link'],
            'createTime'=>$carousel['create_time']
        );
        $this->buildResponse(0,$arr);
    }

    public function update(){
        $json=$this->getContent();
        $id=$json['id'];
        $title=$json['title'];
        $desc=$json['description'];
        $photo=$json['photo'];
        $link=$json['link'];
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
        if($link){
            $data['link']=$link;
        }
        if($title){
            $data['title']=$title;
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
        $title=$json['title'];
        $link=$json['link'];
        $carouselModel=M('carousel');
        $date=date('Y-m-d H:i:s',time());
        $data=array(
            'desc'=>$desc?$desc:'',
            'photo'=>$photo?$photo:0,
            'title'=>$title?$title:'',
            'link'=>$link?$link:'',
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