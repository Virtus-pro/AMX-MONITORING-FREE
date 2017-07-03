<?php
/* 
     AMX MONITORING v.1.1.6
	Разработчик: Virtus-pro

	Сайт: www.amxservers.ru 
	
	******Спасибо. Надеемся Вам понравится наш продукт.********
*/
if (empty($_SESSION['admin_name']) or empty($_SESSION['admin_id']))die("Доступ запрещен");

include LOCALE.LOCALESET."/admin/other.php";
echo"<form name='settingsform' method='post' action='admin/".AMX_SELF."?id=obpost'>";
echo"<table cellpadding='0' cellspacing='0' width='500' class='center'>";
echo"<tr>";
echo"<td width='50%' >".$locale_other['001']."</td>";
echo"<td width='50%' >";
echo"<input type='checkbox' name='null' value='checkbox'>";
echo"</td></tr><tr>";
echo"<td width='50%' >".$locale_other['002']."</td>";
echo "<td width='50%' ><select name='register_global' class='textbox'>\n";
echo "<option value='1'".($settings['enable_registration'] == 1 ? " selected='selected'" : "").">".$locale_other['003']."</option>\n";
echo "<option value='0'".($settings['enable_registration'] == 0 ? " selected='selected'" : "").">".$locale_other['004']."</option>\n";
echo "</select></td>\n";
echo"</tr><tr>";
echo"<td width='50%' >Проверять сервера пред добавлением в мониторинг?</td>";
echo "<td width='50%' ><select name='register_off' class='textbox'>\n";
echo "<option value='1'".($settings['register_off'] == 1 ? " selected='selected'" : "").">".$locale_other['003']."</option>\n";
echo "<option value='0'".($settings['register_off'] == 0 ? " selected='selected'" : "").">".$locale_other['004']."</option>\n";
echo "</select></td>\n";
echo"</tr><tr>";
echo"<td valign='top' width='50%' ><br><br>".$locale_other['005']."</td>";
echo"<td width='50%' ><textarea name='register_MG1' cols='50' rows='6' class='textbox' style='width:230px;'>".$settings['register_MG1']."</textarea></td>";
echo"</tr><tr>";
echo"<td valign='top' width='50%' >".$locale_other['006']."</td>";
echo"<td width='50%' ><textarea name='register_MG2' cols='50' rows='6' class='textbox' style='width:230px;'>".$settings['register_MG2']."</textarea></td>";
echo"</tr>";
echo"<tr>";
echo"<td valign='top' width='50%' >ТОП КАРТ на главной (количество)</td>";
echo"<td width='50%' ><input lass=\"input-mini\" type=\"number\"  name=\"top_maps\" size=\"4\" value=\"".$settings['top_maps']."\" onkeyup=\"this.value = this.value.replace (/\D/, '')\" style='width: 60px'></td>";
echo"</tr>";
echo"<tr>";
echo"<td valign='top' width='50%' >Новостей на главной внизу (количество)</td>";
echo"<td width='50%' ><input lass=\"input-mini\" type=\"number\"  name=\"news_top\" size=\"4\" value=\"".$settings['news_top']."\" onkeyup=\"this.value = this.value.replace (/\D/, '')\" style='width: 60px'></td>";
echo"</tr>";
echo"<tr>";
echo"<td valign='top' width='50%' >Серверов на главной</td>";
echo"<td width='50%' ><input lass=\"input-mini\" type=\"number\"  name=\"top_servers\" size=\"4\" value=\"".$settings['top_servers']."\" onkeyup=\"this.value = this.value.replace (/\D/, '')\" style='width: 60px'></td>";
echo"</tr>";
echo"<tr>";
echo"<td valign='top' width='50%' >Количество результатов при поиске</td>";
echo"<td width='50%' ><input lass=\"input-mini\" type=\"number\"  name=\"top_search\" size=\"4\" value=\"".$settings['top_search']."\" onkeyup=\"this.value = this.value.replace (/\D/, '')\" style='width: 60px'></td>";
echo"</tr>";
echo"<tr>";
echo"<td width='50%' >Показывать выключенные сервера на главной?</td>";
echo"<td width='50%' >";
if($settings['all_serv_index']==1){$cheked= "checked";}else{$cheked="";}
echo"<input type='checkbox' name='all_serv_index' value='checkbox' ".$cheked."> Да";
echo"</td></tr>";
echo"<tr>";
echo"<td width='50%' >Показывать выключенные сервера при поиске?</td>";
echo"<td width='50%' >";
if($settings['all_serv_search']==1){$cheked= "checked";}else{$cheked="";}
echo"<input type='checkbox' name='all_serv_search' value='checkbox'  ".$cheked."> Да";
echo"</td></tr>";
echo"<tr><td width='50%' >".$locale_other['007']."</td>";
echo "<td width='50%' ><select name='maintenance' class='textbox'>\n";
echo "<option value='1'".($settings['maintenance'] == 1 ? " selected='selected'" : "").">Да</option>\n";
echo "<option value='0'".($settings['maintenance'] == 0 ? " selected='selected'" : "").">Нет</option>\n";
echo "</select></td>\n";
echo"</tr>";



echo"<tr><td valign='top' width='50%' >".$locale_other['010']."</td>";
echo"<td width='50%' ><textarea name='m_message' cols='50' rows='6' class='textbox' style='width:230px;'>".$settings['maintenance_message']."</textarea></td>";
echo"</tr>";
echo"<td align='center' colspan='2'><br />";
echo"<input type='submit' name='savesettings_other' value='".$locale_other['008']."' class='btn btn-primary' /></td>";
echo"</tr>";





echo"</table>";
echo"</form>";