<?php
/* 
     AMX MONITORING v.1.1.6
	Разработчик: Virtus-pro

	Сайт: www.amxservers.ru 
	
	******Спасибо. Надеемся Вам понравится наш продукт.********
*/
require_once LOCALE.LOCALESET."serv.php";
echo "<title>".$locale['serv001']." | ".$settings['sitename']."</title>\n";

require_once LOCALE.LOCALESET."serv.php";


if ($_GET['id'] == "info")
	   {
		if($_GET['serv'] !="")
		{
			$id=intval($_GET['serv']);
			$q = dbquery("SELECT * FROM ".DB_SERVERS." WHERE server_id = ".$id."");
			if(dbrows($q)==1){
					$serv=dbarray_fetch($q);
					
					$img = "<img src='images/maps/default.jpg' alt='".$locale['serv005']."' width='160' height='120'  class=img-rounded'>";
					if (file_exists("images/maps/".$serv['server_map'].".jpg"))
					{$img = "<img src='".BASEDIR."images/maps/".$serv['server_map'].".jpg' alt='".$serv['server_name']."' width='160' height='120' class=img-rounded'>";}
					$site= "---";
					if($serv['server_site'] !="")
					{$site="<a href='http://".$serv['server_site']."' target='_blank'>".$serv['server_site']." </a>";}
					$icq= "---";
					if($serv['server_icq'] !="")
					{$icq=$serv['server_icq']." <img src='http://status.icq.com/online.gif?icq=".$serv['server_icq']."&img=26'>";}
			
					$status="<font color='red'><b>ofline";
					if($serv['server_status'] ==1) $status="<font color='green'><b>Online";

					$img = "<img src='images/maps/default.jpg' alt='Нет изображения' width='160' height='120' class=\"b-img-radius\">";
					if (file_exists("images/maps/".$serv['server_map'].".jpg"))
					{$img = "<img src='".BASEDIR."images/maps/".$serv['server_map'].".jpg' alt='".$serv['server_name']."' width='160' height='120' class=\"b-img-radius\">";}

					
					?>
					
					<style>
					/* IMG radius */

					.b-img-radius {
					  zoom: 1;
					  position: relative;
					  -webkit-border-radius: 10px;
					  -moz-border-radius: 10px;
					  border-radius: 10px;
					  display: inline-block;
					  vertical-align: top;
					  margin-right:92px;
					}

					  .b-img-radius img {
						display: block;
						visibility: hidden;
					  }
					</style>


					<center>
					<div class="widget " style="width:80%">

							<div class="widget-header">
									<i class="icon-user"></i>
									<h3>Информация о сервере  &nbsp;&nbsp; <?php echo $serv['server_name'];?></h3>
								</div> <!-- /widget-header -->
								
								<div class="widget-content">
									
			
							
									
									<div class="tabbable">
									<ul class="nav nav-tabs">
									  <li class="active">
										<a href="#info" data-toggle="tab">Информация</a>
									  </li>
									  <li><a href="#web" data-toggle="tab">Веб модуль</a></li>
									  <li><a href="#banners" data-toggle="tab">Банеры</a></li>
									</ul>
									
									<br />
									
										<div class="tab-content">
											<div class="tab-pane active" id="info">
														<?php

														echo "<center><table><tr><td width='40%' >".$img."</td>";
														echo "<td width='70%' >
														".$locale['serv006']." ".$status."</font>
														<br><br>
														".$locale['serv007']." ".$serv['server_name']."
														<br><br>
														".$locale['serv008']." ".$serv['server_ip']."
														<br><br>
														".$locale['serv010']." ".$serv['server_players']." / ".$serv['server_maxplayers']."
														<br><br>
														".$locale['serv011']." ".$site."
														<br><br>
														".$locale['serv012']." ".$icq;
														if($serv['server_location']!=""){
															if(file_exists("images/flags/".$serv['server_location'].".png")){
																echo "<br><br>
																".$locale['serv013']."  <img src='images/flags/$serv[server_location].png' height='12' width='16' alt='$serv[server_location]' title='$serv[server_location]''>
																";
															}											
														

														}
														echo "</td>";

														echo "</tr>";
														echo "<tr></table>";
														echo $locale['030']."<br>";
														echo "<input  name='conect' id='conect' type='text' value='connect ".$serv['server_ip']."' size='35' maxlength='35'onclick=\"document.getElementById('conect').select();\"></center>";
														// echo"<table border='0'  align='center' >";
														// echo $locale['030']."<br><input name='conect' id='conect' type='text' value='connect ".$serv['server_ip']."' size='35' maxlength='35' onclick=\"document.getElementById('conect').select()\"";
														// echo "</table>";
														?>								
											</div>
											
											<div class="tab-pane"   id="web">
												<?php
												echo "<center><iframe src='".$settings['siteurl']."view.php?id=".$id."&bg=3C3A36&text=9a9a9a&link=ffffff&ip=ffffff' frameborder='0' width='170' height='250' scrolling='no' ></iframe><br><br>";
														echo"<br><br><textarea rows='3' cols='50'><iframe src='".$settings['siteurl']."view.php?id=".$id."&bg=3C3A36&text=9a9a9a&link=ffffff&ip=ffffff' frameborder='0' width='170' height='250' scrolling='no'></iframe></textarea></center>";
												?>		
											</div>
											<div class="tab-pane" id="banners">
												<?php
														echo "<br><img src='userbar-".$id.".jpg'>";
														echo "<br><br>".$locale['serv014']."<br>";
														echo"<textarea rows='5' cols='49'>[img]".$settings['siteurl']."userbar-".$id.".jpg[/img]</textarea>";
														echo "<br><br>".$locale['serv015']."<br>";
														echo"<textarea rows='5' cols='49'><img src='".$settings['siteurl']."userbar-".$id.".jpg'></textarea>";
														
												?>		
											</div>								
										</div>
									  
									  
									</div>
									
									
									
									
									
								</div> <!-- /widget-content -->
									
							</div> <!-- /widget --></center>
					
					

			<?

			}else{
				error_404();
			}
		}
		
	}	
else
{header("Location: /"); exit; }
?>