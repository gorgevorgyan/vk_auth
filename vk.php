<?php
require_once('config.php');

$client_secret = VKauthSettings::get_client_secret();
$client_id = VKauthSettings::get_client_id();
$redirect_uri = VKauthSettings::get_redirect_uri();

if(!$_GET['code']){
	exit('error code');
}
$token=json_decode(file_get_contents('https://oauth.vk.com/access_token?client_id='.$client_id.'&client_secret='.$client_secret.'&redirect_uri='.$redirect_uri.'&code='.$_GET['code']),true);

if(!$token){
	exit('error token');
}
$data=json_decode(file_get_contents('https://api.vk.com/method/users.get?user_id='.$token['user_id'].'&v=5.95&access_token='.$token['access_token'].'&fields=uid,firstname,lastname,photo_big,status,states,friends,wall'),true);
if(!$data){
	exit('error data');
}
echo '<pre>';
var_dump($data);
echo '</pre>';
?>

