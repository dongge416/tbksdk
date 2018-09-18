<?php

class RStringUtil{


	public static function separateKouLing($contentStr){
		$result = "";
		if(strstr($contentStr,"￥")){
			
			$a_index = strpos($contentStr,"￥");
			$b_index = strrpos($contentStr,"￥");
			echo "a_index:".$a_index;
			echo "b_index:".$b_index;
			$result = substr($contentStr, $a_index,$b_index);
			
		}else if(strstr($contentStr,"*")){
			$a_index = strpos($contentStr,"￥");
			$b_index = strrpos($contentStr,"￥");
			$result = substr($contentStr, $a_index,$b_index);
			if($a_index != $b_index){
				$result = substr($contentStr, $a_index,$b_index);
			}
			
			
		}else if(strstr($contentStr,"€")){
			$a_index = strpos($contentStr,"€");
			$b_index = strrpos($contentStr,"€");
			if($a_index != $b_index){
				$result = substr($contentStr, $a_index,$b_index);
			}
		
		}
		return $result;
	}

	public static function separateItemId($contentStr){
		$item_id;
		if (strstr($contentStr, 'taobao.com/i')) {
			# code...
			
			if (strstr($contentStr, '.htm')&&strstr($contentStr, 'sourceType=item')) {
				# code...
				$a_index = strpos($contentStr, 'com/i')+5;
				$b_index = strpos($contentStr, '.htm');
				$item_id = substr($contentStr, $a_index,$b_index-$a_index);
				
			}
		}
	}

	public static function checkUrl($contentStr){
		$regex = '@(?i)\b((?:[a-z][\w-]+:(?:/{1,3}|[a-z0-9%])|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}/)(?:[^\s()<>]+|([\s()<>]+|(\([\s()<>]+))*\))+(?:([\s()<>]+|(\([\s()<>]+))*\)|[^\s`!(){};:\'".,<>?«»“”‘’]))@';
		//var_dump( preg_match($regex, 'http://segmentfault.com/q/1010000000584340') );
		return (preg_match($regex, $contentStr));
	}

	public static function checkChinese($contentStr){
		$regex = '/[\x{4e00}-\x{9fa5}]/u';
		return (preg_match($regex, $contentStr));
	}

}

?>