<?php
    namespace Admin\Controller;

    class AdminController extends BaseController {
        /**
         * 登录
         */
        public function login(){
            $json=$this->getContent();
        	$username=$json['username'];
            $password=$json['password'];
            $adminModel=M('admin');
            $admin=$adminModel->where("username='$username'")->find();
            if(!$admin){
                $this->buildResponse(10201);
            }
            $oldPassword=$admin['password'];
            if(md5($password)!=$oldPassword){
                $this->buildResponse(10202);
            }
            session('adminLogin',1);
            session('username',$username);
            $this->buildResponse(0);
		}

        /**
         * 注销
         */
        public function logout(){
            session('adminLogin',0);
            session('username',0);
            $this->buildResponse(0);
        }

        /**
         * 修改密码
         */
        public function update(){
            //判断登录
            $username=session('username');
            if(!$username){
                $this->buildResponse(10200);
            }
            $userModel=M('admin');
            //校验用户是否存在
            $user=$userModel->where("username='$username'")->find();
            if(!$user){
                $this->buildResponse(10201);
            }
            $userId=$user['id'];
            $json=$this->getContent();
            $oldPassword=$json['oldPassword'];
            $newPassword=$json['newPassword'];
            //验证密码
            if(md5($oldPassword)!=$user['password']){
                $this->buildResponse(10202);
            }
            $arguments=array('password'=>md5($newPassword));
            $result=$userModel->where("id=$userId")->save($arguments);
            if($result){
                $this->buildResponse(0);
            }else{
                $this->buildResponse(10203);
            }
        }

        /**
         * ajax上传图片
         */
        public function upload(){
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize=5242880 ;// 设置附件上传大小5242880
            $upload->exts=array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath = "./Public";//需要手动设置上传的根目录
            $upload->savePath='./Uploads/pics/'; // 设置附件上传目录
            $info=$upload->uploadOne($_FILES['photo']); // 上传文件
            if($info) {
                $date=date('Y-m-d H:i:s',time());
                $src=$upload->rootPath.$info['savepath'].$info['savename'];
                $fileModel=M('file');
                $data=array(
                    'url'=>$src,
                    'name'=>$info['savename'],
                    'status'=>1,
                    'create_time'=>$date,
                    'update_time'=>$date
                );
                $file=$fileModel->data($data)->add();
                if($file){
                    $this->buildResponse(0,$file);
                }else{
                    $this->buildResponse(10204);
                }
            }else{
                $this->buildResponse(10204);
            }
        }

        public function feedback(){
            $page=$this->getPage();
            $name=I('get.name');
            $feedbackModel=M('feedback');
            if($name){
                $where=" title like '%$name%' and status=1 ";
            }else{
                $where='status=1';
            }
            $feedbackList=$feedbackModel->where($where)->page($page)->select();
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
    }

    ?>