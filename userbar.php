<?php
/* 
     AMX MONITORING v.1.1.6
	Разработчик: Virtus-pro

	Сайт: www.amxservers.ru 
	
	******Спасибо. Надеемся Вам понравится наш продукт.********
*/
if(isset($_GET['id'])){
	require_once "maincore.php";
	$id=intval($_GET['id']);
	$q = dbquery("SELECT * FROM ".DB_SERVERS." WHERE server_id = '$id'");
	$serv_b_num = dbrows($q);
	if($serv_b_num!=0){
		$serv=dbarray_fetch($q);
		header ("Content-type: image/png");
		$font = "include/fonts/timesbd.ttf";
		//$font2 = ROOT."include/fonts/tahoma.ttf";
		//Выводим картинку карты
		if (!$i = @imagecreatefromjpeg("images/maps/".$serv['server_map'].".jpg"))
		{
			$i = imagecreatefromjpeg('images/maps/default.jpg');
		}
		//переменная статуса в виде текста :)
		if($serv['server_status']==1){$status="Online";}else{$status="Offline";}

		//Создаем фон
		$img = imagecreatefrompng('images/banners/amx_1.png');
		//Накладываем картинку карты на фон
		imagecopyresized($img, $i, 14, 12, 0, 0, 105, 60, 160, 120);
		$flag = imagecreatefrompng("images/flags/".$serv['server_location'].".png");
		imagecopyresized($img, $flag, 276, 45, 0, 0, 16, 12, 32, 24);
		//--------------------------------------------------------------------------------------------//
		//херачим иконку игры на баннер, 300 - это отступ в право,37 - отступ в низ
		//два нуля не трогаем, ну их :D
		//17 - это размер вывода иконки в пикселях (как не странно но в php размер имет значение :D )
		//16 - это реальный размер иконки в px
		//imagecopyresized($img, $g, 300, 37, 0, 0, 17, 17, 16, 16);
		//--------------------------------------------------------------------------------------------//


		$color=htmlcolor($img,"faeedd");


		$red=htmlcolor($img,"FF0000");
		$green=htmlcolor($img,"00FF00");
		//если сервер off то цвет красный а если онлайн то зеленый ;)
		//if($serv['server_status']==1){$green_red=$green;}else{$green_red=$red;}




		//Обрезаем длинное название сервера
		$name=str_name($serv['server_name'],24,"...");

		//пресуем статус на баннер :D
		//imagettftext($img, 9, 0, 215, 23, $green_red, $font, $status );
		imagettftext($img, 9, 0, 140, 27, $color, $font, $serv['server_name'] );
		imagettftext($img, 9, 0, 140, 56, $color, $font, $serv['server_ip'] );
		imagettftext($img, 11, 0, 140, 86, $color, $font, $serv['server_map'] );
		imagettftext($img, 11, 0, 276, 86, $color, $font, $serv['server_players']."/".$serv['server_maxplayers'] );
		imagepng($img);
		imagedestroy($img, $i);
		imagedestroy($img, $g);
	}else{
		die("<center><br><br><br><br><br><br><font size='3' color='red'><b>Такого сервера нет в базе!</b></font></center>");	
	}

}else{
    die("<center><br><br><br><br><br><br><font size='3' color='red'><b>Доступ запрещен!</b></font></center>");
}

	//функция для перевода из HEX кода в RBG
	function htmlcolor($img,$color) {
				sscanf($color, "%2x%2x%2x", $red, $green, $blue);
				return ImageColorAllocate($img,$red,$green,$blue);
				return($c);
	}
?>