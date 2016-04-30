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
        $title=I('get.title');
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
        $trainingModel->where("id=$trainingId")->save($data);
        $this->buildResponse(0);
    }

    public function delete(){
        $trainingId=I('get.trainingId');
        $trainingModel=M('training');
        $training=$trainingModel->where("id=$trainingId")->find();
        if(!$training){
            $this->buildResponse(10209);
        }
        $data=array('status'=>0);
        $trainingModel->where("id=$trainingId")->save($data);
        $this->buildResponse(0);
    }
}