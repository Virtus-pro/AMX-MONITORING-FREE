<?php
/* 
     AMX MONITORING v.1.1.6
	Разработчик: Virtus-pro

	Сайт: www.amxservers.ru 
	
	******Спасибо. Надеемся Вам понравится наш продукт.********
*/
if (empty($_SESSION['admin_name']) or empty($_SESSION['admin_id']))die("Доступ запрещен");

include LOCALE.LOCALESET."/admin/info.php";
$id=intval($_GET['serv']);
$q = dbquery("SELECT * FROM ".DB_SERVERS." WHERE server_id = ".$id."");
$serv=dbarray_fetch($q);
$img = "<img src='../images/maps/default.jpg' alt='".$locale_view['001']."' width='160' height='120' class='map'>";
if (file_exists("../images/maps/".$serv['server_map'].".jpg"))
{$img = "<img src='../images/maps/".$serv['server_map'].".jpg' alt='".$serv['server_name']."' width='160' height='120' class='map'>";}
echo "<div style='width:650px;'><form name='servform' method='post' action='admin/".AMX_SELF."?id=obpost'>";
echo "<table width='500' class=\"table\"><tbody>";
echo "<b><div class=\"alert alert-info\">".$serv['server_name']."</div></b><br><br>";
echo $img."<br>";
echo "<b><br>".$serv['server_map']."</b></center><br>";

echo "<tr>";
echo "<td   ><br>".$locale_view['002']."</td>";
echo "<td  ><input name='votes' type='number' class='textbox' style='width:70px;' value='".$serv['votes']."' maxlength='11' /></td>";
echo "</tr><tr>";
echo "<td  >".$locale_view['011']."</td>";
echo "<td  ><select name='off' class='textbox'>\n";
echo "<option value='1'".($serv['server_off'] == 1 ? " selected='selected'" : "").">".$locale_view['004']."</option>\n";
echo "<option value='0'".($serv['server_off'] == 0 ? " selected='selected'" : "").">".$locale_view['005']."</option>\n";
echo "</select></td>\n";
echo "</tr><tr>";
echo "<td  >".$locale_view['014']."</td>";
echo "<td  ><select name='vip' class='textbox'>\n";
echo "<option value='1'".($serv['server_vip'] == 1 ? " selected='selected'" : "").">".$locale_view['004']."</option>\n";
echo "<option value='0'".($serv['server_vip'] == 0 ? " selected='selected'" : "").">".$locale_view['005']."</option>\n";
echo "</select></td>\n";
echo "</tr>";

echo "<tr>";
echo "<td   ><br>E-mail</td>";
echo "<td  ><input name='email' type='text' class='textbox' style='width:200px;' value='".$serv['server_email']."' /></td>";
echo "</tr>";
echo "<tr>";
echo "<td  ><br>Дата регистрация</td>";
echo "<td  ><input name='data' type='text' class='textbox' style='width:80px;' value='".date("d.m.Y",$serv['server_regdata'])."' disabled/></td>";
echo "</tr>";
echo "<tr>";
echo "<td   ><br>Сайт</td>";
echo "<td  ><input name='site' type='text' class='textbox' style='width:200px;' value='".$serv['server_site']."' /></td>";
echo "</tr>";
echo "<tr>";
echo "<td   ><br>ICQ</td>";
echo "<td  ><input name='icq' type='text' class='textbox' style='width:100px;' value='".$serv['server_icq']."' /></td>";
echo "</tr>";
echo "<tr>";
echo "<td align='center' colspan='2'><br />";
echo "<input type='hidden' name='serv' value='".$id."'>";
echo "<input type='submit' name='save_serv' value='".$locale_view['012']."' class='btn btn-primary'> <input type='submit' name='delite_serv' value='Удалить сервер' class='btn btn-danger'> <a href='admin/index.php?id=servers' class='btn btn-info'>Все сервера</a></td>";
echo "</tr></tbody></table></form></div>";