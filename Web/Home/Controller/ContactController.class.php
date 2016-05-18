<?php
namespace Home\Controller;
use Think\Controller;
class ContactController extends Controller {
    public function index(){
        $this->assign('root','contact');
        $this->display();
    }

    // 在线留言界面
    public function message() {
        $this->assign('root','message');
        $this -> display();
    }

    // 招聘界面
    public function jobs () {
        $job=M('job');
        $jobDemand=M('job_demand');
        $jobs=$job->where('status=1')->select();
        $arr=array();
        foreach($jobs as $item){
            $id=$item['id'];
            $demand=$item['demand'];
            $demand=$demand?explode('||',$demand):array();
            $arr[$item['lab']][]=array(
                'station'=>$item['station'],
                'number'=>$item['number'],
                'demand'=>$demand,
            );
        }
        $this->assign('job',$arr);
        $this->assign('root','jobs');
        $this->display();
    }

    /**
     * 留言
     */
    public function add(){
    	$data['name']=I('post.name');
    	$data['address']=I('post.address');
    	$data['telephone']=I('post.telephone');
    	$data['work']=I('post.work');
    	$data['email']=I('post.email');
    	$data['content']=I('post.content');
    	
    	$date=date('Y-m-d H:i:s',time());
    	$data['status']=1;
    	$data['create_time']=$date;
    	$data['update_time']=$date;
    	$feedback=M('feedback');
    	if($feedback->data($data)->add()){
            $response=array(
                'errno'=>0,
                'ermsg'=>'',
            );
            $this->ajaxReturn($response);
		}else{
			//添加失败
            $response=array(
                'errno'=>10215,
                'ermsg'=>'添加反馈失败',
            );
            $this->ajaxReturn($response);
		}
    }
}