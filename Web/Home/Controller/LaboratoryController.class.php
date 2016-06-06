<?php
namespace Home\Controller;
class LaboratoryController extends CommonController {
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

    public function lists(){
        $page=I('get.page')?I('get.page'):1;
        $rows=I('get.rows')?I('get.rows'):9;
        $pagePart=$page.','.$rows;
        $labModel=M('lab');
        $fileModel=M('file');
        $where='status=1';
        $labList=$labModel->where($where)->page($pagePart)->select();
        $total=$labModel->where($where)->count();
        $arr=array();
        foreach($labList as $lists){
            $photoId=$lists['photo'];
            $photo=$fileModel->where("id=$photoId")->find();
            $photoUrl=$photo?__ROOT__.'/'.$photo['url']:'';
            $photoDetailUrl=array();
            $labPhotos=json_decode($lists['photo_detail'],true);
            foreach($labPhotos as $labPhoto){
                $photoDetail=$fileModel->where("id=$labPhoto")->find();
                $photoDetailUrl[]=$photoDetail?__ROOT__.'/'.$photoDetail['url']:'';
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
            'total'=>$total,
            'page'=>$page
        );
        $response=array(
            'errno'=>0,
            'ermsg'=>'',
        );
        if($result){
            $response['result']=$result;
        }
        $this->ajaxReturn($response);
    }
}