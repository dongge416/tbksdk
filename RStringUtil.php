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
		}
		return $result;
	}

}

?>