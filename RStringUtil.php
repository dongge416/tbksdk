<?php

class RStringUtil{


	public static function isKouLing($contentStr){
		if (strstr($contentStr, "￥")||strstr($contentStr, "€")) {
			
			return true;
		}else {
			return false;
		}
	}

	public static function sisTamllKouLing(){

		if (strstr($contentStr, "喵口令")) {
			
			return true;
		}else{
			return false;
		}
	}

	public static function separateKouLing($contentStr){
		$result = "";
		if(strstr($contentStr,"￥")){
			
			$a_index = strpos($contentStr,"￥");
			$b_index = strrpos($contentStr,"￥");
			// echo "a_index:".$a_index;
			// echo "b_index:".$b_index;
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
		if (strstr($contentStr, 'https://item.taobao.com/item.htm?')) {
			# code...
			$a_index = strpos($contentStr, '&id=')+4;
			$b_index = strpos($contentStr, '&sourceType');
			// echo 'a_index:'.$a_index;
			// echo 'b_index:'.$b_index;
			$item_id = substr($contentStr, $a_index,$b_index-$a_index);
			return $item_id;
		}else if (strstr($contentStr, 'taobao.com/i')) {
			
			
			if (strstr($contentStr, '.htm')&&strstr($contentStr, 'sourceType=item')) {
				# code...
				$a_index = strpos($contentStr, 'com/i')+5;
				$b_index = strpos($contentStr, '.htm');
				$item_id = substr($contentStr, $a_index,$b_index-$a_index);
				return $item_id;
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

	public static function separateCouponexplain($contentStr){
		$a_index = mb_strpos($contentStr, '满',0,"UTF8")+1;
		$b_index = mb_strpos($contentStr, '元',0,"UTF8");
		$result = mb_substr($contentStr, $a_index,$b_index-$a_index,"UTF8");
		return $result;
	}

	public static function countRebateMoney($money){
		$rebate_rate ;
		$rebate_money;
		if ($money<=0.3) {
			# code...
			$rebate_rate = 0.7;
		}else if ($money <= 1) {
			# code...
			$rebate_rate = 0.65;
		}else if ($money <= 3) {
			$rebate_rate = 0.5;
		}else if ($money <= 5) {
			$rebate_rate = 0.48;
		}else if ($money <= 15) {
			$rebate_rate = 0.45;
		}else if ($money <= 80) {
			$rebate_rate = 0.4;
		}else if ($money <= 200) {
			$rebate_rate = 0.35;
		}elseif ($money <= 500) {
			$rebate_rate = 0.3;
		}
		$rebate_money = $money * $rebate_rate;
		return $rebate_money; 
	}

}

?>