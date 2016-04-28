<?php
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller {

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

    public function getContent(){
        return json_decode(file_get_contents("php://input"),true);
    }
}