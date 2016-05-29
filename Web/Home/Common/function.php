<?php 
	function stringChange($root){
		return ucfirst($root);
	}
    function delHtml($str){
        return strip_tags($str);
    }
    function subRep($str){
        if(mb_strlen($str,'utf-8')>60){
            return  mb_substr($str,0,60,"utf-8").'...';
        }else{
            return $str;
        }
    }

 ?> 