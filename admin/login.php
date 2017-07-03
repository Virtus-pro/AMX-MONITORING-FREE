<?php
/* 
     AMX MONITORING v.1.1.6
	Разработчик: Virtus-pro

	Сайт: www.amxservers.ru 
	
	******Спасибо. Надеемся Вам понравится наш продукт.********
*/
// подключаемся к базе
include "../maincore.php";
if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
if (isset($_POST['password'])) { $password = stripinput($_POST['password']); if ($password =='') { unset($password);} }
//заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную

if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
{
echo "<center><br><br><br><br><br><b>Вы ввели не всю информацию, венитесь назад и заполните все поля!<b></center>";

        echo "<script type='text/javascript'>document.location.href='".$settings['siteurl']."admin/'</script>\n";
		
exit();
}

//если логин и пароль введены,то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
$login = stripslashes($login);
$login = htmlspecialchars($login);
$password=md5(md5($password));

//удаляем лишние пробелы
$login = trim($login);
lamx();

$result = dbquery("SELECT * FROM ".DB_ADMIN." WHERE admin_name='".$login."'"); //извлекаем из базы все данные о пользователе с введенным логином
$myrow = dbarray_fetch($result);
if (empty($myrow['admin_pass']))
{
	//если пользователя с введенным логином не существует
	echo "<center><br><br><br><br><br><b>Извините, введённый вами логин или пароль неверный.<b></center>";
	echo "<script type='text/javascript'>document.location.href='".$settings['siteurl']."admin/'</script>\n";
	exit();
}
else {
//если существует, то сверяем пароли
          if ($myrow['admin_pass']==$password) {
			  //если пароли совпадают, то запускаем пользователю сессию! Можете его поздравить, он вошел!
			  $_SESSION['admin_name']=$myrow['admin_name']; 
			  $_SESSION['admin_id']=$myrow['admin_id'];//эти данные очень часто используются, вот их и будет "носить с собой" вошедший пользователь
          }

       else {
       //если пароли не сошлись
		echo"<center><br><br><br><br><br><b>Извините, введённый вами логин или пароль неверный.<b></center>";
		echo "<script type='text/javascript'>document.location.href='".$settings['siteurl']."admin/'</script>\n";
		exit();
	   }
}
echo "<html><head><meta http-equiv='Refresh' content='2; URL=".$settings['siteurl']."admin'></head>";
?><body>

<br><br><br><br><br><br><br><br>
<body><table height="104" border="1" align="center" bordercolor="#3C3A36">
  <tr bordercolor="#999999">
<td width="294"><font color="3C3A36"><center><strong>Вы вошли под именем <font color="#FF0000"><?=$_SESSION['admin_name']?></font></strong><br>
    <br> <br>
    <small>[<a href='<?=$settings['siteurl']?>admin'> Если не хотите ждать, нажмите сюда</a>]</small></center></font></td>
</tr>
</table>
</body>


</html>