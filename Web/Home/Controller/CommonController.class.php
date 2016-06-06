<?php
namespace Home\Controller;

use Think\Controller;

class CommonController extends Controller {

	//当前类自动执行的一个方法
	public function _initialize(){
//        $ipAddr = $_SERVER['HTTP_X_REAL_IP'];
//        if (!$ipAddr) {
//            $ipAddr = $_SERVER['HTTP_X_FORWARDED_FOR'];
//        }
//        if (!$ipAddr) {
//            $ipAddr =$_SERVER['REMOTE_ADDR'];
//        }
        $day=date('Y-m-d',time());
        if(!cookie('ip')||cookie('ip')!=$day){
            $flowModel=M('flow_count');
            $log=$flowModel->where("create_time like '$day%'")->find();
            if($log){
                $id=$log['id'];
                $count=$log['count'];
                $data=array(
                    'count'=>++$count
                );
                $flowModel->where("id=$id")->save($data);
            }else{
                $date=date('Y-m-d H:i:s',time());
                $data=array(
                    'count'=>1,
                    'status'=>1,
                    'create_time'=>$date,
                    'update_time'=>$date
                );
                $flowModel->data($data)->add();
            }
            cookie('ip',$day,86400);
        }
	}
	
}