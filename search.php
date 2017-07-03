<?
/* 
     AMX MONITORING v.1.1.6
	Разработчик: Virtus-pro

	Сайт: www.amxservers.ru 
	
	******Спасибо. Надеемся Вам понравится наш продукт.********
*/
require_once LOCALE.LOCALESET."search.php";

echo"<script type='text/javascript' src='".JS."cookies.js'></script>\n";
echo"<script type='text/javascript' src='".JS."jquery.cookies.js'></script>\n";

 if(!isset ($_POST['map']) && !isset ($_POST['null'])) 

{
?>
<center>
<h2><?=$locale['search001']?></h2>

<form action="search/" method="POST" id="form1">
	<table cellpadding="5" cellspacing="0">
		<tr>
			<td valign="top"><?=$locale['search002']?></td>

			<td><input type="text" name="map" id="map" value="" size="50" /><br /><small><?=$locale['search003']?><a href="#" onclick="document.getElementById('map').value='de_dust,de_dust2,de_inferno'; return(false);"><?=$locale['search004']?></small></td>
		</tr>
		<?
		?>
		<tr>
			<td></td>
			<td><input type="submit" value="Найти" type="submit" class="btn btn-primary" /></td>
		</tr>
	</table>
</form>

</center>
<?
}
else{
if ($_POST['map']=='') 
{
$map="";
if($settings['all_serv_search']!=1){$status="and server_status='1'";}else{$status="";}
	$search=dbquery("SELECT * FROM ".DB_SERVERS . " where server_new =0  ".$status." and server_off =0 order by server_vip desc, votes desc limit ".$settings['top_search']."");

}
else{
if(!isset($_POST['map']))$map="de_dust";
$map=stripinput(htmlspecialchars($_POST['map']));
if($settings['all_serv_search']!=1){$status=" server_status='1' and";}else{$status="";}
$search = dbquery("SELECT * FROM amx_servers WHERE server_off != 1 AND ".$status."  MATCH (server_map) AGAINST ('".$map."')     limit ".$settings['top_search'].""); 
}
?>
<center>
<h2><?=$locale['search001']?></h2>

<form action="search/" method="POST" id="form1">
	<table cellpadding="5" cellspacing="0">
		<tr>
			<td valign="top"><?=$locale['search002']?></td>

			<td><input type="text" name="map" id="map" value="<?php echo $map;?>" size="50" /><br /><small><?=$locale['search003']?><a href="#" onclick="document.getElementById('map').value='de_dust,de_dust2,de_inferno'; return(false);"><?=$locale['search004']?></small></td>
		</tr>
		<?
		?>
		<tr>
			<td></td>
			<td><input type="submit" value="Найти" type="submit" class="btn btn-primary" /></td>
		</tr>
	</table>
</form>

</center>
<?
echo"<center><table border='0'  align='center' cellpadding='0' cellspacing='0' class=\"table table-bordered table-striped\" style='width:80%'>";

echo "<thead><tr><th width=10px>#</th><th width=350><center>".$locale['010']."</center></th><th width=150><center>".$locale['011']."</center></th><th width=100><center>".$locale['012']."</center></th><th width=70><center>".$locale['013']."</center></th><th width=70><center>".$locale['016']."</center></th></tr>";
$i=0;
	while($r=dbarray_fetch($search)) {
	
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
		if($r['server_location']==""){
			if(file_exists("images/flags/".$r['server_location'].".png")){
				$flag=" <img src='images/flags/".$r['server_location'].".png' height='12' width='16' alt='".$r['server_location']."' title='".$r['server_location']."'>";
			}else{
				$flag="";
			}		}else{
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

echo"</tbody></table>";
	echo"<hr class='clear'>";
}