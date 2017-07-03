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



if(isset($_POST['password_old'])){
		$error="";
		$pass_old=$_POST['password_old'];
		$pass_new1=$_POST['password_new'];
		$pass_new2=$_POST['password_new2'];
		$userdata = dbarray_fetch(dbquery("SELECT * FROM ".DB_ADMIN." WHERE admin_id='".intval($_SESSION['admin_id'])."'"));
		$pass_md5=md5(md5($pass_old));
		if($pass_md5!=$userdata['admin_pass']) {
		$error .= "<li>Старый пароль не верный</li>";
		}
		if($pass_new1!="") {
			if (preg_match("/^[0-9A-Z@]{4,20}$/i", $pass_new1)) {
				if ($pass_new1 != $pass_new2) $error .= "<li>Новые пароли не совпадают</li>";
			} else {
				$error .= "<li>Не правильно введен новый пароль, он должен состоять минимум из 4-х символов</li>";
			}	
		}else{
		  $error .= "<li>Введите новый пароль</li>";
      
		}
	if($error=="") {
		

		$result=dbquery("UPDATE ".DB_ADMIN." SET admin_pass='".md5(md5($pass_new1))."'  WHERE admin_id='".intval($_SESSION['admin_id'])."' LIMIT 1 ");
		if($result) {
		echo "<div class=\"alert alert-success\" style=\"width:500px\"> Пароль успешно изменен</center></div>";
			}else{
		echo "<div class=\"alert alert-error\" style=\"width:500px\"><center> Ошибка при изменении пароля</center></div>";	
		}
		
		}else{
		
	echo "<center><div class=\"alert alert-error\" style=\"width:500px;text-align:left\"><ul>".$error."</ul></div></center>";	
	}

}


echo "<center><form name='admin_pass' method='post' >";
echo "<table cellpadding='0' cellspacing='0' width='500' class='center'>";
echo "<tr>";
echo "<td width='50%' >Старый пароль</td>";
echo "<td width='50%' ><input name='password_old' type='password'' class='textbox' style='width:230px;' value=''  /></td>";
echo "</tr><tr>";
echo "<td width='50%' >Новый пароль</td>";
echo "<td width='50%' ><input name='password_new' type='password'' class='textbox' style='width:230px;' value=''  /></td>";
echo "</tr>";
echo "<tr>";
echo "<td width='50%' >Подтверждение нового пароля</td>";
echo "<td width='50%' ><input name='password_new2' type='password'' class='textbox' style='width:230px;' value=''  /></td>";
echo "</tr>";


echo "<tr>";
echo "<td align='center' colspan='2'><br />";
echo "<input type='submit'  value='Изменить пароль' class='btn btn-primary' /></td>";
echo "</tr></table></form></center>";