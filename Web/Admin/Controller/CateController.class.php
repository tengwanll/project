<?php
namespace Admin\Controller;
use Think\Controller;
header('content-type:text/html;charset=utf-8');

//分类控制器
class CateController extends CommonController {


	//分类页面主页面
	public function index(){

		//实例化模板
		$sort = M('sort');

		//获取用户要搜索的关键字
		$keywords = I('get.keywords');

		$where = '';

		//获取要显示的信息条数
		$num = I('get.num');

		$num = empty($num) ? '5' : $num;



		//如果关键字存在,并且成功
		if($keywords){

			//模糊查询
			$where = "name like '%$keywords%'";

		}

		//获取数据库中的总数
		$count = $sort->where($where)->count();

		//实例化分页类
        $Page = new \Think\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数(25)

        $pages = $Page->show();

        //获取limit参数
        $limit = $Page->firstRow.','.$Page->listRows;

        //获取所有的字段
		$sorts = $sort->field('id,sid,name,path,concat(path,"-",id) as paths')->order('paths')->where($where)->limit($limit)->select();

		foreach($sorts as $k=>$v){

			//获取层级(explode — 使用一个字符串分割另一个字符串)
			$num1 = count(explode('-',$v['paths']))-1;

			//如果是顶级元素,我们就直接输出,不加|----
			if($v['sid']== 0){

				$sorts[$k]['name'] = $v['name'];

			}else{//如果不是顶级元素,我们根据等级加上|----

				//根据层级加|----(str_repeat — 重复一个字符串)
				$sorts[$k]['name'] = str_repeat('|----',$num1).$v['name'];
			}

		}
                                    
		//分配变量
		$this->assign('sorts',$sorts);

		$this->assign('pages',$pages);



		$this->assign('num',$num);

		$this->assign('keywords',$keywords);

		$this->display();


	}

	//分类的添加页面
	public function add(){

		//实例化对象
		$sort = M('sort');

		//获取所有的字段
		$sorts = $sort->field('id,sid,name,path,concat(path,"-",id) as paths')->order('paths')->where("sid=0")->select();

		$this->assign('sorts',$sorts);

		//解析模板
		$this->display();
	}

	//分类的数据库插入
	public function insert(){

		$sid = $_POST['sid'];

		$sort = M('sort');


		$name = $_POST['name'];
		
		//判断是否是顶级分类
		if($_POST['sid'] == 0){

			//如果是顶级分类,我们让path为0(因为他是顶级分类的标志)
			$_POST['path']= '0';

		}else{//如果不是顶级

			$sid = $_POST['sid'];

			//根据条件查询添加分类的父类的信息
			$parentInfo = $sort->where("id=$sid")->find();

			//连接父类的path和id,使其等于添加的分类的path
			$_POST['path'] = $parentInfo['path'].'-'.$parentInfo['id'];
			}

		//在tp中使用该方法,add方法就不需要传数组了
		$sort->create();

		//如果是顶级元素,我们先将数据插入数据库,并且指定path为0,然后我们需要根据你填写的分类名,查询你插入的id,然后再根据id,将path与id连接起来,以便于分类列表根据path-id进行排序

		if($sort->add()){

			//如果成功,就跳转首页
			$this->success('添加成功',U('Admin/Cate/index'),3);

		}else{

			//如果失败,就也跳转到首页
			$this->error('添加失败',U('Admin/Cate/index'),3);
		}
	}


	//数据库的删除
	public function delete(){

		//获取传过来的id
		$id = I('get.id');

		//实例化对象
		$sort = M('sort');

		//如果成功
		if($sort->delete($id)){

			$this->success('删除成功',U('Admin/Cate/index'),3);

		}else{  //如果失败

			$this->error('删除失败',U('Admin/Cate/index'),3);
		}
	}

	//分类修改页面
	public function edit(){

		$id = I('get.id');

		if(empty($id)) $this->error('非法请求');

		$sort = M('sort');

		//获取单条信息
		$sorts = $sort->find($id);


		if($sorts['sid'] == '0'){

			$sortName = '顶级分类';

		}else{//如果不是顶级分类,我们把它的父类的名字查出来

			$sortName = $sort->where("id = {$sorts['sid']}")->find()['name'];
		}

		//分配变量
		$this->assign('sorts',$sorts);

		$this->assign('sortName',$sortName);

		//解析模板
		$this->display();

	}

	//数据库的更新
	public function update(){

		$sort = M('sort');
		
		$sort->create();

		if($sort->save()){

			$this->success('更新成功',U('Admin/Cate/index'),3);

		}else{

			$this->success('更新失败',U('Admin/Cate/index'),3);

		}

	}

	//获取ajax
	public function ajaxUpdate(){

		$sort = M('sort');

		$sort->create();

		if($sort->save()){

			$this->ajaxReturn('0');
		}else{

			$this->ajaxReturn('1');

		}

	}
}

?>