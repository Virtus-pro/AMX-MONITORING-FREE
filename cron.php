<?php
/* 
     AMX MONITORING v.1.1.6
	Разработчик: Virtus-pro

	Сайт: www.amxservers.ru 
	
	******Спасибо. Надеемся Вам понравится наш продукт.********
*/
echo "<html><head><meta http-equiv='Refresh' content='300; URL=/rcon.php'></head><body>";
require_once "config.php";
require_once "include/rus_name_fix.php";
require_once "include/constants.php";
$link = dbconnect($db_host, $db_user, $db_pass, $db_name);
require_once "include/function.php";
$servers = dbquery("SELECT * FROM ".DB_SERVERS." order by cron_time ASC limit 500");
while($r=dbarray_fetch($servers)) {

	$serv=serverInfo($r['server_ip']);
	if($serv['status']=='off'){
		
		if($serv['server_name']=='0' || $serv['server_name']=''){
			$name="Сервер выключен";
		}else{
			$name=$serv['server_name'];
		}
		$result = dbquery("UPDATE amx_servers 
			SET 
				server_name='".$name."',
				server_status = '0', 
				server_map = '-',
				server_players = '-',
				server_maxplayers = '-'
			WHERE server_id='".$r['server_id']."'");
		continue;
	}else{


		$name=htmlspecialchars($serv['name']);
		if($name=="")$name=$serv['server_name'];
		$result = dbquery("
		UPDATE amx_servers
		  SET
			server_name = '".$name."',
			server_map = '".$serv['map']."',
			cron_time='".time()."',
			server_players = '".$serv['players']."',
			server_maxplayers = '".$serv['max_players']."',
			server_status = '1'
		   WHERE server_id='".$r['server_id']."'
		");
		if($result) {echo "<font color='green'>Даные сервера с порядковым ".$r['server_id']." внесены в базу данных</font>";} else {echo "<font color='red'><b>Ошибка</b>, данные сервера с порядковым ".$r['server_id']." не были внесены в БД</font>";}
		echo "<br>";
	}
}
$date_proverka = time(); // запоминаем дату
$result = dbquery("UPDATE amx_settings SET proverka = '".$date_proverka."'");

// MySQL функции
function dbquery($query) {
    $result = @mysql_query($query);
    if (!$result) {
        echo mysql_error();
        return false;
    } else {
        return $result;
    }
}
function dbarray_fetch($query) {
    $result = @mysql_fetch_array($query);
    if (!$result) {
        echo mysql_error();
        return false;
    } else {
        return $result;
    }
}
function dbconnect($db_host, $db_user, $db_pass, $db_name) {
	$db_connect = @mysql_connect($db_host, $db_user, $db_pass);
	$db_select = @mysql_select_db($db_name);
	if (!$db_connect) {
		die("<div style='font-family:Verdana;font-size:11px;text-align:center;'><b>Не могу подключиться к MySQL</b><br />".mysql_errno()." : ".mysql_error()."</div>");
	} elseif (!$db_select) {
		die("<div style='font-family:Verdana;font-size:11px;text-align:center;'><b>НЕ могу подключиться к MySQL базе данных</b><br />".mysql_errno()." : ".mysql_error()."</div>");
	}
}

mysql_close();
?>
</body></html>