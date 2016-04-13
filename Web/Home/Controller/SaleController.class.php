<?php
namespace Home\Controller;
use Think\Controller;
class SaleController extends Controller {
    public function index(){
        $model2=M('activity');
        $activity=$model2->where('status=1')->select();
        $this->assign('activity',$activity);
        $this->assign('root','sale');
        $this->display();
    }
}