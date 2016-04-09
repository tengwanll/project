<?php
namespace Admin\Controller;
use Think\Controller;
//商品管理控制器
class SourcesController extends CommonController {
	//商品添加表单
	public function add(){
		//实例化模型
		$sort = M('sort');
		//查询出所有的顶级分类
		$firstSort = $sort->where("path = '0'")->select();
		//分配变量
		$this->assign("firstSort", $firstSort);
		//获取上传文件控件需要的参数
		$timestamp = time();
		$token = md5('unique_salt' . $timestamp);
		$this->assign('timestamp' , $timestamp);
		$this->assign('token' , $token);
		//解析模版
		$this->display();
	}

	//使用ajax根据顶级分类查询二级分类
	public function ajaxR(){
		//获得顶级分类的id
		$sid = I('post.sid');
		//实例化模型
		$sort = M('sort');
		//查询出该分类下面所有的子分类
		$secondSort = $sort->where("sid = {$sid}")->select();
		//返回数组
		$this->ajaxReturn($secondSort);
	}

	//资源添加方法
	public function insert(){
		//设置上传资源的父级分类id
		$_POST['pid'] = I('post.secondSort');
		//实例化分类模型
		$sort = M('sort');
		//根据资源的顶级分类得到它的类别
		$_POST['kind'] = $sort->find(I('post.firstSort'))['name'];
		//uid可以根据session中的id存入

		//删除掉没用的file_upload变量
		unset($_FILES['file_upload']);
		//上传视频海报小图和大图
		if($_FILES['pic']['name'] || $_FILES['promote']['name']){//如果上传了大图或者小图
			$upload = new \Think\Upload();// 实例化上传类    
			$upload->maxSize = 3145728 ;// 设置附件上传大小    
			$upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型  
			$upload->rootPath = "./Public";//需要手动设置上传的根目录
			$upload->savePath = '/Uploads/pics/'; // 设置附件上传目录
			$info = $upload->upload();//上传文件
			//循环遍历拼接图片的路径
			foreach($info as $k=>$v){
				//将路径写入到$_POST数组中
				$_POST[$k] = $upload->rootPath.$info[$k]['savepath'].$info[$k]['savename'];
			}
		}
		//设置上传的时间
		$_POST['date'] = time();
		//实例化资源模型
		$source = M('source');
		//创建
		$source->create();
		//添加
		if($source->save()){
			$this->success('资源添加成功!', U('Sources/index'), 3);
		}else{
			$this->error('资源添加失败!', U('Sources/index'), 3);
		}
	}

	//资源列表显示方法
	public function index(){
		//获得每一页显示的条数 默认5条
		$num = I('get.num');
		$num = !empty($num) ? $num : 5;
		//声明一个条件字符串
		$where = '';
		//获得搜索的关键字
		$keyword = I('get.keyword');
		//判断
		if($keyword){//如果不为空
			$where['name'] = array('like', '%'.$keyword.'%');
		}
		//实例化模型
		$source = M('source');
		//查询总数
		$count = $source->where($where)->count();
		//实例化分页类
		$Page = new \Think\Page($count,$num);
		// 实例化分页类 传入总记录数和每页显示的记录数
		$pages = $Page->show();// 分页显示输出
		// 获得limit参数
		$limit = $Page->firstRow.','.$Page->listRows;
		//查询满足条件的所有资源
		$sources = $source->where($where)->limit($limit)->select();
		//分配变量
		$this->assign('sources', $sources);//资源
		$this->assign('pages', $pages);//页码
		$this->assign('num', $num);//每一页显示的条数
		$this->assign('keyword', $keyword);//关键字
		//解析模版
		$this->display();
	}

	//资源修改的方法
	public function edit(){
		//获得id
		$id = I('get.id');
		//判断
		if(empty($id)) die('非法请求');
		//实例化模型
		$source = M('source');
		//查询
		$sourceInfo = $source->find($id);
		//实例化模型
		$sort = M('sort');
		$sortName = $sort->find($sourceInfo['pid'])['name'];
		//分配变量
		$this->assign('sourceInfo', $sourceInfo);
		$this->assign('sortName', $sortName);
		//解析模版
		$this->display();
	}

	//资源修改的方法
	public function update(){
		//获得资源的id
		$id = I('post.id');
		//实例化资源模型
		$source = M('source');
		//查询出该资源的信息
		$sourceInfo = $source->find($id);
		//修改上传视频海报
		if($_FILES['pic']['name'] || $_FILES['promote']['name']){//如果修改了大图或者小图
			
			$upload = new \Think\Upload();// 实例化上传类    
			$upload->maxSize = 3145728 ;// 设置附件上传大小    
			$upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型  
			$upload->rootPath = "./Public";//需要手动设置上传的根目录
			$upload->savePath = '/Uploads/pics/'; // 设置附件上传目录
			$info = $upload->upload();//上传文件
			//循环变量拼接图片的路径
			foreach($info as $k=>$v){
				//将路径写入到$_POST数组中
				$_POST[$k] = $upload->rootPath.$info[$k]['savepath'].$info[$k]['savename'];
				//如果修改先把之前的图片删掉,有这个文件就删除
				if(file_exists($sourceInfo[$k])){
					unlink($sourceInfo[$k]);//删除之前上传的文件
				}
			}
		}
		
		//创建数组
		$source->create();
		//添加数组
		if($source->save()){
			$this->success('资源修改成功!', U('Sources/index'), 3);
		}else{
			$this->error('资源修改失败!', U('Sources/index'), 3);
		}
	}

	//删除操作
	public function delete(){
		//获得资源的id
		$id = I('get.id');
		//判断
		if(empty($id)) die('非法操作');
		//实例化模型
		$source = M('source');
		//查询出要删除资源的图片和视频删除
		$sourceInfo = $source->find($id);
		//删除图片
		if(file_exists($sourceInfo['pic'])){
			unlink($sourceInfo['pic']);
		}
		//删除大图
		if(file_exists($sourceInfo['promote'])){
			unlink($sourceInfo['promote']);
		}
		//删除视频
		if(unlink($sourceInfo['address'])){
			unlink($sourceInfo['address']);
		}
		//删除
		if($source->delete($id)){
			$this->success('资源删除成功!', U('Sources/index'), 3);
		}else{
			$this->error('资源删除失败!', U('Sources/index'), 3);
		}
	}

	//ajax启用禁用方法
	public function ajaxUpdate(){
		//获得要修改的资源的id
		$id = $_POST['id'];
		//获得要修改的状态值
		$status = $_POST['status'];
		//实例化模型
		$source = M('source');
		//创建
		$source->create();
		//判断
		if($source->save()){//修改成功
			$this->ajaxReturn(0);
		}else{//修改失败
			$this->ajaxReturn(1);
		}
	}

	//上传控件ajax处理方法
	public function uploadifive(){
		// Set the uplaod directory
		$uploadDir = './Public/Uploads/videos/';

		// Set the allowed file extensions
		$fileTypes = array('webm', 'ogg', 'mp4', 'flv'); // Allowed file extensions

		$verifyToken = md5('unique_salt' . $_POST['timestamp']);

		if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
			$tempFile   = $_FILES['Filedata']['tmp_name'];
			$uploadDir  = $uploadDir;
			//获得后缀名
			$type = pathinfo($_FILES['Filedata']['name'], PATHINFO_EXTENSION);
			//得到目标文件名
			$targetFile = $uploadDir . md5(uniqid()) . '.' . $type;

			// Validate the filetype
			$fileParts = pathinfo($_FILES['Filedata']['name']);
			if (in_array(strtolower($fileParts['extension']), $fileTypes)) {

				//上传文件
				move_uploaded_file($tempFile, $targetFile);
				//将文件视频的路径添加到数据库
				//实例化模型
				$source = M('source');
				//清空$_POST
				$_POST = array();
				//将视频的地址存放到$_POST中
				$_POST['address'] = $targetFile;
				//插入并判断,返回id
				$source->create();//创建数据
				$id = $source->add();//插入
				//判断
				if($id){//如果插入成功
					echo $id;//返回插入的id
				}else{//如果不成功
					echo 0;
				}
			} else {
				
				//上传失败
				echo 0;

			}
		}
	}

	//上传文件夹检测方法
	public function checkExists(){

		// 定义上传文件的存放路径
		$targetFolder = './Public/Uploads/videos'; // Relative to the root and should match the upload folder in the uploader script

		if (file_exists($_SERVER['DOCUMENT_ROOT'] . $targetFolder . '/' . $_POST['filename'])) {
			//文件夹存在
			echo 1;
		} else {
			//文件夹不存在
			echo 0;
		}
	}


}

?>