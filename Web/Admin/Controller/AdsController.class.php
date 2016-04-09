<?php
	namespace Admin\Controller;
	use Think\Controller;

	//广告控制器
	class AdsController extends CommonController {

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
			$ads = M('ads');
			//查询总数
			$count = $ads->where($where)->count();
			//实例化分页类
			$Page = new \Think\Page($count,$num);
			// 实例化分页类 传入总记录数和每页显示的记录数
			$pages = $Page->show();// 分页显示输出
			// 获得limit参数
			$limit = $Page->firstRow.','.$Page->listRows;
			//查询满足条件的所有资源
			$adses = $ads->field("*,concat(path,'-',id) as paths")->where($where)->order("paths")->limit($limit)->select();
			//循环遍历查询出来的数据,给名称加上显示出层级关系的标志
			foreach($adses as $k=>$v){
				//判断,如果是子类,也就是广告
				if($v['pid'] != '0'){
					$adses[$k]['name'] = '-------|'.$v['name'];
				}
			}
			//分配变量
			$this->assign('adses', $adses);//资源
			$this->assign('pages', $pages);//页码
			$this->assign('num', $num);//每一页显示的条数
			$this->assign('keyword', $keyword);//关键字
			//解析模版
			$this->display();
		}

		//添加方法
		public function add(){
			//实例化模型
			$ads = M('ads');
			//查询所有的顶级分类
			$adsTop = $ads->where(array('pid'=>array('EQ', '0')))->select();
			//分配变量
			$this->assign('adsTop', $adsTop);
			//解析模版
			$this->display();
		}

		//执行添加方法
		public function insert(){
			//获得提交过来的分类pid
			$pid = I('post.pid');
			//判断,如果没选择给出提示
			if($pid == '') $this->error('请选择广告所属分类', U('Ads/add'), 3);
			//检测提交过来的pid,如果为顶级分类
			if($pid == 0){
				$_POST['path'] = '0';//设置path路径为'0'
				$_POST['img'] = '';//顶级分类不用设置图片,设为空
			}else{
				$_POST['path'] = '0-'.$pid;//设置path路径
				//上传图像
				if($_FILES['img']['name']){//如果有图像上传
					$upload = new \Think\Upload();// 实例化上传类    
					$upload->maxSize = 3145728 ;// 设置附件上传大小    
					$upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型  
					$upload->rootPath = "./Public";//需要手动设置上传的根目录
					$upload->savePath = '/Uploads/ads/'; // 设置附件上传目录
					$info = $upload->upload();//上传文件
					$_POST['img'] = $upload->rootPath.$info['img']['savepath'].$info['img']['savename'];
				}
			}
			//实例化模型
			$ads = M('ads');
			//创建数据
			$ads->create();
			//添加数据到数据库并判断
			if($ads->add()){
				//添加成功
				$this->success('广告添加成功!', U('Ads/index'), 3);
			}else{
				//添加失败
				$this->error('广告添加失败!', U('Ads/add'), 3);
			}
		}

		//修改方法
		public function edit(){
			//获得要修改的广告的id
			$id = I('get.id');
			//判断
			if(empty($id)) die('非法请求');
			//实例化模型
			$ad = M('ads');
			//查询该id的广告的详情
			$adInfo = $ad->find($id);
			//分配变量
			$this->assign('adInfo', $adInfo);
			//解析模版
			$this->display();
		}

		//ajax禁用方法
		public function ajaxUpdate(){
			//实例化模型
			$ads = M('ads');
			//创建数据
			$ads->create();
			//修改数据并判断
			if($ads->save()){
				//修改成功
				$this->ajaxReturn(0);
			}else{
				//修改成功
				$this->ajaxReturn(1);
			}
		}

		//广告详细修改的方法
		public function update(){
			//获得广告的id
			$id = I('post.id');
			//实例化模型
			$ad = M('ads');
			//查询出这个广告的信息
			$adInfo = $ad->find($id);
			//如果有文件修改
			if($_FILES['img']['name']){
				$upload = new \Think\Upload();// 实例化上传类    
				$upload->maxSize = 3145728 ;// 设置附件上传大小    
				$upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型  
				$upload->rootPath = "./Public";//需要手动设置上传的根目录
				$upload->savePath = '/Uploads/ads/'; // 设置附件上传目录
				$info = $upload->upload();//上传文件
				$_POST['img'] = $upload->rootPath.$info['img']['savepath'].$info['img']['savename'];
				//上传成功删除原来的图片
				if(file_exists($adInfo['img'])){//如果存在就删除
					unlink($adInfo['img']);
				}
			}

			//创建数据
			$ad->create();
			//修改数据并判断
			if($ad->save()){
				//成功
				$this->success('广告更新成功!', U('Ads/index'), 3);
			}else{
				//失败
				$this->error('广告更新失败!', U('Ads/index'), 3);
			}
		}

		//删除的方法
		public function delete(){
			//获得资源的id
			$id = I('get.id');
			//判断
			if(empty($id)) die('非法操作');
			//实例化模型
			$ad = M('ads');
			//查询出要删除资源的图片和视频删除
			$adInfo = $ad->find($id);
			//删除图片
			if(file_exists($adInfo['img'])){
				unlink($adInfo['img']);
			}
			//删除
			if($ad->delete($id)){
				$this->success('广告删除成功!', U('Ads/index'), 3);
			}else{
				$this->error('广告删除失败!', U('Ads/index'), 3);
			}
		}
	}

?>