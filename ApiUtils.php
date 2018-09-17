<?php
include "TopSdk.php";
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
		$title = $resp->title;
		return $resp;
	}

	public static function getHighCommission($itemId){
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
		print_r($res);
		var_dump($res);
	}

}
?>