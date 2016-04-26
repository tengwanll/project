<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$noticeModel=M('notice');
    	$notice=$noticeModel->order('create_time desc')->find(1);
    	$service=M('service_sort');
        $activityModel=M('activity');
        $activity=$activityModel->where('status=1')->limit(3)->select();
    	$specialService=$service->where('type=2 and parent_id=0 and status=1')->limit('4')->select();
    	$normalService=$service->where('type=1 and parent_id=0 and status=1')->limit('4')->select();
    	$information=M('news');
    	$informations=$information->order('create_time desc')->limit('3')->select();
    	$this->assign('notice',$notice);
    	$this->assign('normalService',$normalService);
    	$this->assign('specialService',$specialService);
    	$this->assign('informations',$informations);
        $this->assign('activity',$activity);
        $this->assign('root','index');
        $this->display();
    }

    // 搜索界面
    public function search () {
        $title=I('post.title');
        $serviceModel=M('service,service_sort');
        $where=' service.sort_id=service_sort.id ';
        if($title){
            $where.=" and service.title like '%$title%' ";
        }
        $service=$serviceModel->field('service.title,service.short_desc,service.logo,service_sort.type,service.id')->where($where)->select();
        $this->assign('service',$service);
        $this->assign('root','index');
        $this -> display();
    }
}