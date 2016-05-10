<?php
namespace Home\Controller;
use Think\Controller;
class NewsController extends Controller {
    public function index(){
        $page=I('get.page');
        $rows=I('get.rows');
        if($page&&$rows){
            $pagePart=$page.','.$rows;
        }else{
            $pagePart='1,10';
        }
        $model=M('news');
        $noticeModel=M('notice');
        $fileModel=M('file');
        $notice=$noticeModel->where('status=1')->order('create_time desc')->select();
        $news=$model->where('status=1')->order('create_time desc')->page($pagePart)->select();
        foreach($news as $key=>$item){
            $photoId=$item['photo'];
            $photo=$fileModel->where("id=$photoId")->find();
            $news[$key]['photo']=$photo?$photo['url']:'';
        }
        $this->assign('news',$news);
        $this->assign('notice',$notice);
        $this->assign('root','news');
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