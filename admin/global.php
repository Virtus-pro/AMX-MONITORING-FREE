<?php
/* 
     AMX MONITORING v.1.1.6
	Разработчик: Virtus-pro

	Сайт: www.amxservers.ru 
	
	******Спасибо. Надеемся Вам понравится наш продукт.********
*/
if (empty($_SESSION['admin_name']) or empty($_SESSION['admin_id']))die("Доступ запрещен");

include LOCALE.LOCALESET."/admin/global.php";
$locale_files = makefilelist(LOCALE, ".|..", true, "folders");
echo "<form name='settingsform' method='post' action='admin/index.php?id=obpost'>";
echo "<table cellpadding='0' cellspacing='0' width='500' class='center'>";
echo "<tr>";
echo "<td width='50%' >".$locale_global['001']."</td>";
echo "<td width='50%' ><input name='sitename' type='text' class='textbox' style='width:230px;' value='".$settings['sitename']."' maxlength='255' /></td>";
echo "</tr><tr>";
echo "<td width='50%' >".$locale_global['002']."</td>";
echo "<td width='50%' ><input name='zname' type='text' class='textbox' style='width:230px;' value='".$settings['zname']."' maxlength='50' /></td>";
echo "</tr><tr>";
echo "<td width='50%' >".$locale_global['003']."</td>";
echo "<td width='50%' ><input name='siteurl' type='text' class='textbox' style='width:230px;' value='".$settings['siteurl']."' maxlength='255' /></td>";
echo "</tr><tr>";
echo "<td width='50%' >".$locale_global['004']."</td>";
echo "<td width='50%' ><input name='siteemail' type='text' class='textbox' style='width:230px;' value='".$settings['siteemail']."' maxlength='128' /></td>";
echo "</tr><tr>";
echo "<td width='50%' >".$locale_global['005']."</td>";
echo "<td width='50%' ><input name='username' type='text' class='textbox' style='width:230px;' value='".$settings['siteusername']."' maxlength='32' /></td>";
echo "</tr><tr>";
echo "<td valign='top' width='50%' >".$locale_global['013']."</td>";
echo "<td width='50%' ><textarea name='cm' cols='50' rows='6' class='textbox' style='width:230px;'>".$settings['copy_mon']."</textarea></td>";
echo "</tr><tr>";
echo "<td valign='top' width='50%' >".$locale_global['006']."</td>";
echo "<td width='50%' ><textarea name='description' cols='50' rows='6' class='textbox' style='width:230px;'>".$settings['description']."</textarea></td>";
echo "</tr><tr>";
echo "<td valign='top' width='50%' >".$locale_global['007']."<br /><span class='small2'>".$locale_global['008']."</span></td>";
echo "<td width='50%' ><textarea name='keywords' cols='50' rows='6' class='textbox' style='width:230px;'>".$settings['keywords']."</textarea></td>";
echo "</tr><tr>";
echo "<td valign='top' width='50%' >".$locale_global['009']."</td>";
echo "<td width='50%' ><textarea name='license' cols='50' rows='6' class='textbox' style='width:230px;'>".$settings['license']."</textarea></td>";
echo "</tr><tr>";
echo "<td width='50%' >".$locale_global['010']."</td>";
echo "<td width='50%' ><select name='localeset' class='textbox'>";
echo makefileopts($locale_files, $settings['locale'])."\n";
echo "</select></td></tr>";

echo "<tr>";
echo "<td align='center' colspan='2'><br />";
echo "<input type='hidden' name='old_localeset' value='".$settings['locale']."' />\n";
echo "<input type='submit' name='savesettings' value='".$locale_global['012']."' class='btn btn-primary' /></td>";
echo "</tr></table></form>";