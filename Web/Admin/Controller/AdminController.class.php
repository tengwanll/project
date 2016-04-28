<?php
    namespace Admin\Controller;

    class AdminController extends BaseController {

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
            $this->buildResponse(0);
		}
    }

    ?>