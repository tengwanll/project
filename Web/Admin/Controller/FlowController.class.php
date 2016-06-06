<?php
/**
 * Created by PhpStorm.
 * User: tengwanll
 * Date: 2016/6/6
 * Time: 15:30
 */

namespace Admin\Controller;


class FlowController extends CommonController
{
    public function counts(){
        $flowModel=M('flow_count');
        $day=date('Y-m-d',time());
        $today=$flowModel->where("create_time like '$day%'")->find();
        if($today){
            $todayCount=$today['count'];
        }else{
            $todayCount=0;
        }
        $month=date('Y-m',time());
        $currentMonth=$flowModel->field("sum(count) as total")->where("create_time like '$month%'")->find();
        if($currentMonth){
            $monthCount=$currentMonth['total'];
        }else{
            $monthCount=0;
        }
        $year=date('Y',time());
        $currentYear=$flowModel->field("sum(count) as total")->where("create_time like '$year%'")->find();
        if($currentYear){
            $yearCount=$currentYear['total'];
        }else{
            $yearCount=0;
        }
        $rr=array(
            'today'=>$todayCount,
            'month'=>$monthCount,
            'year'=>$yearCount
        );
        $this->buildResponse(0,$rr);
    }

    public function lists(){
        $page=$this->getPage();
        $flowModel=M('flow_count');
        $flows=$flowModel->where("status=1")->order("create_time desc")->page($page)->select();
        $arr=array();
        foreach($flows as $flow){
            $arr[]=array(
                'id'=>$flow['id'],
                'count'=>$flow['count'],
                'create_time'=>$flow['create_time']
            );
        }
        $this->buildResponse(0,$arr);
    }
}