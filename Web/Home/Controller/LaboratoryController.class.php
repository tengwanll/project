<?php
namespace Home\Controller;
use Think\Controller;
class LaboratoryController extends Controller {
    public function index(){
        $model=M('lab');
        $fileModel=M('file');
        $labPhotoModel=M('lab_photo');
        $labs=$model->where('status=1')->select();
        foreach($labs as $key=>$item){
            $labId=$item['id'];
            $labPhotos=$labPhotoModel->where("lab_id=$labId and status=1")->select();
            $photoDetailUrl=array();
            foreach($labPhotos as $labPhoto){
                $photoDetailId=$labPhoto['file_id'];
                $photoDetail=$fileModel->where("id=$photoDetailId")->find();
                $photoDetailUrl[]=$photoDetail?__ROOT__.'/'.$photoDetail['url']:'';
            }
            $labs[$key]['photo_detail']=$photoDetailUrl;
            $photoId=$item['photo'];
            $photo=$fileModel->where("id=$photoId")->find();
            $labs[$key]['photo']=$photo?$photo['url']:'';
        }
        $this->assign('root','laboratory');
        $this->assign('labs',$labs);
        $this->display();
    }
}