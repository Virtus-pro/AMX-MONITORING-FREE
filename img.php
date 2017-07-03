<?php
/* 
     AMX MONITORING v.1.1.6
	Разработчик: Virtus-pro

	Сайт: www.amxservers.ru 
	
	******Спасибо. Надеемся Вам понравится наш продукт.********
*/
require_once('cap/kcaptcha.php');
if(isset($_REQUEST[session_name()])){
    session_start();
}
$captcha = new KCAPTCHA();
if($_REQUEST[session_name()]){
    $_SESSION['captcha_keystring'] = $captcha->getKeyString();
}
?> 