<?php
/* 
     AMX MONITORING v.1.1.6
	Разработчик: Virtus-pro

	Сайт: www.amxservers.ru 
	
	******Спасибо. Надеемся Вам понравится наш продукт.********
*/
if (empty($_SESSION['admin_name']) or empty($_SESSION['admin_id']))die("Доступ запрещен");

if (isset($_POST['add_new_serv'])) {
	$id=intval($_POST['serv']);
    $result = dbquery("UPDATE ".DB_SERVERS." SET server_new='0' WHERE server_id=".$id."");
	$error=$locale['obpost001'];
	if (!$result) { $error="=<b><font color='red'>".$locale['obpost002']."</font></b>"; }
		if(isset($_POST['null'])){
		$result2=dbquery("UPDATE ".DB_SERVERS." SET votes='0'");
		$result2=dbquery("DELETE FROM ".DB_VOTES);
	}
	echo "<html><head><meta http-equiv='Refresh' content='2; URL=admin/".AMX_SELF."?id=new_serv'></head>";
	echo "<body>";
	echo "<br>";
	echo "<body><table height='104' border='1' align='center' bordercolor='#3C3A36'>";
	echo "<tr bordercolor='#999999'>";
	echo "<td width='294'><font color='3C3A36'><center><strong><div class=\"alert alert-success\"><center>".$error."</center></div></strong>";
	echo "<small>[<a href='admin/".AMX_SELF."?id=new_serv'>".$locale['obpost003']."</a>]</small></center></font></td>";
	echo "</tr></table><br><br>";
	}
if (isset($_POST['delite_serv'])) {
		$id=intval($_POST['serv']);
		$result = dbquery("DELETE FROM ".DB_SERVERS." WHERE server_id=".$id);
			$error=$locale['obpost006'];
		if (!$result) { $error="=<b><font color='red'>".$locale['obpost002']."</font></b>"; }
		echo "<html><head><meta http-equiv='Refresh' content='2; URL=admin/".AMX_SELF."?id=new_serv'></head>";
		echo "<body>";
		echo "<br>";
		echo "<body><table height='104' border='1' align='center' bordercolor='#3C3A36'>";
		echo "<tr bordercolor='#999999'>";
		echo "<td width='294'><font color='3C3A36'><center><strong><div class=\"alert alert-success\"><center>".$error."</center></div></strong>";
		echo "<small>[<a href='admin/".AMX_SELF."?id=new_serv'>".$locale['obpost003']."</a>]</small></center></font></td>";
		echo "</tr></table><br><br>";
	}
	if (isset($_POST['savesettings'])) {
    $license = descript(stripslash($_POST['license']));
    $localeset = stripinput($_POST['localeset']);
    $old_localeset = stripinput($_POST['old_localeset']);
    $result = dbquery("UPDATE ".DB_SETTINGS." SET
        sitename='".stripinput($_POST['sitename'])."',
		zname='".stripinput($_POST['zname'])."',
        siteurl='".stripinput($_POST['siteurl']).(strrchr($_POST['siteurl'],"/") != "/" ? "/" : "")."',
        siteemail='".stripinput($_POST['siteemail'])."',
        siteusername='".stripinput($_POST['username'])."',
        description='".stripinput($_POST['description'])."',
        keywords='".stripinput($_POST['keywords'])."',
		copy_mon='".stripinput($_POST['cm'])."',
        license='$license',
        locale='$localeset'
    ");
		$error=$locale['obpost004'];
	if (!$result) { $error="=<b><font color='red'>".$locale['obpost004']."</font></b>"; }
		echo "<html><head><meta http-equiv='Refresh' content='2; URL=admin/".AMX_SELF."?id=global'></head>";
		echo "<body>";
		echo "<br>";
		echo "<body><table height='104' border='1' align='center' bordercolor='#3C3A36'>";
		echo "<tr bordercolor='#999999'>";
		echo "<td width='294'><font color='3C3A36'><center><strong><div class=\"alert alert-success\"><center>".$error."</center></div></strong>";
		echo "<small>[<a href='admin/".AMX_SELF."?id=global'>".$locale['obpost003']."</a>]</small></center></font></td>";
		echo "</tr></table><br><br>";
}
if (isset($_POST['savesettings_other'])) {
    $maintenance_message = stripinput($_POST['m_message']);
	
		if(isset($_POST['all_serv_index'])){$all_serv_index=1;}else{$all_serv_index=0;}
		if(isset($_POST['all_serv_search'])){$all_serv_search=1;}else{$all_serv_search=0;}
	
    $result = dbquery("UPDATE ".DB_SETTINGS." SET
        enable_registration='".$_POST['register_global']."',
		register_off='".$_POST['register_off']."',
        register_MG1='".$_POST['register_MG1']."',
        register_MG2='".$_POST['register_MG2']."',
		top_maps='".intval($_POST['top_maps'])."',
		all_serv_search='".$all_serv_search."',
		all_serv_index='".$all_serv_index."',
		top_servers='".intval($_POST['top_servers'])."',
		news_top='".intval($_POST['news_top'])."',
		top_search='".intval($_POST['top_search'])."',
        maintenance='".$_POST['maintenance']."',
        maintenance_message='$maintenance_message'
    ");
	if(isset($_POST['null'])){
		$result2=dbquery("UPDATE ".DB_SERVERS." SET votes='0'");
		$result = dbquery("TRUNCATE `".$db_prefix."vote_ip`;");
	}
		$error=$locale['obpost004'];
	if (!$result) { $error="=<b><font color='red'>".$locale['obpost005']."</font></b>"; }
	echo "<html><head><meta http-equiv='Refresh' content='2; URL=admin/".AMX_SELF."?id=other'></head>";
	echo "<body>";
	echo "<br>";
	echo "<body><table height='104' border='1' align='center' bordercolor='#3C3A36'>";
	echo "<tr bordercolor='#999999'>";
	echo "<td width='294'><font color='3C3A36'><center><strong><div class=\"alert alert-success\"><center>".$error."</center></div></strong>";
	echo "<small>[<a href='admin/".AMX_SELF."?id=other'>".$locale['obpost003']."</a>]</small></center></font></td>";
	echo "</tr></table><br><br>";
}
if (isset($_POST['save_serv'])) {
	$id=intval($_POST['serv']);
    $email=stripinput($_POST['email']);
    $icq=stripinput($_POST['icq']);
	$www=stripinput($_POST['site']);
    $result = dbquery("UPDATE ".DB_SERVERS." SET
        votes='".intval($_POST['votes'])."',
        server_off='".intval($_POST['off'])."',
		
		server_email='".$email."',
		server_icq='".$icq."',
		server_site='".$www."',
        server_vip='".intval($_POST['vip'])."'
     WHERE server_id=".$id);
		$error=$locale['obpost004'];
	if (!$result) { $error="=<b><font color='red'>".$locale['obpost005']."</font></b>"; }
	echo "<html><head><meta http-equiv='Refresh' content='2; URL=admin/".AMX_SELF."?id=info&serv=".$id."'></head>";
	echo "<body>";
	echo "<br>";
	echo "<body><table height='104' border='1' align='center' bordercolor='#3C3A36'>";
	echo "<tr bordercolor='#999999'>";
	echo "<td width='294'><font color='3C3A36'><center><strong><div class=\"alert alert-success\"><center>".$error."</center></div></strong>";
	echo "<small>[<a href='admin/".AMX_SELF."?id=info&serv=".$id."'>".$locale['obpost003']."</a>]</small></center></font></td>";
	echo "</tr></table><br><br>";
}

if (isset($_GET['news'])) {
	$id=intval($_GET['news_id']);
	if(isset($_GET['del'])){
		$result = dbquery("DELETE FROM ".DB_NEWS." WHERE news_id=".$id);
			$error=$locale['obpost006'];
		if (!$result) { $error="=<b><font color='red'>".$locale['obpost002']."</font></b>"; }
		echo "<html><head><meta http-equiv='Refresh' content='2; URL=admin/index.php?id=news'></head>";
		echo "<body>";
		echo "<br>";
		echo "<body><table height='104' border='1' align='center' bordercolor='#3C3A36'>";
		echo "<tr bordercolor='#999999'>";
		echo "<td width='294'><font color='3C3A36'><center><strong><div class=\"alert alert-success\"><center>Новость успешно удалена</center></div></strong>";
		echo "<small>[<a href='admin/index.php?id=news'>".$locale['obpost003']."</a>]</small></center></font></td>";
		echo "</tr></table><br><br>";	
	}

}
if (isset($_GET['pages'])) {
	$id=intval($_GET['pages_id']);
	if(isset($_GET['del'])){

 		$result = dbquery("DELETE FROM ".DB_PAGES." WHERE pages_id=".$id);
			$error=$locale['obpost006'];
		if (!$result) { $error="=<b><font color='red'>Ошибка при удалении</font></b>"; }
		echo "<html><head><meta http-equiv='Refresh' content='2; URL=admin/index.php?id=news'></head>";
		echo "<body>";
		echo "<br>";
		echo "<body><table height='104' border='1' align='center' bordercolor='#3C3A36'>";
		echo "<tr bordercolor='#999999'>";
		echo "<td width='294'><font color='3C3A36'><center><strong><div class=\"alert alert-success\"><center>Страница упешно удалена</center></div></strong>";
		echo "<small>[<a href='admin/index.php?id=pages'>".$locale['obpost003']."</a>]</small></center></font></td>";
		echo "</tr></table><br><br>";	
	}

}

if (isset($_GET['new_serv_gl'])) {
	$id=intval($_GET['serv']);

if (isset($_GET['serv_all_sp'])){
	$link_obr_addr="admin/index.php?id=servers";
}else{
	$link_obr_addr="admin/index.php";
}


	if(isset($_GET['add'])){
		$result = dbquery("UPDATE ".DB_SERVERS." SET server_new='0' WHERE server_id=".$id."");
		$error=$locale['obpost001'];
		if (!$result) { $error="=<b><font color='red'>".$locale['obpost002']."</font></b>"; }

		echo "<html><head><meta http-equiv='Refresh' content='2; URL=".$link_obr_addr."'></head>";
		echo "<body>";
		echo "<br>";
		echo "<body><table height='104' border='1' align='center' bordercolor='#3C3A36'>";
		echo "<tr bordercolor='#999999'>";
		echo "<td width='294'><font color='3C3A36'><center><strong><div class=\"alert alert-success\"><center>Сервер успешно добавлен</center></div></strong>";
		echo "<small>[<a href='".$link_obr_addr."'>".$locale['obpost003']."</a>]</small></center></font></td>";
		echo "</tr></table><br><br>";	
	}
	
	if(isset($_GET['del'])){
		$result = dbquery("DELETE FROM ".DB_SERVERS." WHERE server_id=".$id);
			$error=$locale['obpost006'];
		if (!$result) { $error="=<b><font color='red'>".$locale['obpost002']."</font></b>"; }
		echo "<html><head><meta http-equiv='Refresh' content='2; URL=".$link_obr_addr."'></head>";
		echo "<body>";
		echo "<br>";
		echo "<body><table height='104' border='1' align='center' bordercolor='#3C3A36'>";
		echo "<tr bordercolor='#999999'>";
		echo "<td width='294'><font color='3C3A36'><center><strong><div class=\"alert alert-success\"><center>Сервер успешно удален</center></div></strong>";
		echo "<small>[<a href='".$link_obr_addr."'>".$locale['obpost003']."</a>]</small></center></font></td>";
		echo "</tr></table><br><br>";	
	}
	
}
?>