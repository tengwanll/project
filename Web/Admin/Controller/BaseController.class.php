<?php
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller {
    /**
     * 接口返回
     * @param $errno
     * @param null $result
     */
	public function buildResponse($errno,$result=null){
		$errorMessage='';
		if($errno){
			$errorModel=M('error_code');
			$errorCode=$errorModel->where("error=$errno")->find();
			$errorMessage=$errorCode?$errorCode['message']:'';
		}
		$response=array(
			'errno'=>$errno,
			'ermsg'=>$errorMessage,
		);
        if($result){
            $response['result']=$result;
        }
		$this->ajaxReturn($response);
	}

    /**
     * 获取数据
     * @return mixed
     */
    public function getContent(){
        $content=file_get_contents("php://input");
        if(json_decode($content,true)){
            $arr=json_decode($content,true);
        }else{
            parse_str($content,$arr);
        }
        return $arr;
    }

    /**
     * 获取分页
     * @return string
     */
    public function getPage(){
        $page=I('get.page');
        $rows=I('get.rows');
        if($page&&$rows){
            $pagePart=$page.','.$rows;
        }else{
            $pagePart='1,10';
        }
        return $pagePart;
    }

    /**
     * 拼接where语句
     * @param array $where
     * @return string
     */
    public function makeQueryString($where = array()) {
        if (count ( $where ) == 0)
            return '';
        $whereString = $where [0];
        for($i = 1; $i < count ( $where ); $i ++) {
            $whereString = $whereString . ' and ' . $where [$i];
        }
        return $whereString;
    }
}