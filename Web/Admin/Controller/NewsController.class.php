<?php
	namespace Admin\Controller;

	class NewsController extends CommonController {
        /**
         * 新闻列表
         */
		public function newsList(){
            $page=$this->getPage();
            $title=I('get.title');
            $newsModel=M('news');
            $fileModel=M('file');
            if($title){
                $where=" title like '%$title%' and status=1 ";
            }else{
                $where='status=1';
            }
            $newsList=$newsModel->where($where)->page($page)->select();
            $total=$newsModel->where($where)->count();
            $arr=array();
            foreach($newsList as $lists){
                $photoId=$lists['photo'];
                $photo=$fileModel->where("id=$photoId")->find();
                $photoUrl=$photo?__ROOT__.'/'.$photo['url']:'';
                $arr[]=array(
                    'id'=>$lists['id'],
                    'title'=>$lists['title'],
                    'shortDesc'=>$lists['short_desc'],
                    'content'=>$lists['content'],
                    'photo'=>$photoUrl,
                    'createTime'=>$lists['create_time']
                );
            }
            $result=array(
                'newsList'=>$arr,
                'total'=>$total
            );
            $this->buildResponse(0,$result);
		}

        public function detail(){
            $newsId=I('get.newsId');
            $newsModel=M('news');
            $fileModel=M('file');
            $news=$newsModel->where("id=$newsId")->find();
            if(!$news){
                $this->buildResponse(10205);
            }
            $photoId=$news['photo'];
            $photo=$fileModel->where("id=$photoId")->find();
            $photoUrl=$photo?__ROOT__.'/'.$photo['url']:'';
            $arr=array(
                'id'=>$news['id'],
                'title'=>$news['title'],
                'shortDesc'=>$news['short_desc'],
                'content'=>$news['content'],
                'photo'=>$photoUrl,
                'createTime'=>$news['create_time']
            );
            $this->buildResponse(0,$arr);
        }

        /**
         * 添加新闻
         */
        public function create(){
            $json=$this->getContent();
            $title=$json['title'];
            $shortDesc=$json['shortDesc'];
            $content=$json['content'];
            $photo=$json['photo'];
            $date=date('Y-m-d H:i:s',time());
            $data=array(
                'title'=>$title?$title:'',
                'short_desc'=>$shortDesc?$shortDesc:'',
                'content'=>$content?$content:'',
                'photo'=>$photo?$photo:0,
                'status'=>1,
                'create_time'=>$date,
                'update_time'=>$date
            );
            $newsModel=M('news');
            $newsId=$newsModel->data($data)->add();
            if(!$newsId){
                $this->buildResponse(10214);
            }
            $this->buildResponse(0,$newsId);
        }

        /**
         * 修改新闻
         */
        public function update(){
            $json=$this->getContent();
            $newsId=$json['newsId'];
            $title=$json['title'];
            $shortDesc=$json['shortDesc'];
            $content=$json['content'];
            $photo=$json['photo'];
            $newsModel=M('news');
            $news=$newsModel->where("id=$newsId")->find();
            if(!$news){
                $this->buildResponse(10205);
            }
            $data=array();
            if($title){
                $data['title']=$title;
            }
            if($shortDesc){
                $data['short_desc']=$shortDesc;
            }
            if($content){
                $data['content']=$content;
            }
            if($photo){
                $data['photo']=$photo;
            }
            $newsId=$newsModel->where("id=$newsId")->save($data);
            if(!$newsId){
                $this->buildResponse(10214);
            }
            $this->buildResponse(0);
        }

        /**
         * 删除新闻
         */
        public function delete(){
            $json=$this->getContent();
            $newsId=$json['newsId'];
            $newsModel=M('news');
            $news=$newsModel->where("id=$newsId")->find();
            if(!$news){
                $this->buildResponse(10205);
            }
            $data=array('status'=>0);
            $newsId=$newsModel->where("id=$newsId")->save($data);
            if(!$newsId){
                $this->buildResponse(10214);
            }
            $this->buildResponse(0);
        }
	}

?>