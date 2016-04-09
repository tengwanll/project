<?php
namespace Home\Controller;
use Think\Controller;
class FeedbackController extends Controller {
    public function index(){
        $this->display();
    }

    public function addFeedback(){
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
			//添加成功
			$this->success('留言添加成功!', U('feedback/index'), 3);
		}else{
			//添加失败
			$this->error('留言添加失败!', U('feedback/index'), 3);
		}
    }
}