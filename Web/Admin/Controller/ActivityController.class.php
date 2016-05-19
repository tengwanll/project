<?php
/**
 * Created by PhpStorm.
 * User: tengwanll
 * Date: 2016/4/29
 * Time: 19:12
 */

namespace Admin\Controller;


class ActivityController extends CommonController
{
    public function lists(){
        $page=$this->getPage();
        $title=I('get.title');
        $activityModel=M('activity');
        $fileModel=M('file');
        if($title){
            $where=" title like '%$title%' and status=1 ";
        }else{
            $where='status=1';
        }
        $activityList=$activityModel->where($where)->page($page)->select();
        $total=$activityModel->where($where)->count();
        $arr=array();
        foreach($activityList as $lists){
            $photoId=$lists['photo'];
            $photo=$fileModel->where("id=$photoId")->find();
            $photoUrl=$photo?__ROOT__.'/'.$photo['url']:'';
            $arr[]=array(
                'id'=>$lists['id'],
                'title'=>$lists['title'],
                'shortDesc'=>$lists['short_desc'],
                'content'=>$lists['content'],
                'photo'=>$photoUrl,
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
        $activityId=I('get.activityId');
        $activityModel=M('activity');
        $fileModel=M('file');
        $activity=$activityModel->where("id=$activityId")->find();
        if(!$activity){
            $this->buildResponse(10207);
        }
        $photoId=$activity['photo'];
        $photo=$fileModel->where("id=$photoId")->find();
        $photoUrl=$photo?__ROOT__.'/'.$photo['url']:'';
        $arr=array(
            'id'=>$activity['id'],
            'title'=>$activity['title'],
            'shortDesc'=>$activity['short_desc'],
            'content'=>$activity['content'],
            'photo'=>$photoUrl,
            'createTime'=>$activity['create_time']
        );
        $this->buildResponse(0,$arr);
    }

    public function create(){
        $json=$this->getContent();
        $title=$json['title'];
        $shortDesc=$json['shortDesc'];
        $content=$json['content'];
        $photo=$json['photo'];
        $date=date('Y-m-d H:i:s',time());
        $data=array(
            'title'=>$title?$title:'',
            'short_desc'=>$shortDesc?$shortDesc:'',
            'content'=>$content?$content:'',
            'photo'=>$photo?$photo:0,
            'status'=>1,
            'create_time'=>$date,
            'update_time'=>$date
        );
        $activityModel=M('activity');
        $activityId=$activityModel->data($data)->add();
        if(!$activityId){
            $this->buildResponse(10214);
        }
        $this->buildResponse(0,$activityId);
    }

    public function update(){
        $json=$this->getContent();
        $activityId=$json['activityId'];
        $title=$json['title'];
        $shortDesc=$json['shortDesc'];
        $content=$json['content'];
        $photo=$json['photo'];
        $activityModel=M('activity');
        $activity=$activityModel->where("id=$activityId")->find();
        if(!$activity){
            $this->buildResponse(10207);
        }
        $data=array();
        if($title){
            $data['title']=$title;
        }
        if($shortDesc){
            $data['short_desc']=$shortDesc;
        }
        if($content){
            $data['content']=$content;
        }
        if($photo){
            $data['photo']=$photo;
        }
        $id=$activityModel->where("id=$activityId")->save($data);
        if(!$id){
            $this->buildResponse(10214);
        }
        $this->buildResponse(0);
    }

    public function delete(){
        $json=$this->getContent();
        $activityId=$json['activityId'];
        $activityModel=M('activity');
        $activity=$activityModel->where("id=$activityId")->find();
        if(!$activity){
            $this->buildResponse(10207);
        }
        $data=array('status'=>0);
        $id=$activityModel->where("id=$activityId")->save($data);
        if(!$id){
            $this->buildResponse(10214);
        }
        $this->buildResponse(0);
    }
}