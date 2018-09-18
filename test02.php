<?php
header("Access-Control-Allow-Origin: *");
//header('Access-Control-Allow-Methods:*'); 
header('Access-Control-Allow-Headers:x-requested-with,content-type');   
header("content-type:text/html;charset=utf-8");
//header("Access-Control-Allow-Origin: http://127.0.0.1:8020");
//include "TopSdk.php";
include "ApiUtils.php";
include "RStringUtil.php";
date_default_timezone_set('Asia/Shanghai');




function test($taowords){
	$c = new TopClient;
	//$c->appkey = '24333767';
	//$c->secretKey = '8b5750f690730e4a2938b409329b0a3e';
	$c->appkey = '12497914';
	$c->secretKey = '4b0f28396e072d67fae169684613bcd1';
	$req = new WirelessShareTpwdQueryRequest;
	$req->setPasswordContent($taowords);
	$resp = $c->execute($req);
	print_r($resp);
	$title = $resp->title;
	return $title;
}
//￥FrDKbeqHD9G￥
//$a = test("￥EAZobeqKyTS￥");
//print_r($a->title);

/**
$request_url = 'http://v2.api.haodanku.com/ratesurl'; 
$request_data['apikey'] = 'tshtts'; 
$request_data['itemid'] = '37407455923'; 
$request_data['pid'] = 'mm_97861461_26020803_101016325'; 
//$request_data['activityid'] = '7d6e6619ff754e1e94ea140e2a82240f'; 
$ch = curl_init(); 
curl_setopt($ch,CURLOPT_URL,$request_url); 
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); 
curl_setopt($ch, CURLOPT_TIMEOUT,10); 
curl_setopt($ch,CURLOPT_POST,1); 
curl_setopt($ch,CURLOPT_POSTFIELDS,$request_data); 
$res = curl_exec($ch); 
curl_close($ch); 
var_dump($res);

**/


 //$result = ApiUtils::analysisKeywords("爱房间家用粉少女心可机洗定制】http://m.tb.cn/h.3gEHxPo?sm=b3cf83 点击链接，再选择浏览器咑閞；或復·制描述￥EWNtbVp0Gk7￥后");

$result = ApiUtils::convertApi('描述￥EWNtbVp0Gk7￥后');


//$result = ApiUtils::getHighCommission("553582995153");



$contentStr="999EAZobeqKyTS￥999";
$contentStr="999€EAZobeqKyTS€999";
// $result = "999";
// if(strstr($contentStr,"￥")){
	
// 	$a_index = strpos($contentStr,"￥");
// 	$b_index = strrpos($contentStr,"￥");
// 	$result = substr($contentStr, $a_index,$b_index);
// 	echo $result;
// }else if(strstr($contentStr,"￥"){
// 	$a_index = strpos($contentStr,"￥");
// 	$b_index = strrpos($contentStr,"￥");
// 	$result = substr($contentStr, $a_index,$b_index);
// }

//$result = RStringUtil::separateKouLing($contentStr);
// if($result==""){
// 	echo "空";
// }else{
// 	echo $result;
// }
if($result==""){
	echo "空";
}else{
	echo $result;
}



//print_r($b===false);000

// if(RStringUtil::checkUrl('http://item.taobao.com/item.htm?id=553582995153我的是的')){
// 	echo("是网址");
// }else{
// 	echo "不是网址";
// }


// if(RStringUtil::checkChinese('http://item.tahttp://m.tb.cn/h.3TaRJTQ')){
// 	echo "有中文";
// }else{
// 	echo "没有中文";
// }



// $data = array('title' => '标题','money'=>'9.90' );
// $result = array('code'=>'0','msg'=>'error','data'=>$data);
// var_dump($result);


// $test_arr = array();
// $test_arr['000']='999';
// echo ($test_arr['000']);

?>