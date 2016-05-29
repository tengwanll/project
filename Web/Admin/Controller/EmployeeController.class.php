<?php
/**
 * Created by PhpStorm.
 * User: tengwanll
 * Date: 2016/5/1
 * Time: 11:21
 */

namespace Admin\Controller;


class EmployeeController extends CommonController
{
    public function employeeList(){
        $page=$this->getPage();
        $name=I('get.keyword');
        $employeeModel=M('employee');
        $fileModel=M('file');
        if($name){
            $where=" name like '%$name%' and status=1 ";
        }else{
            $where='status=1';
        }
        $employeeList=$employeeModel->where($where)->page($page)->select();
        $total=$employeeModel->where($where)->count();
        $arr=array();
        foreach($employeeList as $lists){
            $photoId=$lists['photo'];
            $photo=$fileModel->where("id=$photoId")->find();
            $photoUrl=$photo?__ROOT__.'/'.$photo['url']:'';
            $arr[]=array(
                'id'=>$lists['id'],
                'name'=>$lists['name'],
                'description'=>$lists['description'],
                'photo'=>$photoUrl,
                'position'=>$lists['position'],
                'telephone'=>$lists['telephone'],
                'email'=>$lists['email'],
                'study'=>$lists['study'],
                'createTime'=>$lists['create_time']
            );
        }
        $result=array(
            'list'=>$arr,
            'total'=>$total
        );
        $this->buildResponse(0,$result);
    }

    public function employeeDetail(){
        $employeeId=I('get._id');
        $employeeModel=M('employee');
        $fileModel=M('file');
        $employee=$employeeModel->where("id=$employeeId")->find();
        if(!$employee){
            $this->buildResponse(10212);
        }
        $photoId=$employee['photo'];
        $photo=$fileModel->where("id=$photoId")->find();
        $photoUrl=$photo?__ROOT__.'/'.$photo['url']:'';
        $arr=array(
            'id'=>$employee['id'],
            'name'=>$employee['name'],
            'description'=>$employee['description'],
            'photo'=>$photoUrl,
            'position'=>$employee['position'],
            'telephone'=>$employee['telephone'],
            'email'=>$employee['email'],
            'study'=>$employee['study'],
            'thesis'=>$employee['thesis'],
            'createTime'=>$employee['create_time']
        );
        $this->buildResponse(0,$arr);
    }

    public function createEmployee(){
        $json=$this->getContent();
        $name=$json['name'];
        $description=$json['description'];
        $photo=$json['photo'];
        $position=$json['position'];
        $telephone=$json['telephone'];
        $email=$json['email'];
        $study=$json['study'];
        $thesis=$json['thesis'];
        $date=date('Y-m-d H:i:s',time());
        $data=array(
            'name'=>$name?$name:'',
            'description'=>$description?$description:'',
            'photo'=>$photo?$photo:0,
            'position'=>$position?$position:'',
            'telephone'=>$telephone?$telephone:'',
            'email'=>$email?$email:'',
            'study'=>$study?$study:'',
            'thesis'=>$thesis?$thesis:'',
            'status'=>1,
            'create_time'=>$date,
            'update_time'=>$date
        );
        $employeeModel=M('employee');
        $id=$employeeModel->data($data)->add();
        if(!$id){
            $this->buildResponse(10214);
        }
        $this->buildResponse(0,$id);
    }

//    public function createThesis(){
//        $json=$this->getContent();
//        $content=$json['content'];
//        $employeeId=$json['employeeId'];
//        $date=date('Y-m-d H:i:s',time());
//        $data=array(
//            'content'=>$content?$content:'',
//            'employee_id'=>$employeeId?$employeeId:0,
//            'status'=>1,
//            'create_time'=>$date,
//            'update_time'=>$date
//        );
//        $thesisModel=M('thesis');
//        $thesisId=$thesisModel->data($data)->add();
//        if(!$thesisId){
//            $this->buildResponse(10214);
//        }
//        $this->buildResponse(0,$thesisId);
//    }
//
//    public function updateThesis(){
//        $json=$this->getContent();
//        $content=$json['content'];
//        $thesisId=$json['thesisId'];
//        $thesisModel=M('thesis');
//        $thesis=$thesisModel->where("id=$thesisId")->find();
//        if(!$thesis){
//            $this->buildResponse(10213);
//        }
//        $data=array();
//        if($content){
//            $data['content']=$content;
//        }
//        $thesisId=$thesisModel->where("id=$thesisId")->save($data);
//        if(!$thesisId){
//            $this->buildResponse(10214);
//        }
//        $this->buildResponse(0,$thesisId);
//    }

    public function updateEmployee(){
        $json=$this->getContent();
        $name=$json['name'];
        $description=$json['description'];
        $photo=$json['photo'];
        $position=$json['position'];
        $telephone=$json['telephone'];
        $email=$json['email'];
        $study=$json['study'];
        $employeeId=$json['id'];
        $thesis=$json['thesis'];
        $employeeModel=M('employee');
        $employee=$employeeModel->where("id=$employeeId")->find();
        if(!$employee){
            $this->buildResponse(10212);
        }
        $data=array();
        if($name){
            $data['name']=$name;
        }
        if($description){
            $data['description']=$description;
        }
        if($photo){
            $data['photo']=$photo;
        }
        if($position){
            $data['position']=$position;
        }
        if($telephone){
            $data['telephone']=$telephone;
        }
        if($email){
            $data['email']=$email;
        }
        if($study){
            $data['study']=$study;
        }
        if($thesis){
            $data['thesis']=$thesis;
        }
        $thesisId=$employeeModel->where("id=$employeeId")->save($data);
        if(!$thesisId){
            $this->buildResponse(10214);
        }
        $this->buildResponse(0);
    }

    public function deleteEmployee(){
        $json=$this->getContent();
        $employeeId=$json['_id'];
        $employeeModel=M('employee');
        $employee=$employeeModel->where("id=$employeeId")->find();
        if(!$employee){
            $this->buildResponse(10212);
        }
        $data=array('status'=>0);
        $thesisId=$employeeModel->where("id=$employeeId")->save($data);
        if(!$thesisId){
            $this->buildResponse(10214);
        }
        $this->buildResponse(0);
    }

//    public function deleteThesis(){
//        $json=$this->getContent();
//        $thesisId=$json['thesisId'];
//        $thesisModel=M('thesis');
//        $thesis=$thesisModel->where("id=$thesisId")->find();
//        if(!$thesis){
//            $this->buildResponse(10213);
//        }
//        $data=array('status'=>0);
//        $thesisId=$thesisModel->where("id=$thesisId")->save($data);
//        if(!$thesisId){
//            $this->buildResponse(10214);
//        }
//        $this->buildResponse(0);
//    }
}