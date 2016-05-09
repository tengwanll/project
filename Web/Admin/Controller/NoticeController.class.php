<?php
/**
 * Created by PhpStorm.
 * User: tengwanll
 * Date: 2016/5/1
 * Time: 11:10
 */

namespace Admin\Controller;


class NoticeController extends CommonController
{
    public function noticeList(){
        $page=$this->getPage();
        $content=I('get.content');
        $noticeModel=M('notice');
        if($content){
            $where=" content like '%$content%' and status=1 ";
        }else{
            $where='status=1';
        }
        $noticeList=$noticeModel->where($where)->page($page)->select();
        $total=$noticeModel->where($where)->count();
        $arr=array();
        foreach($noticeList as $lists){
            $arr[]=array(
                'id'=>$lists['id'],
                'englishContent'=>$lists['english_content'],
                'content'=>$lists['content'],
                'createTime'=>$lists['create_time']
            );
        }
        $result=array(
            'noticeList'=>$arr,
            'total'=>$total
        );
        $this->buildResponse(0,$result);
    }

    public function detail(){
        $noticeId=I('get.noticeId');
        $noticeModel=M('notice');
        $notice=$noticeModel->where("id=$noticeId")->find();
        if(!$notice){
            $this->buildResponse(10211);
        }
        $arr=array(
            'id'=>$notice['id'],
            'englishContent'=>$notice['english_content'],
            'content'=>$notice['content'],
            'createTime'=>$notice['create_time']
        );
        $this->buildResponse(0,$arr);
    }

    public function create(){
        $json=$this->getContent();
        $englishContent=$json['englishContent'];
        $content=$json['content'];
        $date=date('Y-m-d H:i:s',time());
        $data=array(
            'englishContent'=>$englishContent?$englishContent:'',
            'content'=>$content?$content:'',
            'status'=>1,
            'create_time'=>$date,
            'update_time'=>$date
        );
        $noticeModel=M('notice');
        $noticeId=$noticeModel->data($data)->add();
        if(!$noticeId){
            $this->buildResponse(10214);
        }
        $this->buildResponse(0,$noticeId);
    }

    public function update(){
        $json=$this->getContent();
        $noticeId=$json['noticeId'];
        $englishContent=$json['englishContent'];
        $content=$json['content'];
        $noticeModel=M('notice');
        $notice=$noticeModel->where("id=$noticeId")->find();
        if(!$notice){
            $this->buildResponse(10211);
        }
        $data=array();
        if($englishContent){
            $data['english_content']=$englishContent;
        }
        if($content){
            $data['content']=$content;
        }
        $noticeId=$noticeModel->where("id=$noticeId")->save($data);
        if(!$noticeId){
            $this->buildResponse(10214);
        }
        $this->buildResponse(0);
    }

    public function delete(){
        $noticeId=I('post.noticeId');
        $noticeModel=M('notice');
        $notice=$noticeModel->where("id=$noticeId")->find();
        if(!$notice){
            $this->buildResponse(10211);
        }
        $data=array('status'=>0);
        $noticeId=$noticeModel->where("id=$noticeId")->save($data);
        if(!$noticeId){
            $this->buildResponse(10214);
        }
        $this->buildResponse(0);
    }
}