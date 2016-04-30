<?php
/**
 * Created by PhpStorm.
 * User: tengwanll
 * Date: 2016/4/30
 * Time: 22:54
 */

namespace Admin\Controller;


class JobsController extends CommonController
{
    public function lists(){
        $page=$this->getPage();
        $lab=I('get.lab');
        $jobModel=M('job');
        if($lab){
            $where=" title like '%$lab%' and status=1 ";
        }else{
            $where='status=1';
        }
        $jobDemandModel=M('job_demand');
        $jobList=$jobModel->where($where)->page($page)->select();
        $total=$jobModel->where($where)->count();
        $arr=array();
        foreach($jobList as $lists){
            $id=$lists['id'];
            $jobDemand=$jobDemandModel->where("job_id=$id")->select();
            $demandArray=array();
            foreach($jobDemand as $demands){
                $demandArray[]=array(
                    'id'=>$demands['id'],
                    'demandContent'=>$demands['content']
                );
            }
            $arr[]=array(
                'id'=>$id,
                'lab'=>$lists['lab'],
                'station'=>$lists['station'],
                'number'=>$lists['number'],
                'jobDemand'=>$demandArray,
                'createTime'=>$lists['create_time']
            );
        }
        $result=array(
            'jobList'=>$arr,
            'total'=>$total
        );
        $this->buildResponse(0,$result);
    }

    public function create(){
        $json=$this->getContent();
        $lab=$json['lab'];
        $station=$json['station'];
        $number=$json['number'];
        $date=date('Y-m-d H:i:s',time());
        $data=array(
            'lab'=>$lab?$lab:'',
            'station'=>$station?$station:'',
            'number'=>$number?$number:'',
            'status'=>1,
            'create_time'=>$date,
            'update_time'=>$date
        );
        $jobModel=M('job');
        $jobId=$jobModel->data($data)->add();
        $this->buildResponse(0,$jobId);
    }

    public function update(){
        $json=$this->getContent();
        $jobId=$json['jobId'];
        $lab=$json['lab'];
        $station=$json['station'];
        $number=$json['number'];
        $jobModel=M('job');
        $job=$jobModel->where("id=$jobId")->find();
        if(!$job){
            $this->buildResponse(10210);
        }
        $data=array();
        if($lab){
            $data['lab']=$lab;
        }
        if($station){
            $data['station']=$station;
        }
        if($number){
            $data['number']=$number;
        }
        $jobModel->where("id=$jobId")->save($data);
        $this->buildResponse(0);
    }

    public function delete(){
        $jobId=I('get.jobId');
        $jobModel=M('job');
        $job=$jobModel->where("id=$jobId")->find();
        if(!$job){
            $this->buildResponse(10210);
        }
        $data=array('status'=>0);
        $jobModel->where("id=$jobId")->save($data);
        $this->buildResponse(0);
    }
}