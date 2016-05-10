<?php
namespace Home\Controller;
use Think\Controller;
class SaleController extends Controller {
    public function index(){
        $page=I('get.page');
        $rows=I('get.rows');
        if($page&&$rows){
            $pagePart=$page.','.$rows;
        }else{
            $pagePart='1,10';
        }
        $model2=M('activity');
        $fileModel=M('file');
        $activity=$model2->where('status=1')->page($pagePart)->select();
        foreach($activity as $key=>$item){
            $photoId=$item['photo'];
            $photo=$fileModel->where("id=$photoId")->find();
            $activity[$key]['photo']=$photo?$photo['url']:'';
        }
        $navigation=array();
        $navigation[]=array(
            'title'=>'促销活动',
            'url'=>__ROOT__.'/Home/sale/index'
        );
        $this->assign('navigation',$navigation);
        $this->assign('activity',$activity);
        $this->assign('root','sale');
        $this->display();
    }
}