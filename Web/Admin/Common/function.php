<?php 
	//定义性别调节函数
	function getSex($sex){
		return $sex ? '男' : '女';
	}

	//定义分类的父类调节函数
	function getName($sid){

		if($sid == '0') return '顶级分类';

		$sort = M('sort');

		$sorts = $sort->find($sid);

		return $sorts['name'];

	}

	//定义广告分类的父类调节函数
	function getAdPar($pid){
		
		if($pid == '0') return '顶级分类';

		$ads = M('ads');

		$adses = $ads->find($pid);

		return $adses['name'];

	}

	//定义友链的类别调节函数
	function getLinkType($type){
		
		return $type ? '图片链接' : '文字链接';

	}

 ?>