<?php
namespace Admin\Controller;
use Think\Controller;
class MessageController extends CommonController {

	public function index(){
		//获取每页显示的数据数量
		$num = I('get.dataNum');
		//判断
		$num = !empty($num) ? $num : 10;
		//获得用户提交的每页显示的条数和搜索的关键字
		$keyword = I('get.keyword');
		$dataNum = !empty($dataNum) ? $dataNum : 10;
		//根据判断给出条件
		//声明条件字符串
		$where = '';
		if(!empty($keyword)){
			$where = "email like '%{$keyword}%' and ";
		}
		//关联查询reply与user与source
		// $sql = "select reply.content,user.email from user,reply where reply.uid=user.id";
		$model = M('reply,user,source');

		// var_dump($reply);die;
		//获取总的记录条数
		$count = $model->where($where.'reply.uid=user.id and reply.rid=source.id')->count();
		//实例化分页类
		$page = new \Think\Page($count, $num);
		//获取页码字符串
		$pages = $page->show();
		$limit = $page->firstRow.','.$page->listRows;

		//获取limit参数字符串
		$replys = $model->limit($limit)->field("reply.*,user.email,source.name,concat(reply.path,'-',reply.id) as paths")->where($where.'reply.uid=user.id and reply.rid=source.id')->select();
		// var_dump($replys);die;
		foreach($replys as $k=>$v){
			//获取层级
			$num = count(explode('-', $v['path']))-1;
			//调整name的标识
			$replys[$k]['name'] = str_repeat('----|', $num).$v['name'];
		}
		
		//分配变量
		$this->assign('num', $num);
		$this->assign('pages', $pages);
		$this->assign('replys',$replys);
		$this->assign('keyword',$keyword);
		//解析模板
		$this->display();
	}


	//用户的删除操作
	public function delete(){
		//获得用户的id
		$id = I('get.id');
		//判断
		if(empty($id)){
			die('非法操作');
		}
		//实例化模型
		$reply = M('reply');
		//删除
		if($reply->delete($id)){
			//成功
			$this->success('删除成功' , U('Message/index', 3));
		}else{
			//删除失败
			$this->error('删除失败', U('Message/index', 3));
		}
	}

	
}