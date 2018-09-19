<?php
include "TopSdk.php";
error_reporting( E_ALL&~E_NOTICE );
class ApiUtils{


	
	public static $my_app_key = "24333767";
	public static $my_app_secret_key="8b5750f690730e4a2938b409329b0a3e";

	public static $haodanku_key = "tshtts";
	public static $my_pid="mm_97861461_26020803_101016325";


	public static function analysisKeywords($taowords){
		$c = new TopClient;
		$c->appkey = self::$my_app_key;
		$c->secretKey = self::$my_app_secret_key;
		$req = new WirelessShareTpwdQueryRequest;
		$req->setPasswordContent($taowords);
		$resp = $c->execute($req);
		print_r($resp);
		return $resp;
	}

	public static function creatTaoWords($urlStr,$textStr,$logo){
		$result_taowords;
		$c = new TopClient;
		$c->appkey = self::$my_app_key;
		$c->secretKey = self::$my_app_secret_key;
		$req = new TbkTpwdCreateRequest;
		
		$req->setText($textStr);
		$req->setUrl('$urlStr');
		if (!empty($logo)) {
			# code...
			$req->setLogo($logo);
		}
		
		
		$resp = $c->execute($req);
		//var_dump('===淘口令===');
		//var_dump($resp);
		//print_r($resp);
		$result_taowords = $resp->data->model;
		return $result_taowords;
	}

	public static function getHighCommission($itemId){
		
		$send_result = array();
		$request_url = 'http://v2.api.haodanku.com/ratesurl'; 
		$request_data['apikey'] = self::$haodanku_key; 
		$request_data['itemid'] = $itemId; 
		$request_data['pid'] = self::$my_pid; 
		//$request_data['activityid'] = '7d6e6619ff754e1e94ea140e2a82240f'; 
		$ch = curl_init(); 
		curl_setopt($ch,CURLOPT_URL,$request_url); 
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); 
		curl_setopt($ch, CURLOPT_TIMEOUT,10); 
		curl_setopt($ch,CURLOPT_POST,1); 
		curl_setopt($ch,CURLOPT_POSTFIELDS,$request_data); 
		$res = curl_exec($ch); 
		curl_close($ch); 
		$arr_msg_result = json_decode($res,true);
		$arr_msg_code = $arr_msg_result['code'];
		$arr_msg_data = $arr_msg_result['data'];
		var_dump($res);

		if ($arr_msg_code==1) {
			# 请求成功
			$send_result['code'] = '1';
			$send_result['msg'] = 'SUCCESS';
			$send_result_data = array();
			$send_result_data['max_commission_rate'] = $arr_msg_data['max_commission_rate'];
			$send_result_data['couponmoney'] = $arr_msg_data['couponmoney'];
			$send_result_data['coupon_click_url'] = $arr_msg_data['coupon_click_url'];
			$send_result_data['couponexplain'] = $arr_msg_data['couponexplain'];
			$send_result['data'] = $send_result_data;
			//var_dump($send_result);
 		}else{
 			# 请求成功
			$send_result['code'] = '0';
			$send_result['msg'] = 'error';
			$send_result['data'] = '';
 		}
 		return $send_result;
	
	}

	public static function convertApi($taowords){
		$send_result = array('code'=>'0','msg'=>'error','data'=>'');

		$taowords_result = self::analysisKeywords($taowords);
		var_dump($taowords_result);
		if($taowords_result->suc == 'false'){
			#淘口令请求失败

			return $send_result;
		}
		$item_id = RStringUtil::separateItemId($taowords_result->url);
		if (!is_numeric($item_id)) {
			# code...
			return $send_result;
		}else{
			//是数字，进行高佣金转链接
			
			$hightCommission = self::getHighCommission($item_id);
			//标题
			$title = $taowords_result->content;
			//二合一连接
			$coupon_click_url = $hightCommission['data']['coupon_click_url'];
			//返回的淘口令
			$send_taoword = self::creatTaoWords($coupon_click_url,$title,'');
			//原价
			$original_price = $taowords_result->price;
			//优惠劵金额
			$couponmoney = $hightCommission['couponmoney'];
			//优惠劵使用条件
			$couponexplain = $hightCommission['couponexplain'];
			//券后价
			$discount_price;
			//优惠劵使用条件金额
			$couponexplain_money = RStringUtil::separateCouponexplain($couponexplain);
			if ($original_price >= $couponexplain_money) {
				# 可以使用优惠劵
				$discount_price = $original_price - $couponmoney;
			}else{
				$discount_price = $original_price;
			}
			

			
			
			//券后价
			
			// $discount_price = 
			if (!empty($send_taoword)) {
				# code...
			}
		}
		

	}

}
?>