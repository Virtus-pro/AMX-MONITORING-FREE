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


require_once "maincore.php";
require_once LOCALE.LOCALESET."view.php";
if ($_GET['id']!='')
  {
$id=intval($_GET['id']);
$bg=htmlspecialchars($_GET['bg']); 
$text=htmlspecialchars($_GET['text']); 
$a=htmlspecialchars($_GET['link']); 
$w=htmlspecialchars($_GET['ip']); 
echo "<!DOCTYPE HTML PUBLIC '-//W3C//DTD XHTML 1.1//EN' 'http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd'>\n";
echo "<html xml:lang='ru' xmlns='http://www.w3.org/1999/xhtml'><head profile='http://gmpg.org/xfn/11'>\n";
echo "<title>".$settings['sitename']."</title>\n";
echo "<meta http-equiv='Content-Type' content='text/html'>\n";
echo "<meta name='description' content='".$settings['description']."' />\n";
echo "<meta name='keywords' content='".$settings['keywords']."' />\n";
?>
<style type='text/css'>		
body {
margin:5px;
background:#<?=$bg?>;
color:#<?=$text?>;
font:11px 'trebuchet ms',tahoma,arial,serif;
text-align:center;
}

.w {
	color:#<?=$w?>;
}
a {
	color:#<?=$a?>;
	text-decoration:nonde;
}
</style>
<?	
echo "<link rel='stylesheet' href='".THEM."style_view.css' type='text/css'></link>\n";	
echo"<link rel='shortcut icon' href='".$settings['siteurl']."/favicon.ico'>
</head><body>";
$q = dbquery("SELECT * FROM ".DB_SERVERS." WHERE server_id = ".$id."");
$serv=dbarray_fetch($q);
if($serv['server_status']==0){
$img = "<img src='images/maps/off.jpg' alt='".$locale_view['001']."' width='160' height='120' class='map'>";
echo "<a href='".$settings['siteurl']."?id=info&serv=".$id."' target='_blank'>".$serv['server_name']."</a><br><a href='".$settings['siteurl']."?id=info&serv=".$id."' target='_blank'>".$img."</a><br>";
echo "<table cellpadding='0' cellspacing='1' width='90%'>";
echo "	<tbody><tr><td width='50'>".$locale_view['012'].":</td><td>N/A</td></tr>";
echo "<tr><td width='50'>".$locale_view['011'].":</td><td>N/A</td></tr>";
echo "<tr><td height='10'></td></tr>";
echo "<tr><td colspan='2' class='w' align='center'>".$serv['server_ip']."</td></tr>";
echo "</tbody></table><p><a href='".$settings['siteurl']."' target='_blank'>".$settings['copy_mon']."</a></p>	</body></html>";
		}
else
{$img = "<img src='images/maps/default.jpg' alt='".$locale_view['001']."' width='160' height='120' class='map'>";
if (file_exists("images/maps/".$serv['server_map'].".jpg"))
{$img = "<img src='".BASEDIR."images/maps/".$serv['server_map'].".jpg' alt='".$serv['server_name']."' width='160' height='120' class='map'>";}
echo "<a href='".$settings['siteurl']."?id=info&serv=".$id."' target='_blank'>".$serv['server_name']."</a><br><a href='".$settings['siteurl']."?id=info&serv=".$id."' target='_blank'>".$img."</a><br>";
echo "<table cellpadding='0' cellspacing='1' width='90%'>";
echo "<tbody><tr><td width='50'>".$locale_view['012'].":</td><td>".$serv['server_map']."</td></tr>";
echo "<tr><td width='50'>".$locale_view['011'].":</td><td>".$serv['server_players']." / ".$serv['server_maxplayers']."</td></tr>";
echo "<tr><td height='10'></td></tr>";
echo "<tr><td colspan='2' class='w' align='center'>".$serv['server_ip']."</td></tr>";
echo "</tbody></table><p><a href='".$settings['siteurl']."' target='_blank'>".$settings['copy_mon']."</a></p>	</body></html>";}
}
else
	{header("Location: /"); exit;}
?>
