<?php
/**
 * Created by PhpStorm.
 * User: tengwanll
 * Date: 2016/4/29
 * Time: 19:12
 */

namespace Admin\Controller;


class LaboratoryController extends CommonController
{
    public function lists(){
        $page=$this->getPage();
        $name=I('get.name');
        $labModel=M('lab');
        $fileModel=M('file');
        if($name){
            $where=" name like '%$name%' and status=1 ";
        }else{
            $where='status=1';
        }
        $labList=$labModel->where($where)->page($page)->select();
        $total=$labModel->where($where)->count();
        $arr=array();
        foreach($labList as $lists){
            $photoId=$lists['photo'];
            $photoDetailId=$lists['photo_detail'];
            $photo=$fileModel->where("id=$photoId")->find();
            $photoUrl=$photo?__ROOT__.'/'.$photo['url']:'';
            $photoDetail=$fileModel->where("id=$photoDetailId")->find();
            $photoDetailUrl=$photoDetail?__ROOT__.'/'.$photoDetail['url']:'';
            $arr[]=array(
                'id'=>$lists['id'],
                'name'=>$lists['name'],
                'photoDetailUrl'=>$photoDetailUrl,
                'description'=>$lists['description'],
                'photo'=>$photoUrl,
                'createTime'=>$lists['create_time']
            );
        }
        $result=array(
            'labList'=>$arr,
            'total'=>$total
        );
        $this->buildResponse(0,$result);
    }

    public function detail(){
        $labId=I('get.labId');
        $labModel=M('lab');
        $fileModel=M('file');
        $lab=$labModel->where("id=$labId")->find();
        if(!$lab){
            $this->buildResponse(10208);
        }
        $photoId=$lab['photo'];
        $photoDetailId=$lab['photo_detail'];
        $photo=$fileModel->where("id=$photoId")->find();
        $photoUrl=$photo?__ROOT__.'/'.$photo['url']:'';
        $photoDetail=$fileModel->where("id=$photoDetailId")->find();
        $photoDetailUrl=$photoDetail?__ROOT__.'/'.$photoDetail['url']:'';
        $arr=array(
            'id'=>$lab['id'],
            'name'=>$lab['name'],
            'photoDetailUrl'=>$photoDetailUrl,
            'description'=>$lab['description'],
            'photo'=>$photoUrl,
            'createTime'=>$lab['create_time']
        );
        $this->buildResponse(0,$arr);
    }

    public function create(){
        $json=$this->getContent();
        $name=$json['name'];
        $photoDetail=$json['photoDetail'];
        $description=$json['description'];
        $photo=$json['photo'];
        $date=date('Y-m-d H:i:s',time());
        $data=array(
            'name'=>$name?$name:'',
            '$photo_detail'=>$photoDetail?$photoDetail:0,
            'description'=>$description?$description:'',
            'photo'=>$photo?$photo:0,
            'status'=>1,
            'create_time'=>$date,
            'update_time'=>$date
        );
        $labModel=M('lab');
        $labId=$labModel->data($data)->add();
        $this->buildResponse(0,$labId);
    }

    public function update(){
        $json=$this->getContent();
        $labId=$json['labId'];
        $name=$json['name'];
        $photoDetail=$json['photoDetail'];
        $description=$json['description'];
        $photo=$json['photo'];
        $labModel=M('lab');
        $lab=$labModel->where("id=$labId")->find();
        if(!$lab){
            $this->buildResponse(10208);
        }
        $data=array();
        if($name){
            $data['name']=$name;
        }
        if($photoDetail){
            $data['photo_detail']=$photoDetail;
        }
        if($description){
            $data['description']=$description;
        }
        if($photo){
            $data['photo']=$photo;
        }
        $labModel->where("id=$labId")->save($data);
        $this->buildResponse(0);
    }

    public function delete(){
        $labId=I('get.labId');
        $labModel=M('lab');
        $lab=$labModel->where("id=$labId")->find();
        if(!$lab){
            $this->buildResponse(10208);
        }
        $data=array('status'=>0);
        $labModel->where("id=$labId")->save($data);
        $this->buildResponse(0);
    }
}