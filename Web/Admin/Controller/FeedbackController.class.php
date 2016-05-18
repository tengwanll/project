<?php
/**
 * Created by PhpStorm.
 * User: tengwanll
 * Date: 2016/5/18
 * Time: 14:23
 */

namespace Admin\Controller;


class FeedbackController extends CommonController
{
    /**
     * 留言
     */
    public function lists(){
        $page=$this->getPage();
        $name=I('get.name');
        $feedbackModel=M('feedback');
        if($name){
            $where=" name like '%$name%' and status=1 ";
        }else{
            $where='status=1';
        }
        $feedbackList=$feedbackModel->where($where)->page($page)->order("create_time desc")->select();
        $total=$feedbackModel->where($where)->count();
        $arr=array();
        foreach($feedbackList as $lists){
            $arr[]=array(
                'id'=>$lists['id'],
                'name'=>$lists['name'],
                'address'=>$lists['address'],
                'telephone'=>$lists['telephone'],
                'phone'=>$lists['phone'],
                'email'=>$lists['email'],
                'work'=>$lists['work'],
                'content'=>$lists['content'],
                'createTime'=>$lists['create_time']
            );
        }
        $result=array(
            'feedbackList'=>$arr,
            'total'=>$total
        );
        $this->buildResponse(0,$result);
    }

    public function delete(){
        $json=$this->getContent();
        $id=$json['feedbackId'];
        $feedbackModel=M('feedback');
        $feedback=$feedbackModel->where("id=$id")->find();
        if(!$feedback){
            $this->buildResponse(10216);
        }
        $data=array('status'=>0);
        $id=$feedbackModel->where("id=$id")->save($data);
        if(!$id){
            $this->buildResponse(10214);
        }
        $this->buildResponse(0);

    }
}