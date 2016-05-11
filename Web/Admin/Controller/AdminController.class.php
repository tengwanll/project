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
            $upload->savePath='/Uploads/pics/'; // 设置附件上传目录
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

        public function company(){
            $companyModel=M('company');
            $fileModel=M('file');
            $company=$companyModel->where("id=1")->find();
            $photoId=$company['photo'];
            $photo=$fileModel->where("id=$photoId")->find();
            $photoUrl=$photo?__ROOT__.'/'.$photo['url']:'';
            $arr=array(
                'name'=>$company['name'],
                'information'=>$company['information'],
                'photo'=>$photoUrl
            );
            $this->buildResponse(0,$arr);
        }

        public function updateCompany(){
            $json=$this->getContent();
            $name=$json['name'];
            $information=$json['information'];
            $photo=$json['photo'];
            $companyModel=M('company');
            $data=array();
            if($name){
                $data['name']=$name;
            }
            if($information){
                $data['information']=$information;
            }
            if($photo){
                $data['photo']=$photo;
            }
            $id=$companyModel->where("id=1")->save($data);
            if(!$id){
                $this->buildResponse(10214);
            }
            $this->buildResponse(0);
        }

        public function cutPhoto(){
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize=5242880 ;// 设置附件上传大小5242880
            $upload->exts=array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath = "./Public";//需要手动设置上传的根目录
            $upload->savePath='/Uploads/pics/'; // 设置附件上传目录
            $info=$upload->uploadOne($_FILES['photo']); // 上传文件
            if($info) {
                $src=$upload->rootPath.$info['savepath'].$info['savename'];
                $jpeg_quality = 90;
                $photos=getimagesize($src);//获取图片大小
                $src_height=$photos[1];
                $src_weight=$photos[0];
                $path=pathinfo($src);
                $path=$path['extension'];
                if($path=='jpeg'||$path=='jpg'){
                    $img_r = imagecreatefromjpeg($src);
                }
                if($path=='png'){
                    $img_r=imagecreatefrompng($src);
                }
                if($path=='gif'){
                    $img_r=imagecreatefromgif($src);
                }
                if($path=='bmp'||$path=='wbmp'){
                    $img_r=imagecreatefromwbmp($src);
                }
                $dst_r = ImageCreateTrueColor( $src_weight, $src_weight/2 );//创建一个新图
                imagecopyresampled($dst_r,$img_r,0,0,0,0,$src_weight,$src_height,$src_weight,$src_height);//最后四个变量设置缩放比例
                header('Content-type: image/jpeg');//设置格式
                $photo=imagejpeg($dst_r,'./Public/Uploads/pics/test/'.$info['savename'], $jpeg_quality);//输出图像
                if($photo){
                    $this->buildResponse(0);
                }
            }else{
                $this->buildResponse(10204);
            }
        }
    }

    ?>