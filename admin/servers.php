<?php
/* 
     AMX MONITORING v.1.1.6
	Разработчик: Virtus-pro

	Сайт: www.amxservers.ru 
	
	******Спасибо. Надеемся Вам понравится наш продукт.********
*/
if (empty($_SESSION['admin_name']) or empty($_SESSION['admin_id']))die("Доступ запрещен");

include LOCALE.LOCALESET."/admin/servers.php";
?><div style="display:inline">
<form style="display:inline" class="form-search" method='post' action='admin/index.php?id=servers'>
  <div class="input-append">
   Поиск по ID сервера <input name="search" type="number" value="<?php if(isset($_POST['search'])) echo intval($_POST['search']);?>"  class="span2 search-query" style="width:50px">
    <button type="submit" class="btn">Найти</button>
  </div>

</form>
&nbsp;&nbsp;&nbsp;&nbsp;
<form style="display:inline" class="form-search" method='post' action='admin/index.php?id=servers'>
  <div class="input-append">
   Поиск по Email сервера <input name="email" type="text" value="<?php if(isset($_POST['email'])) echo stripinput($_POST['email']);?>" class="span2 search-query" style="width:200px">
    <button type="submit" class="btn">Найти</button>
  </div>

</form></div><br><br>
<?php
if(isset($_POST['search'])){
	$id_serv_s=intval($_POST['search']);
	if($id_serv_s==0){
		echo "<center><div class=\"alert alert-error\" style='width:500px'>Не верный формат ID сервера</div></center>";
		$search_id="";
	}else{
		$search_id=" WHERE server_id='".$id_serv_s."'";
	}
	
}else{
	$search_id="";
}

if(isset($_POST['email'])){
	$email=stripinput($_POST['email']);
	if($email==""){
		echo "<center><div class=\"alert alert-error\" style='width:500px'>Вы не ввели E-mail</div></center>";
		$email="";
	}else{
		if(isset($_POST['search'])){
			$email=" AND server_email LIKE '%".$email."%'";
		}else{
			$email=" WHERE server_email LIKE '%".$email."%'";
		}
		
	}
	
}else{
	$email="";
}



$perpage = 30;
if (isset($_GET['page'])) {
    if ($_GET['page'] <= 1) {
        $page = 1;

    } else {
        $page = intval($_GET['page']); // Страница на которой мы находимся
    }
} else {
    $page = 1; // Если не на какой, то открывается первая страница
}


// Общее количество информации
$num_row = dbquery("SELECT server_id FROM ".DB_SERVERS . " ".$search_id." ".$email." ");
$num_row = dbrows($num_row);
if ($num_row != 0) {
    $count = $num_row;
    $pages_count = ceil($count / $perpage); // Количество страниц
    // Если номер страницы оказался больше количества страниц
    if ($page > $pages_count)
        $page = $pages_count;
    $start_pos = ($page - 1) * $perpage; // Начальная позиция, для запроса к БД
    // Вызов функции, для вывода ссылок на экран

	$servers = dbquery("SELECT * FROM ".DB_SERVERS . " ".$search_id." ".$email." order by server_regdata desc limit " . $start_pos . ", " . $perpage);




echo"<center><table border='0'  align='center' cellpadding='0' cellspacing='0' class=\"table table-bordered table-striped\" style='width:80%'>";

echo "<thead><tr><th width=5px><center>ID</center></th><th width=350><center>Название сервера</center></th><th width=150><center>Адрес сервера</center></th><th width=100><center>".$locale['012']."</center></th><th width=70><center>Статус</center></th><th width=70><center>Действия</center></th></tr>";
$i=0;
	while($r=dbarray_fetch($servers)) {
		$players = $r['server_players']."/".$r['server_maxplayers'] ;
		if($r['server_players'] == $r['server_maxplayers'])
		{ $players = "<font color='#00FF00'>".$r['server_players']."/".$r['server_maxplayers']."</font>";}
		if($r['server_players'] == 0)
		{ $players = "<font color='red'>".$r['server_players']."/".$r['server_maxplayers']."</font>";}
		$i++;

		if(file_exists("images/maps/".$r['server_map'].".jpg")){
			$maps_img="<img src='images/maps/".$r['server_map'].".jpg' alt='".$r['server_map']."' style='border:none;height:25px;vertical-align:middle;width:33px;' />";
		}else{
			$maps_img="<img src='images/maps/off.jpg' alt='".$r['server_map']."' style='border:none;height:25px;vertical-align:middle;width:33px;' />";
		}

					if($r['server_status']==1){
						$startus="<span class=\"label label-success\">Включен</span>";

					}else{
						$startus="<span class=\"label label-important\">Выключен</span>";
					}
					
					if($r['server_name']=='0')$startus="<span class=\"label label-warning\">Сервер еще не обновлялся</span>";
					if($r['server_off']=='1')$startus="<span class=\"label label-important\">СЕРВЕР ЗАБЛОКИРОВАН</span>";
		if(trim($r['server_name'])=="" || $r['server_name']=='0')$r['server_name']='Сервер выключен';
	
		
		echo"<tr><td><center>".$r['server_id']."</center></td>";
		echo"<td align='left'><a href='".$settings['siteurl']."server-$r[server_id]' id='link'>$r[server_name]</a></td>";
		echo"<td align='center'> <img src='images/flags/$r[server_location].png' height='12' width='16' alt='$r[server_location]' title='$r[server_location]''> $r[server_ip]</td>";
		echo"<td align='center'>".$maps_img." $r[server_map]</td>";
		

					
					
		echo"<td align='center'><center>".$startus."</center></td>";


								echo "<td class=\"td-actions\"><center>";

								
								echo "	<a href=\"admin/index.php?id=info&amp;serv=".$r['server_id']."\" class=\"btn btn-small btn-primary\">";
								echo "		<i class=\"btn-icon-only  icon-pencil\"></i>				";						
								echo "	</a>";									
								echo "
										<a class=\"btn btn-danger\" onClick='return DeleteItem(".$r['server_id'].")'>
										";
								echo "		<i class=\"btn-icon-only icon-remove\"></i>	";									
								echo "	</a>";
								
								
								echo "</center></td>";
				
				
		echo "</tr></tr>";
	}
	
echo"</tbody></table></center>";

if($num_row>$settings['top_servers']){
	echo '			<center>	<section id="paginations">
						<h3>Страницы</h3>
						
						<div class="pagination"><ul>'; 
	 link_bar($page, $count, $pages_count, 10, 'admin/index.php?id=servers&page=');
	 echo '						</ul>
						</div></section>


	</center>';
}

}else {
	echo "<th><center> Серверов в базе нет</center></th>";
}



	echo"<hr class='clear'>";


?>
<script type='text/javascript'>function DeleteItem(id) {
	if (confirm("Уверены, что хотите удалить сервер?")) {
	document.location.href='admin/index.php?id=obpost&new_serv_gl&serv_all_sp&serv='+id+'&del';
	} else { alert("Действие отменено"); }
	} </script>




