<?php
namespace Home\Controller;
use Think\Controller;
class AboutController extends Controller {
    public function index(){
    	$people=M('employee');
    	$employees=$people->field('id,name,photo,description')->limit('3')->select();
    	$training=M('training');
    	$trainings=$training->select();
    	$this->assign('training',$trainings);
    	$this->assign('employees',$employees);
        $this->display();
    }
}