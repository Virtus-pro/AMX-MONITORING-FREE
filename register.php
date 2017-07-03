<?php
/* 
     AMX MONITORING v.1.1.6
	Разработчик: Virtus-pro

	Сайт: www.amxservers.ru 
	
	******Спасибо. Надеемся Вам понравится наш продукт.********
*/
require_once LOCALE.LOCALESET."register.php";
echo "<title>".$locale['reg001']." | ".$settings['sitename']."</title>";
echo"</head>";
require_once INCLUDES."countries.php";

if($settings['enable_registration']==1){




echo "<center>";



echo '<h1>Регистрация сервера</h1>	<br>';

echo "<form name='inputform' method='post' action='".AMX_SELF."?id=add' onsubmit='return ValidateForm(this)'>\n";
echo "<table align='center' cellpadding='0' cellspacing='1' width='400' class='tbl-border'>\n<tr>\n";
echo "<td class='tbl2'><strong>";


if (!isset($_POST['step']) || $_POST['step'] == "" || $_POST['step'] == "1") {
echo "</strong></td>\n</tr>\n<tr>\n<td class='tbl1'style='text-align:center'>\n";
	echo $settings['register_MG1'];
	echo "<table align='center' cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
	echo "<td class='tbl1'>".$locale['reg003']."<span style='color:#ff0000'>*</span></td>\n";
	echo "<td class='tbl1' style='text-align:right'>";
	?><input type="text" name="server_ip" value="IP" class='textbox' onFocus="if(this.value=='IP')this.value='';" style='width:200px'></td> <td></td></tr><?
	echo "<tr>\n<td class='tbl1'>".$locale['reg004']."<span style='color:#ff0000' >*</span></td>\n";
	echo "<td class='tbl1' style='text-align:right'>";
	?><input type="text" name="server_port" value="Порт" class='textbox' onFocus="if(this.value=='<?=$locale['reg011']?>')this.value='';" style='width:200px'></td> <td></td></tr><?

	echo "<tr><td>".$locale['reg007']."<span style='color:#ff0000' >*</span></td>\n";
	echo "<td style='text-align:right'>".csm_makeSelbox()."</td>";?><td></td></tr><?php
	echo "<tr><td>".$locale['reg008']."<span style='color:#ff0000' >*</span></td>\n";
	echo "<td style='text-align:right'><input type='text' value='' name='email' class='textbox' style='width:200px'></td>";?><td></td></tr><?php
	echo "<tr><td>".$locale['reg009']."</td>\n";
	echo "<td style='text-align:right'><input type='text' value='' name='icq' class='textbox' style='width:200px'></td>";?><td></td></tr><?php
	echo "<tr><td>".$locale['reg010']."</td>\n";
	echo "<td style='text-align:right'>http://<input type='text' value='' name='www' class='textbox' style='width:180px'></td>";?><td></td></tr><?php

	?><tr><td ><img src="img.php?<?php echo session_name()?>=<?php echo session_id()?>" alt='<?=$locale['reg018']?>'></td><?
	echo"\n";
	echo "<td style='text-align:right'>  ";
	?><input type="text" name="keystring" value="Код с картинки" class='textbox' onFocus="if(this.value=='<?=$locale['reg019']?>')this.value='';" style='width:200px'></td> <td></td></tr><?
	
	echo "</table>\n";
	echo "</td>\n</tr>\n<tr>\n<td style='text-align:center'>\n";
	echo "<input type='hidden' name='step' value='2'>\n";
	echo "<input type='submit' name='next' value='Далее' class=\"button btn btn-primary btn-large\">\n";

}
if (isset($_POST['step']) && $_POST['step'] == "2") {
	$error = "";
	$server_ip = stripinput($_POST['server_ip']);
	$server_port = stripinput($_POST['server_port']);
	$captcha = stripinput($_POST['keystring']);
    $server_location =stripinput($_POST['server_location']);
    $email=stripinput($_POST['email']);
    $icq=stripinput($_POST['icq']);
	$www=stripinput($_POST['www']);
	$result="SELECT * FROM ".DB_SERVERS." WHERE server_ip = '".$server_ip.":".$server_port."'";
	$dbresult=mysql_query($result);
	$n=mysql_num_rows($dbresult);
	if($n) {$error .=$locale['reg021']."<br><br>\n";}


    if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] !== $captcha){
		$error .= $locale['reg023']."<br><br>\n";
        }
	unset($_SESSION['captcha_keystring']);



	if(strlen($server_ip)>3){
		$server_ip=mysql_real_escape_string(htmlspecialchars($server_ip));
	}else{
		$error .= $locale['reg025']."<br><br>\n";
	}

 	if (!preg_match("/^[0-9]{5,5}$/i", $server_port)) {
		$error .= $locale['reg025']."<br><br>\n";
	}

	if($server_location=='')  $error .= "Вы не выбрали месторасположение сервера.<br><br>\n";
    	if (!preg_match("/^[-0-9A-Z_\.]{1,50}@([-0-9A-Z_\.]+\.){1,50}([0-9A-Z]){2,4}$/i", $email)) {
		$error .= $locale['reg026']."<br />\n";
	}
	if($icq !=""){
	if(!preg_match("/^[0-9]{5,30}$/i", $icq))$error .= $locale['reg027']."<br><br>\n";}
	if ($error == "") {
	
   if($settings['register_off']==1){
   $reg_off=1;
   }else {
   $reg_off=0;
   }
   $date_resp = date("d-m-Y:G-i-s",time()); // запоминаем дату
   $result = dbquery("INSERT INTO ".DB_SERVERS."(server_name, server_ip, server_map, server_players,server_maxplayers, server_status, server_location, server_vip,  server_regdata, server_email, server_icq,server_new, server_site ) VALUES ('0','".$server_ip.":".$server_port."','','','','0', '".$server_location."', '0', '".time()."','".$email."','".$icq."','".$reg_off."','".$www."')");

		echo "</strong></td>\n</tr>\n<tr>\n<td class='tbl1'style='text-align:center'>\n";
		echo "<div class=\"alert alert-success\">".$settings['register_MG2']."</div>";

	} else {
		echo "</strong></td>\n</tr>\n<tr>\n<td class='tbl1'style='text-align:center'>\n";
		echo "<br>\n <h2>".$locale['reg028']."</h2><br><br>\n<div class=\"alert alert-error\">".$error."</div>";
		echo "</td>\n</tr>\n<tr>\n<td class='tbl2' style='text-align:center'>\n";
		echo "<input type='hidden' name='step' value='1'>\n";
		echo "<input type='submit' name='back' value='Назад' class=\"button btn btn-danger btn-large\">\n";
	}

}

echo "</td>\n</tr>\n";
echo "</table>\n</form>\n";
}
else {
echo "<center><br><br><br><br><br><br><br><br><br><br><b><font size='3'>".$locale['reg029']."</font></b></center><br><br><br><br><br><br><br><br><br><br><br><br>";
}

?>