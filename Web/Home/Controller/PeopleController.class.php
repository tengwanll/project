<?php
namespace Home\Controller;
use Think\Controller;
class PeopleController extends Controller {
    public function index(){
    	$id=I('get.id');
    	$peopleInfo=M('employee');
    	$people=$peopleInfo->find($id);
    	$thesis=M('thesis');
    	$result=$thesis->field('content')->where("employee_id=$id and status=1")->select();
    	$this->assign('thesis',$result);
    	$this->assign('people',$people);
        $this->display();
    }
}