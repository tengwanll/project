<?php
/**
 * Created by PhpStorm.
 * User: tengwanll
 * Date: 2016/4/29
 * Time: 19:12
 */

namespace Admin\Controller;


class TrainingController extends CommonController
{
    public function lists(){
        $page=$this->getPage();
        $title=I('get.keyword');
        $trainingModel=M('training');
        $fileModel=M('file');
        if($title){
            $where=" title like '%$title%' and status=1 ";
        }else{
            $where='status=1';
        }
        $trainingList=$trainingModel->where($where)->page($page)->select();
        $total=$trainingModel->where($where)->count();
        $arr=array();
        foreach($trainingList as $lists){
            $photoId=$lists['photo'];
            $photo=$fileModel->where("id=$photoId")->find();
            $photoUrl=$photo?__ROOT__.'/'.$photo['url']:'';
            $arr[]=array(
                'id'=>$lists['id'],
                'title'=>$lists['title'],
                'content'=>$lists['content'],
                'photo'=>$photoUrl,
                'createTime'=>$lists['create_time']
            );
        }
        $result=array(
            'trainingList'=>$arr,
            'total'=>$total
        );
        $this->buildResponse(0,$result);
    }

    public function detail(){
        $trainingId=I('get._id');
        $trainingModel=M('training');
        $fileModel=M('file');
        $training=$trainingModel->where("id=$trainingId")->find();
        if(!$training){
            $this->buildResponse(10209);
        }
        $photoId=$training['photo'];
        $photo=$fileModel->where("id=$photoId")->find();
        $photoUrl=$photo?__ROOT__.'/'.$photo['url']:'';
        $arr=array(
            'id'=>$training['id'],
            'title'=>$training['title'],
            'content'=>$training['content'],
            'photo'=>$photoUrl,
            'createTime'=>$training['create_time']
        );
        $this->buildResponse(0,$arr);
    }

    public function create(){
        $json=$this->getContent();
        $title=$json['title'];
        $content=$json['content'];
        $photo=$json['photo'];
        $date=date('Y-m-d H:i:s',time());
        $data=array(
            'title'=>$title?$title:'',
            'content'=>$content?$content:'',
            'photo'=>$photo?$photo:0,
            'status'=>1,
            'create_time'=>$date,
            'update_time'=>$date
        );
        $trainingModel=M('training');
        $trainingId=$trainingModel->data($data)->add();
        if(!$trainingId){
            $this->buildResponse(10214);
        }
        $this->buildResponse(0,$trainingId);
    }

    public function update(){
        $json=$this->getContent();
        $trainingId=$json['trainingId'];
        $title=$json['title'];
        $content=$json['content'];
        $photo=$json['photo'];
        $trainingModel=M('training');
        $training=$trainingModel->where("id=$trainingId")->find();
        if(!$training){
            $this->buildResponse(10209);
        }
        $data=array();
        if($title){
            $data['title']=$title;
        }
        if($content){
            $data['content']=$content;
        }
        if($photo){
            $data['photo']=$photo;
        }
        $trainingId=$trainingModel->where("id=$trainingId")->save($data);
        if(!$trainingId){
            $this->buildResponse(10214);
        }
        $this->buildResponse(0);
    }

    public function delete(){
        $json=$this->getContent();
        $trainingId=$json['trainingId'];
        $trainingModel=M('training');
        $training=$trainingModel->where("id=$trainingId")->find();
        if(!$training){
            $this->buildResponse(10209);
        }
        $data=array('status'=>0);
        $trainingId=$trainingModel->where("id=$trainingId")->save($data);
        if(!$trainingId){
            $this->buildResponse(10214);
        }
        $this->buildResponse(0);
    }
}