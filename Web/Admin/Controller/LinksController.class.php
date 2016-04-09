<?php
	namespace Admin\Controller;
	use Think\Controller;

	//友情链接控制器
	class LinksController extends CommonController {
		//广告列表显示方法
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
			$link = M('links');
			//查询总数
			$count = $link->where($where)->count();
			//实例化分页类
			$Page = new \Think\Page($count,$num);
			// 实例化分页类 传入总记录数和每页显示的记录数
			$pages = $Page->show();// 分页显示输出
			// 获得limit参数
			$limit = $Page->firstRow.','.$Page->listRows;
			//查询满足条件的所有资源
			$links = $link->where($where)->limit($limit)->select();
			//分配变量
			$this->assign('links', $links);//友链
			$this->assign('pages', $pages);//页码
			$this->assign('num', $num);//每一页显示的条数
			$this->assign('keyword', $keyword);//关键字
			//解析模版
			$this->display();
		}

		//添加方法
		public function add(){
			//解析模版
			$this->display();
		}

		//执行添加方法
		public function insert(){
			//获得提交过来的分类pid
			$type = I('post.type');
			//判断,如果没选择给出提示
			if($type == '') $this->error('请选择友链的类别', U('Links/add'), 2);
			//检测提交过来的类型值,如果为文字链接
			if($type == 0){
				$_POST['img'] = '';//文字链接不用设置图片,设为空
			}else{
				//上传图像
				if($_FILES['img']['name']){//如果有图像上传
					$upload = new \Think\Upload();// 实例化上传类    
					$upload->maxSize = 3145728 ;// 设置附件上传大小    
					$upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型  
					$upload->rootPath = "./Public";//需要手动设置上传的根目录
					$upload->savePath = '/Uploads/links/'; // 设置附件上传目录
					$info = $upload->upload();//上传文件
					$_POST['img'] = $upload->rootPath.$info['img']['savepath'].$info['img']['savename'];
				}
			}
			//实例化模型
			$link = M('links');
			//创建数据
			$link->create();
			//添加数据到数据库并判断
			if($link->add()){
				//添加成功
				$this->success('友链添加成功!', U('Links/index'), 3);
			}else{
				//添加失败
				$this->error('友链添加失败!', U('Links/add'), 3);
			}
		}

		//修改方法
		public function edit(){
			//获得要修改的友链的id
			$id = I('get.id');
			//判断
			if(empty($id)) die('非法请求');
			//实例化模型
			$link = M('links');
			//查询该id的广告的详情
			$linkInfo = $link->find($id);
			//分配变量
			$this->assign('linkInfo', $linkInfo);
			//解析模版
			$this->display();
		}

		//ajax禁用方法
		public function ajaxUpdate(){
			//实例化模型
			$link = M('links');
			//创建数据
			$link->create();
			//修改数据并判断
			if($link->save()){
				//修改成功
				$this->ajaxReturn(0);
			}else{
				//修改成功
				$this->ajaxReturn(1);
			}
		}

		//友链详细修改的方法
		public function update(){
			//获得友链的id
			$id = I('post.id');
			//实例化模型
			$link = M('links');
			//查询出这个友链的信息
			$linkInfo = $link->find($id);
			//如果有文件修改
			if($_FILES['img']['name']){
				$upload = new \Think\Upload();// 实例化上传类    
				$upload->maxSize = 3145728 ;// 设置附件上传大小    
				$upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型  
				$upload->rootPath = "./Public";//需要手动设置上传的根目录
				$upload->savePath = '/Uploads/links/'; // 设置附件上传目录
				$info = $upload->upload();//上传文件
				$_POST['img'] = $upload->rootPath.$info['img']['savepath'].$info['img']['savename'];
				//上传成功删除原来的图片
				if(file_exists($linkInfo['img'])){//如果存在就删除
					unlink($linkInfo['img']);
				}
			}

			//创建数据
			$link->create();
			//修改数据并判断
			if($link->save()){
				//成功
				$this->success('友链更新成功!', U('Links/index'), 2);
			}else{
				//失败
				$this->error('友链更新失败!', U('Links/index'), 2);
			}
		}

		//删除的方法
		public function delete(){
			//获得友链的id
			$id = I('get.id');
			//判断
			if(empty($id)) die('非法操作');
			//实例化模型
			$link = M('links');
			//查询出要删除友链的图片
			$linkInfo = $link->find($id);
			//删除图片
			if(file_exists($linkInfo['img'])){
				unlink($linkInfo['img']);
			}
			//删除友链
			if($link->delete($id)){
				$this->success('友链删除成功!', U('Links/index'), 3);
			}else{
				$this->error('友链删除失败!', U('Links/index'), 3);
			}
		}


	}

?>