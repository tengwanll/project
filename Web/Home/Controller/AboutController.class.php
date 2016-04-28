<?php
namespace Home\Controller;
use Think\Controller;
class AboutController extends Controller {
    public function index(){
    	$people=M('employee');
    	$employees=$people->field('id,name,photo,description')->limit('3')->select();
    	$training=M('training');
        $companyModel=M('company');
        $company=$companyModel->find();
    	$trainings=$training->select();
        $navigation=array();
        $navigation[]=array(
            'title'=>'关于我们',
            'url'=>__ROOT__.'/Home/about/index'
        );
    	$this->assign('training',$trainings);
        $this->assign('employees',$employees);
        $this->assign('company',$company);
        $this->assign('root','about');
        $this->assign('navigation',$navigation);
        $this->display();
    }

    public function employee(){
        $id=I('get.id');
        $peopleInfo=M('employee');
        $people=$peopleInfo->find($id);
        $thesis=M('thesis');
        $result=$thesis->field('content')->where("employee_id=$id and status=1")->select();
        $navigation=array();
        $navigation[]=array(
            'title'=>'关于我们',
            'url'=>__ROOT__.'/Home/about/index'
        );
        $navigation[]=array(
            'title'=>'团队顾问',
            'url'=>__ROOT__.'/Home/about/employee/id/'.$id
        );
        $this->assign('thesis',$result);
        $this->assign('people',$people);
        $this->assign('root','about');
        $this->assign('navigation',$navigation);
        $this->display();
    }
}