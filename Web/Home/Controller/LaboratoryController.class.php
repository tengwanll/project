<?php
namespace Home\Controller;
use Think\Controller;
class LaboratoryController extends Controller {
    public function index(){
        $model=M('lab');
        $fileModel=M('file');
        $labs=$model->where('status=1')->select();
        foreach($labs as $key=>$item){
            $photoId=$item['photo'];
            $photo=$fileModel->where("id=$photoId")->find();
            $labs[$key]['photo']=$photo?$photo['url']:'';
        }
        $this->assign('root','laboratory');
        $this->assign('labs',$labs);
        $this->display();
    }
}