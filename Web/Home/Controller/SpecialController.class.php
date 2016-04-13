<?php
namespace Home\Controller;
use Think\Controller;
class SpecialController extends Controller {
    public function index(){
        $model=M('service_sort');
        $this->assign('root','special');
        $this->display();
    }
}