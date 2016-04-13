<?php
namespace Home\Controller;
use Think\Controller;
class LaboratoryController extends Controller {
    public function index(){
        $model=M('lab');
        $labs=$model->where('status=1')->select();
        $this->assign('root','laboratory');
        $this->assign('labs',$labs);
        $this->display();
    }
}