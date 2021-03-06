<?php
namespace Home\Controller;

class AboutController extends CommonController {
    public function index(){
    	$people=M('employee');
        $fileModel=M('file');
    	$employees=$people->field('id,name,photo,description,position')->limit('3')->select();
        foreach($employees as $key=>$item){
            $photoId=$item['photo'];
            $photo=$fileModel->where("id=$photoId")->find();
            $employees[$key]['photo']=$photo?$photo['url']:'';
        }
        $companyModel=M('company');
        $company=$companyModel->find();
        $photoId=$company['photo'];
        $photo=$fileModel->where("id=$photoId")->find();
        $company['photo']=$photo?$photo['url']:'';
        $navigation=array();
        $navigation[]=array(
            'title'=>'关于我们',
            'url'=>__ROOT__.'/Home/about/index'
        );
        $this->assign('employees',$employees);
        $this->assign('company',$company);
        $this->assign('root','about');
        $this->assign('navigation',$navigation);
        $this->display();
    }

    public function employee(){
        $id=I('get.id');
        $fileModel=M('file');
        $peopleInfo=M('employee');
        $people=$peopleInfo->find($id);
        $photoId=$people['photo'];
        $photo=$fileModel->where("id=$photoId")->find();
        $people['photo']=$photo?$photo['url']:'';
        $navigation=array();
        $navigation[]=array(
            'title'=>'关于我们',
            'url'=>__ROOT__.'/Home/about/index'
        );
        $navigation[]=array(
            'title'=>'团队顾问',
            'url'=>__ROOT__.'/Home/about/employee/id/'.$id
        );
        $this->assign('people',$people);
        $this->assign('root','about');
        $this->assign('navigation',$navigation);
        $this->display();
    }
}