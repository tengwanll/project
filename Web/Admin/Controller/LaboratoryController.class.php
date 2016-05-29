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
        $photoDetail=$json['photoDetail']?$json['photoDetail']:array();
        $photoDetail=json_encode($photoDetail);
        $description=$json['description'];
        $photo=$json['photo'];
        $date=date('Y-m-d H:i:s',time());
        $data=array(
            'name'=>$name?$name:'',
            'photo_detail'=>$photoDetail,
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
            $data['photo_detail']=json_encode($photoDetail);
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

}