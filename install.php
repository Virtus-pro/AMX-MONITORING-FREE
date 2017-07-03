<?php
/* 
     AMX MONITORING v.1.1.6
	Разработчик: Virtus-pro

	Сайт: www.amxservers.ru 
	
	******Спасибо. Надеемся Вам понравится наш продукт.********
*/
header('Content-type: text/html; charset=utf-8');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Pragma: no-cache"); // HTTP/1.0'


define("AMX_SELF", basename($_SERVER['PHP_SELF']));

if (isset($_POST['localeset']) && file_exists("locale/".$_POST['localeset']) && is_dir("locale/".$_POST['localeset'])) {
	include "locale/".$_POST['localeset']."/install.php";
} else {
	$_POST['localeset'] = "Russian";
	include "locale/Russian/install.php";
}

if (isset($_POST['step']) && $_POST['step'] == "7") {
	header("Location: index.php");
}

echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">\n";
echo "<html>\n<head>\n";
echo "<title>".$locale['title']."</title>\n";
echo "<link rel='stylesheet' href='bootstrap/css/bootstrap.min.css' type='text/css' />\n";
echo '<link rel="shortcut icon" href="images/icon.ico" type="image/x-icon" />';
echo '<script src="include/js/jquery.js"></script>';
echo '<script src="bootstrap/js/bootstrap.min.js"></script>';

echo "</head>\n<body>\n";
echo "<br><br>";
echo "<center><a href='http://www.amxservers.ru/' target='_blank'><img src='images/logo.png'></a><center><br>";
echo "<form name='setupform' method='post' action='install.php'>\n";
?>


<?
echo "<div style='width:450px'>";
echo "<table align='center'  style='padding:10px'    class='table table-bordered' style='width:450px'>\n<tr>\n";
echo "<td class='tbl2'><strong>";

if (!isset($_POST['step']) || $_POST['step'] == "" || $_POST['step'] == "1") {
	echo $locale['001'];
} elseif (isset($_POST['step']) && $_POST['step'] == "2") {
	echo $locale['002'];
} elseif (isset($_POST['step']) && $_POST['step'] == "3") {
	echo $locale['003'];
} elseif (isset($_POST['step']) && $_POST['step'] == "4") {
	echo $locale['004'];
} elseif (isset($_POST['step']) && $_POST['step'] == "5") {
	echo $locale['005'];
} elseif (isset($_POST['step']) && $_POST['step'] == "6") {
	echo $locale['006'];
}

echo "</strong></td>\n</tr>\n<tr>\n<td  style='text-align:center'>\n";

if (!isset($_POST['step']) || $_POST['step'] == "" || $_POST['step'] == "1") {
	$locale_files = makefilelist("locale/", ".|..", true, "folders");
	$locale_list = makefileopts($locale_files);
	echo $locale['010']."<br><br>";
	echo "<select name='localeset' class='textbox' style='margin-top:5px'>\n";
	echo $locale_list."</select><br><br>\n";
	echo "</td>\n</tr>\n<tr>\n<td class='tbl2' style='text-align:center'>\n";
	echo "<input type='hidden' name='step' value='2'>\n";
	echo "<input type='submit' name='next' value='".$locale['007']."' class=\"btn btn btn-primary\">\n";
}

//Нашало второго шага установки
if (isset($_POST['step']) && $_POST['step'] == "2") {
	if (is_writable("images")  && is_writable("config.php")) {
		$write_check = true;
	} else {
		$write_check = false;
	}

	echo '<div class="progress progress-striped active">
	  <div class="bar" style="width: 17%;"></div>
	</div>';

	echo $locale['012']."<br><br>\n";
	echo "<table align='center' cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
	echo "<tr>\n<td class='tbl1'>images</td>\n";
	echo "<td class='tbl1' style='text-align:right'>".(is_writable("images") ? "<span class=\"label label-success\"> ".$locale['015']."</span>" : "<span class=\"label label-important\"> ".$locale['016']."</span>")."</td>\n</tr>\n";
	echo "<tr>\n<td class='tbl1'>images/maps</td>\n";
	echo "<td class='tbl1' style='text-align:right'>".(is_writable("images/maps") ? "<span class=\"label label-success\"> ".$locale['015']."</span>" : "<span class=\"label label-important\">  ".$locale['016']."</span>")."</td>\n</tr>\n";
	echo "<tr>\n<td class='tbl1'>config.php</td>\n";
	echo "<td class='tbl1' style='text-align:right'>".(is_writable("config.php") ? "<span class=\"label label-success\"> ".$locale['015']."</span>" : "<span class=\"label label-important\"> ".$locale['016']."</span>")."</td>\n</tr>\n";

	echo "</table><br><br>\n";
	if ($write_check) {
		echo "<div class=\"alert alert-success\">".$locale['013']."</span>\n";
		echo "</td>\n</tr>\n<tr>\n<td class='tbl2' style='text-align:center'>\n";
		echo "<input type='hidden' name='localeset' value='".stripinput($_POST['localeset'])."'>\n";
		echo "<input type='hidden' name='step' value='3'>\n";
		echo "<input type='submit' name='next' value='".$locale['007']."' class=\"btn btn btn-primary\">\n";
	} else {
		echo "<div class=\"alert alert-error\">".$locale['014']."</span>\n";
		echo "</td>\n</tr>\n<tr>\n<td class='tbl2' style='text-align:center'>\n";
		echo "<input type='hidden' name='localeset' value='".stripinput($_POST['localeset'])."'>\n";
		echo "<input type='hidden' name='step' value='1'>\n";
		echo "<input type='submit' name='next' value='".$locale['008']."' class=\"btn btn btn-primary\">\n";
	}
}

//Конец 2 шага установки

//Начало 3 шага установки
if (isset($_POST['step']) && $_POST['step'] == "3") {

	echo '<div class="progress progress-striped active">
	  <div class="bar" style="width: 34%;"></div>
	</div>';
	echo $locale['017']."<br><br>\n";
	echo "<table align='center' cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
	echo "<td class='tbl1'>".$locale['018']."</td>\n";
	echo "<td class='tbl1' style='text-align:right'><input type='text' value='localhost' name='db_host' class='textbox' style='width:200px'></td>\n</tr>\n";
	echo "<tr>\n<td class='tbl1'>".$locale['019']."</td>\n";
	echo "<td class='tbl1' style='text-align:right'><input type='text' value='' name='db_user' class='textbox' style='width:200px'></td>\n</tr>\n";
	echo "<tr>\n<td class='tbl1'>".$locale['020']."</td>\n";
	echo "<td class='tbl1' style='text-align:right'><input type='password' value='' name='db_pass' class='textbox' style='width:200px'></td>\n</tr>\n";
	echo "<tr>\n<td class='tbl1'>".$locale['021']."</td>\n";
	echo "<td class='tbl1' style='text-align:right'><input type='text' value='' name='db_name' class='textbox' style='width:200px'></td>\n</tr>\n";
	echo "<tr>\n<td class='tbl1'>".$locale['022']."</td>\n";
	echo "<td class='tbl1' style='text-align:right'><input type='text' value='amx_' name='db_prefix' class='textbox' style='width:200px'></td>\n</tr>\n";
	echo "</table>\n";
	echo "</td>\n</tr>\n<tr>\n<td class='tbl2' style='text-align:center'>\n";
	echo "<input type='hidden' name='localeset' value='".stripinput($_POST['localeset'])."'>\n";
	echo "<input type='hidden' name='step' value='4'>\n";
	echo "<input type='submit' name='next' value='".$locale['007']."' class=\"btn btn btn-primary\">\n";
}
//Конец 3 шага установки

//Начало 4 шага установки
if (isset($_POST['step']) && $_POST['step'] == "4") {
	$db_host = stripinput(trim($_POST['db_host']));
	$db_user = stripinput(trim($_POST['db_user']));
	$db_pass = stripinput(trim($_POST['db_pass']));
	$db_name = stripinput(trim($_POST['db_name']));
	$db_prefix = stripinput(trim($_POST['db_prefix']));

	echo '<div class="progress progress-striped active">
	  <div class="bar" style="width: 51%;"></div>
	</div>';
if ($link = dbconnect($db_host, $db_user, $db_pass, $db_name)) {
		$config = "<?php\n";
		$config.= "/* \n";
		$config.= "     AMX MONITORING v.1.1.6\n";
		$config.= "	Разработчик: Virtus-pro\n\n";
		$config.= "	Сайт: www.amxservers.ru \n";
		$config.= "	\n";
		$config.= "	******Спасибо. Надеемся Вам понравится наш продукт.********\n";
		$config.= "*/\n\n";		
		
		$config .= "// Настройки базы данных\n";
		$config .= "$"."db_host = "."\"".$db_host."\";\n";
		$config .= "$"."db_user = "."\"".$db_user."\";\n";
		$config .= "$"."db_pass = "."\"".$db_pass."\";\n";
		$config .= "$"."db_name = "."\"".$db_name."\";\n";
		$config .= "$"."db_prefix = "."\"".$db_prefix."\";\n";
		$config .= "define("."\""."DB_PREFIX"."\"".", "."\"".$db_prefix."\");\n";
		$config .= "?>";
		$temp = fopen("config.php","w");
		if (fwrite($temp, $config)) {
		
			if(mysql_get_server_info()<5.5){
				$type_db_post="TYPE";
			}else{
				$type_db_post="ENGINE";
			}
			fclose($temp);
			$fail = false;
			$result = dbquery("DROP TABLE IF EXISTS ".$db_prefix."admin");
			$result = dbquery("CREATE TABLE ".$db_prefix."admin (
			admin_id MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
			admin_name VARCHAR(50) NOT NULL DEFAULT '',
			admin_pass VARCHAR(50) NOT NULL DEFAULT '',
			PRIMARY KEY (admin_id)
			) ".$type_db_post."=MyISAM;");

			if (!$result) { $fail = true; }

			$result = dbquery("DROP TABLE IF EXISTS ".$db_prefix."servers");
			$result = dbquery("CREATE TABLE ".$db_prefix."servers (
			server_id MEDIUMINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
			server_name VARCHAR(30) NOT NULL DEFAULT 'unknow',
			server_ip VARCHAR(25) NOT NULL DEFAULT '0.0.0.0',
			server_map VARCHAR(255) NOT NULL DEFAULT 'no_image',
			server_players VARCHAR(2) NOT NULL DEFAULT '0',
			server_maxplayers VARCHAR(2) NOT NULL DEFAULT '0',
			server_status TINYINT(1) NOT NULL DEFAULT '0',
			server_location VARCHAR(50) NOT NULL DEFAULT '',
			server_vip TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
			server_protokol VARCHAR(5) NOT NULL DEFAULT '',
			server_regdata TEXT NOT NULL,
			server_email VARCHAR(255) NOT NULL DEFAULT '',
			server_icq VARCHAR(30) NOT NULL DEFAULT '',
			server_new TINYINT(1) UNSIGNED NOT NULL DEFAULT '1',
			server_site VARCHAR(255) NOT NULL DEFAULT '',
			cron_time VARCHAR(50) ,
			votes MEDIUMINT(11) UNSIGNED NOT NULL,
			server_off TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
			PRIMARY KEY (server_id),
			FULLTEXT KEY server_map (server_map),
			FULLTEXT KEY server_protokol (server_protokol),
			FULLTEXT KEY server_ip (server_ip),
			FULLTEXT KEY server_players (server_players)
			) ".$type_db_post."=MyISAM;");

			if (!$result) { $fail = true; }
			
			$result = dbquery("DROP TABLE IF EXISTS ".$db_prefix."vote_ip");
			$result = dbquery("CREATE TABLE ".$db_prefix."vote_ip (
			vote_id MEDIUMINT(11) NOT NULL auto_increment,
			id_resp MEDIUMINT(11) NOT NULL,
			ip varchar(15) NOT NULL,
			date_resp datetime NOT NULL,
			PRIMARY KEY (vote_id)
			) ".$type_db_post."=MyISAM;");

			if (!$result) { $fail = true; }
			
			
			$result = dbquery("DROP TABLE IF EXISTS ".$db_prefix."pages");
			$result = dbquery("CREATE TABLE ".$db_prefix."pages (
			  `pages_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
			  `pages_subject` varchar(200) DEFAULT NULL,
			  `pages_extended` text,
			  `pages_datestamp` int(10) unsigned NOT NULL DEFAULT '0',
			  `pages_del` tinyint(1) unsigned NOT NULL DEFAULT '0',
			  PRIMARY KEY (`pages_id`),
			  KEY `pages_datestamp` (`pages_datestamp`)
			) ".$type_db_post."=MyISAM;");

			if (!$result) { $fail = true; }



			$result = dbquery("DROP TABLE IF EXISTS ".$db_prefix."news");
			$result = dbquery("CREATE TABLE ".$db_prefix."news (
				  `news_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
				  `news_subject` varchar(200) DEFAULT NULL,
				  `news_extended` text,
				  `news_datestamp` int(10) unsigned NOT NULL DEFAULT '0',
				  `news_del` tinyint(1) unsigned NOT NULL DEFAULT '0',
				  PRIMARY KEY (`news_id`),
				  KEY `news_datestamp` (`news_datestamp`)
			) ".$type_db_post."=MyISAM;");

			if (!$result) { $fail = true; }			
			
			

			$result = dbquery("DROP TABLE IF EXISTS ".$db_prefix."settings");
			$result = dbquery("CREATE TABLE ".$db_prefix."settings (
			sitename VARCHAR(200) NOT NULL DEFAULT '',
			siteurl VARCHAR(200) NOT NULL DEFAULT '',
			siteemail VARCHAR(100) NOT NULL DEFAULT '',
			siteusername VARCHAR(30) NOT NULL DEFAULT '',
			description TEXT NOT NULL,
			keywords TEXT NOT NULL,
			locale VARCHAR(20) NOT NULL DEFAULT 'Russian',
			enable_registration TINYINT(1) UNSIGNED DEFAULT '1' NOT NULL,
			license TEXT NOT NULL,
			version VARCHAR(10) NOT NULL DEFAULT '',
			AMX TEXT NOT NULL,
			proverka TEXT NOT NULL,
			maintenance TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
			maintenance_message TEXT NOT NULL,
			Generator TEXT NOT NULL,
			num_servers TINYINT(1) UNSIGNED NOT NULL DEFAULT '20',
			register_MG1 TEXT NOT NULL,
			register_MG2 TEXT NOT NULL,
			copy_mon TEXT NOT NULL,
			top_maps int(5),
			news_top int(5),
			top_servers int(5),			
			top_search int(5),
			all_serv_index int(1),
			all_serv_search int(1),
			register_off TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
			zname VARCHAR(50) NOT NULL
			) ".$type_db_post."=MyISAM;");



			if (!$result) { $fail = true; }

			if (!$fail) {
				echo "<br>\n".$locale['023']."<br><br>\n";
				echo "<span class=\"label label-success\">".$locale['025']."</span><br><br>\n";
				$success = true;
			} else {
				echo "<br>\n ".$locale['026']."<br><br>\n";
				echo "<strong>".$locale['026']."</strong> ".$locale['031']."<br><br>\n";
				$success = false;
				}
			} else {
			echo "<br>\n ".$locale['023']."<br><br>\n";
			echo "<strong>".$locale['026']."</strong> ".$locale['029']."</strong> <br>\n";
			echo "<span class='small'>".$locale['030']."</span><br><br>\n";
			$success = false;
			}
	} else {
		echo "<br>\n<strong>".$locale['026']."</strong> ".$locale['027']."<br>\n";
		echo "<span class='small'>".$locale['028']."</span><br><br>\n";
		$success = false;
	}
	echo "</td>\n</tr>\n<tr>\n<td class='tbl2' style='text-align:center'>\n";
	echo "<input type='hidden' name='localeset' value='".stripinput($_POST['localeset'])."'>\n";
	if ($success) {
		echo "<input type='hidden' name='step' value='5'>\n";
		echo "<input type='submit' name='next' value='".$locale['007']."' class=\"btn btn btn-primary\">\n";
	} else {
		echo "<input type='hidden' name='step' value='3'>\n";
		echo "<input type='submit' name='next' value='".$locale['008']."' class=\"btn btn btn-danger\">\n";
	}
}
//Конец 4 шага установки

//Начало 5 шага устновка

if (isset($_POST['step']) && $_POST['step'] == "5") {

	echo '<div class="progress progress-striped active">
	  <div class="bar" style="width: 68%;"></div>
	</div>';
	echo $locale['035'];
	echo "<table align='center' cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
	echo "<td class='tbl1'>".$locale['036']."</td>\n";
	echo "<td class='tbl1' style='text-align:right'><input type='text' name='username' maxlength='30' class='textbox' style='width:200px'></td></tr>\n";
	echo "<tr>\n<td class='tbl1'>".$locale['037']."</td>\n";
	echo "<td class='tbl1' style='text-align:right'><input type='password' name='password1' maxlength='20' class='textbox' style='width:200px'></td></tr>\n";
	echo "<tr>\n<td class='tbl1'>".$locale['038']."</td>\n";
	echo "<td class='tbl1' style='text-align:right'><input type='password' name='password2' maxlength='20' class='textbox' style='width:200px'></td></tr>\n";
	echo "<tr>\n<td class='tbl1'>".$locale['sittings001']."</td>\n";
	echo "<td class='tbl1' style='text-align:right'><input type='text' name='url' maxlength='100' value='http://".$_SERVER['HTTP_HOST'].strrev(stristr(strrev($_SERVER['REQUEST_URI']),'/'))."' class='textbox' style='width:200px'></td></tr>\n" ;
	
	echo "</table>\n";
	echo "</td>\n</tr>\n<tr>\n<td class='tbl2' style='text-align:center'>\n";
	echo "<input type='hidden' name='localeset' value='".stripinput($_POST['localeset'])."'>\n";
	echo "<input type='hidden' name='step' value='6'>\n";
	echo "<input type='submit' name='next' value='".$locale['007']."' class=\"btn btn btn-primary\">\n";
}
//Конец 5 шага установки

//Начало 6 шага устновка

if (isset($_POST['step']) && $_POST['step'] == "6") {


	require_once "config.php";
	$link = dbconnect($db_host, $db_user, $db_pass, $db_name);

	$error = "";

	$username = stripinput($_POST['username']);
	$password1 = stripinput($_POST['password1']);
	$password2 = stripinput($_POST['password2']);
	$url = stripinput($_POST['url']);

	if (!preg_match("/^[-0-9A-Z_@\s]+$/i", $username)) {
		$error .= $locale['040'];
	}

	if (preg_match("/^[0-9A-Z@]{6,20}$/i", $password1)) {
		if ($password1 != $password2) {
			$error .= $locale['041'];
		}
	} else {
		$error .= $locale['042'];
	}





	if ($error == "") {


		$result = dbquery("INSERT INTO `".$db_prefix."settings` (`sitename`, `siteurl`, `siteemail`, `siteusername`, `description`, `keywords`, `locale`, `enable_registration`, `license`, `version`, `AMX`, `proverka`, `maintenance`, `maintenance_message`, `Generator`, `num_servers`, `register_MG1`, `register_MG2`, `copy_mon`, `register_off`, `zname`,`top_maps`,`news_top`,`top_servers`,`top_search`,`all_serv_index`,`all_serv_search`) VALUES
			('AMX Monitoring', '".$url."', 'admin@".$_SERVER['SERVER_NAME']."', 'AMX MONITORING', 'AMX SERVER - мониторинг серверов counter strike . Серверы CS 1.6.', 'сервера cs, мониторинг, cs 1.6, counter strike', 
			 '".stripinput($_POST['localeset'])."', 1, 'Copyright &copy; ".date("Y")."', '1.1.6', '<!-- Copyright AMX Monitoring -->', '', 0, 'Технические работы', 'AMX Monitoring', 20, ' ', 'Спасибо!<br>Скоро Ваш сервер появится в мониторинге.', 'AMX Monitoring', 0, 'AMX Monitoring','5','4','15','20','0','0');");

	
			
		$pass=md5(md5($password1));
 		$result = dbquery("INSERT INTO ".$db_prefix."admin (admin_name, admin_pass) VALUES ('".$username."', '".$pass."')");

   	echo $locale['060'];
		echo "</td>\n</tr>\n<tr>\n<td class='tbl2' style='text-align:center'>\n";
		echo "<input type='hidden' name='localeset' value='".stripinput($_POST['localeset'])."'>\n";
		echo "<input type='hidden' name='step' value='7'>\n";
		echo "<input type='submit' name='next' value='".$locale['009']."' class=\"btn btn btn-primary\">\n";
	} else {
	
		echo '<div class="progress progress-danger progress-striped">
		  <div class="bar" style="width: 80%;"></div>
		</div>';		
		echo "<br>\n ".$locale['044']."<br><br>\n".$error;
		echo "</td>\n</tr>\n<tr>\n<td class='tbl2' style='text-align:center'>\n";
		echo "<input type='hidden' name='localeset' value='".stripinput($_POST['localeset'])."'>\n";
		echo "<input type='hidden' name='step' value='5'>\n";
		echo "<input type='submit' name='back' value='".$locale['008']."' class=\"btn btn btn-primary\">\n";
	}
}
echo "</td>\n</tr>\n";
echo "</table></div>\n</form>\n";

echo "<br>";

echo "</body>\n</html>\n";
// mySQL функции
function dbquery($query) {
	$result = @mysql_query($query);
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
		return false;
	} else {
		return true;
	}
}
// Создание списка локалей и помещение в массив
function makefilelist($folder, $filter, $sort=true, $type="files") {
	$res = array();
	$filter = explode("|", $filter);
	$temp = opendir($folder);
	while ($file = readdir($temp)) {
		if ($type == "files" && !in_array($file, $filter)) {
			if (!is_dir($folder.$file)) $res[] = $file;
		} elseif ($type == "folders" && !in_array($file, $filter)) {
			if (is_dir($folder.$file)) $res[] = $file;
		}
	}
	closedir($temp);
	if ($sort) sort($res);
	return $res;
}

// Функция извлекающая HTML теги
function stripinput($text) {
	if (QUOTES_GPC) $text = stripslashes($text);
	$search = array("&", "\"", "'", "\\", '\"', "\'", "<", ">", "&nbsp;");
	$replace = array("&amp;", "&quot;", "&#39;", "&#92;", "&quot;", "&#39;", "&lt;", "&gt;", " ");
	$text = str_replace($search, $replace, $text);
	return $text;
}

// Создание выбираемого списка для makefilelist()
function makefileopts($files, $selected = "") {
	$res = "";
	for ($i=0; $i < count($files); $i++) {
		$sel = ($selected == $files[$i] ? " selected='selected'" : "");
		$res .= "<option value='".$files[$i]."'$sel>".$files[$i]."</option>\n";
	}
	return $res;
}
?>