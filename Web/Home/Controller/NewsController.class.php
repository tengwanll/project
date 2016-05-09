<?php
namespace Home\Controller;
use Think\Controller;
class NewsController extends Controller {
    public function index(){
        $model=M('news');
        $noticeModel=M('notice');
        $fileModel=M('file');
        $notice=$noticeModel->where('status=1')->order('create_time desc')->select();
        $news=$model->where('status=1')->order('create_time desc')->select();
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