<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$company=M('company');
    	$notice=$company->field('notice,english_notice')->find(1);
    	$service=M('service_sort');
    	$specialService=$service->where('type=2 and parent_id=0 and status=1')->limit('4')->select();
    	$normalService=$service->where('type=1 and parent_id=0 and status=1')->limit('4')->select();
    	$information=M('information');
    	$informations=$information->order('create_time desc')->limit('3')->select();
    	$this->assign('notice',$notice);
    	$this->assign('normalService',$normalService);
    	$this->assign('specialService',$specialService);
    	$this->assign('informations',$informations);
        $this->assign('root','index');
        $this->display();
    }
}