<?php
/* 
     AMX MONITORING v.1.1.6
	Разработчик: Virtus-pro

	Сайт: www.amxservers.ru 
	
	******Спасибо. Надеемся Вам понравится наш продукт.********
*/
echo"<script type='text/javascript' src='".JS."cookies.js'></script>\n";
echo"<script type='text/javascript' src='".JS."jquery.cookies.js'></script>\n";
echo "<title>".$settings['sitename']."</title>\n";

echo"<center><table border='0'  align='center' cellpadding='0' cellspacing='0' class=\"table table-bordered table-striped\" style='width:80%'>";

echo "<thead><tr><th width=10px>#</th><th width=350><center>".$locale['010']."</center></th><th width=150><center>".$locale['011']."</center></th><th width=100><center>".$locale['012']."</center></th><th width=70><center>".$locale['013']."</center></th><th width=70><center>".$locale['016']."</center></th></tr>";
$i=0;


$perpage = $settings['top_servers'];
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
if($settings['all_serv_index']!=1){$status="and server_status = 1";}else{$status="";}

$num_row = dbquery("SELECT server_id FROM ".DB_SERVERS . " where server_new =0 ".$status." and server_off =0");
$num_row = dbrows($num_row);
if ($num_row != 0) {
    $count = $num_row;
    $pages_count = ceil($count / $perpage); // Количество страниц
    // Если номер страницы оказался больше количества страниц
    if ($page > $pages_count)
        $page = $pages_count;
    $start_pos = ($page - 1) * $perpage; // Начальная позиция, для запроса к БД
    // Вызов функции, для вывода ссылок на экран
	if($settings['all_serv_index']!=1){$status="and server_status = 1";}else{$status="";}
	$servers = dbquery("SELECT * FROM ".DB_SERVERS . " where server_new =0 ".$status." and server_off =0 order by server_vip desc, votes desc limit " . $start_pos . ", " . $perpage);


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
		if(trim($r['server_name'])=="" || $r['server_name']=='0')$r['server_name']='Сервер выключен';
		if($r['server_location']!=""){
			if(file_exists("images/flags/".$r['server_location'].".png")){
				$flag=" <img src='images/flags/".$r['server_location'].".png' height='12' width='16' alt='".$r['server_location']."' title='".$r['server_location']."'>";
			}else{
				$flag="";
			}
		}else{
			$flag="";
		}
		echo"<tr ><td>$i</td>";
		echo"<td align='left'><a href='".$settings['siteurl']."server-$r[server_id]' id='link'>$r[server_name]</a></td>";
		echo"<td align='center'> ".$flag." <span class=\"label label-info\">$r[server_ip]</span></td>";
		echo"<td align='center'>".$maps_img." $r[server_map]</td>";
		echo"<td align='center'><center><span class=\"label\">".$players."</span></center></td>";
		echo"<td align='center'><center>";
		if($r['server_vip']==1){ echo $locale['018']; }
			else{
		echo "<span class=\"label label-warning\"><span class='votes_count' id='votes_count$r[server_id]' >".$r['votes']."</span></span></span>";
		echo "<span class='vote_buttons' id='vote_buttons$r[server_id]'>";
		echo "	<a href='javascript:;' class='vote' id='$r[server_id]'></a>";
		echo "</span>";
				}
		echo "</center></td></tr></tr>";
	}
}
else {echo "<tr><td colspan='5'><center> <span class=\"label label-important\">".$locale['017']."</span></center><td></tr>";
}
echo"</tbody></table>";

if ($num_row >$settings['top_servers']) {
	echo '			<center>	<section id="paginations">
						<h3>Страницы</h3>
						
						<div class="pagination"><ul>'; 
 link_bar($page, $count, $pages_count, 6, 'index.php?page=');
	 echo '						</ul>
						</div></section>


	</center>';
}

if($serv_num !=0)
{
echo"</tbody></table></center>";}
	echo"<hr class='clear'>";
?>