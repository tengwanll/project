<?php
namespace Home\Controller;
use Think\Controller;
class NewsController extends Controller {
    public function index(){
        $model=M('news');
        $news=$model->where('status=1')->select();
        $newsCurrent=$model->where('status=1')->order('create_time desc')->limit(3)->select();
        $this->assign('news',$news);
        $this->assign('newsCurrent',$newsCurrent);
        $this->assign('root','news');
        $this->display();
    }

    public function info(){
        $model=M('news');
        $model2=M('activity');
        $model3=M('lab');
        $labs=$model3->where('status=1')->select();
        $activity=$model2->where('status=1')->select();
        $news=$model->where('status=1')->select();
        $newsCurrent=$model->where('status=1')->order('create_time desc')->limit(3)->select();
        $this->assign('news',$news);
        $this->assign('newsCurrent',$newsCurrent);
        $this->assign('activity',$activity);
        $this->assign('labs',$labs);
        $this->assign('root','news_info');
        $this->display();
    }
}