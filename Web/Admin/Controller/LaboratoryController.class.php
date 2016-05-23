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
        $name=I('get.keyword');
        $labModel=M('lab');
        $labPhotoModel=M('lab_photo');
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
            $labId=$lists['id'];
            $photoId=$lists['photo'];
            $photo=$fileModel->where("id=$photoId")->find();
            $photoUrl=$photo?__ROOT__.'/'.$photo['url']:'';
            $photoDetailUrl=array();
            $labPhotos=$labPhotoModel->where("lab_id=$labId and status=1")->select();
            foreach($labPhotos as $labPhoto){
                $id=$labPhoto['id'];
                $photoDetailId=$labPhoto['file_id'];
                $photoDetail=$fileModel->where("id=$photoDetailId")->find();
                $photoDetailUrl[]=array(
                    'id'=>$id,
                    'url'=>$photoDetail?__ROOT__.'/'.$photoDetail['url']:'',
                );
            }
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
            'list'=>$arr,
            'total'=>$total
        );
        $this->buildResponse(0,$result);
    }

    public function detail(){
        $labId=I('get._id');
        $labModel=M('lab');
        $fileModel=M('file');
        $labPhotoModel=M('lab_photo');
        $lab=$labModel->where("id=$labId")->find();
        if(!$lab){
            $this->buildResponse(10208);
        }
        $photoId=$lab['photo'];
        $photo=$fileModel->where("id=$photoId")->find();
        $photoUrl=$photo?__ROOT__.'/'.$photo['url']:'';
        $photoDetailUrl=array();
        $labPhotos=$labPhotoModel->where("lab_id=$labId and status=1")->select();
        foreach($labPhotos as $labPhoto){
            $id=$labPhoto['id'];
            $photoDetailId=$labPhoto['file_id'];
            $photoDetail=$fileModel->where("id=$photoDetailId")->find();
            $photoDetailUrl[]=array(
                'id'=>$id,
                'url'=>$photoDetail?__ROOT__.'/'.$photoDetail['url']:'',
            );
        }
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
            'photo_detail'=>$photoDetail?$photoDetail:0,
            'description'=>$description?$description:'',
            'photo'=>$photo?$photo:0,
            'status'=>1,
            'create_time'=>$date,
            'update_time'=>$date
        );
        $labModel=M('lab');
        $labId=$labModel->data($data)->add();
        if(!$labId){
            $this->buildResponse(10214);
        }
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
        $labId=$labModel->where("id=$labId")->save($data);
        if(!$labId){
            $this->buildResponse(10214);
        }
        $this->buildResponse(0);
    }

    public function delete(){
        $json=$this->getContent();
        $labId=$json['labId'];
        $labModel=M('lab');
        $lab=$labModel->where("id=$labId")->find();
        if(!$lab){
            $this->buildResponse(10208);
        }
        $data=array('status'=>0);
        $labId=$labModel->where("id=$labId")->save($data);
        if(!$labId){
            $this->buildResponse(10214);
        }
        $this->buildResponse(0);
    }

    public function createPhoto(){
        $json=$this->getContent();
        $labId=$json['labId'];
        $fileId=$json['fileId'];
        $model=M('lab_photo');
        $date=date('Y-m-d H:i:s',time());
        $data=array(
            'lab_id'=>$labId?$labId:0,
            'file_id'=>$fileId?$fileId:0,
            'status'=>1,
            'create_time'=>$date,
            'update_time'=>$date
        );
        $labPhotoId=$model->data($data)->add();
        if(!$labPhotoId){
            $this->buildResponse(10214);
        }
        $this->buildResponse(0,$labPhotoId);
    }

    public function deletePhoto(){
        $json=$this->getContent();
        $photoId=$json['photoId'];
        $labPhotoModel=M('lab_photo');
        $labPhoto=$labPhotoModel->where("id=$photoId")->find();
        if(!$labPhoto){
            $this->buildResponse(10217);
        }
        $data=array('status'=>0);
        $photoId=$labPhotoModel->where("id=$photoId")->save($data);
        if(!$photoId){
            $this->buildResponse(10214);
        }
        $this->buildResponse(0);
    }
}