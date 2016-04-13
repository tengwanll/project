<?php
namespace Home\Controller;
use Think\Controller;
class JobsController extends Controller {
    public function index(){
        $job=M('job');
        $jobDemand=M('job_demand');
        $jobs=$job->where('status=1')->select();
        $arr=array();
        foreach($jobs as $item){
            $id=$item['id'];
            $demands=$jobDemand->where("job_id=$id")->select();
            $arr[$item['lab']][]=array(
                'station'=>$item['station'],
                'number'=>$item['number'],
                'demand'=>$demands,
            );
        }
        $this->assign('job',$arr);
        $this->assign('root','jobs');
        $this->display();
    }
}