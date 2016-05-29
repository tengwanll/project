<?php
namespace Home\Controller;
use Think\Controller;
class LaboratoryController extends Controller {
    public function index(){
        $model=M('lab');
        $fileModel=M('file');
        $labs=$model->where('status=1')->select();
        foreach($labs as $key=>$item){
            $labId=$item['id'];
            $labPhotos=json_decode($item['photo_detail'],true);
            $photoDetailUrl=array();
            foreach($labPhotos as $labPhoto){
                $photoDetail=$fileModel->where("id=$labPhoto")->find();
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