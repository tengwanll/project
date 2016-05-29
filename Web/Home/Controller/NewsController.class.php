<?php
namespace Home\Controller;
use Think\Controller;
class NewsController extends Controller {
    public function index(){
        $rows=I('get.rows')?I('get.rows'):5;
        $model=M('news');
        $noticeModel=M('notice');
        $fileModel=M('file');
        $notice=$noticeModel->where('status=1')->order('create_time desc')->limit(5)->select();
        foreach($notice as $key=>$value){
            $notice[$key]['create_time']=date('Y-m-d',strtotime($value['create_time']));
        }
        //获取数据库中的总数
        $count = $model->where('status=1')->count();

        //实例化分页类
        $Page = new \Think\Page($count,$rows);// 实例化分页类 传入总记录数和每页显示的记录数(25)

        $pages = $Page->show();

        //获取limit参数
        $limit = $Page->firstRow.','.$Page->listRows;
        $news=$model->where('status=1')->order('create_time desc')->limit($limit)->select();
        foreach($news as $key=>$item){
            $photoId=$item['photo'];
            $photo=$fileModel->where("id=$photoId")->find();
            $news[$key]['photo']=$photo?$photo['url']:'';
        }
        $this->assign('news',$news);
        $this->assign('notice',$notice);
        $this->assign('root','news');
        $this->assign('pages',$pages);
        $this->display();
    }

    public function info(){
        $newsId=I('get.newsId');
        $model=M('news');
        $navigation=array();
        $navigation[]=array(
            'title'=>'新闻动态',
            'url'=>__ROOT__.'/Home/news'
        );
        $news=$model->where("status=1 and id=$newsId ")->find();
        $this->assign('news',$news);
        $this->assign('root','news_info');
        $this->assign('navigation',$navigation);
        $this->display();
    }
}