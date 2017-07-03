<?php
/* 
     AMX MONITORING v.1.1.6
	Разработчик: Virtus-pro

	Сайт: www.amxservers.ru 
	
	******Спасибо. Надеемся Вам понравится наш продукт.********
*/
if (isset($_GET['news_id'])) {
    $id = intval($_GET['news_id']);
    if ($id > 0) {
		
			
			$result = dbquery("SELECT * FROM ".DB_NEWS." WHERE news_id='".$id."' AND news_del=0");
			if(dbrows($result)==1){
			
				$data_news=dbarray_fetch($result);
				echo "<title>".$settings['sitename']." | Новости | ".stripslashes($data_news['news_subject'])."</title>\n";
				?>
				<center>
							<div class="widget widget-nopad stacked" style="width:60%">
										
								<div class="widget-header" style="text-align:left">
									<i class="icon-list-alt"></i>
									<h3><?php echo $data_news['news_subject'];?></h3> 
								</div> <!-- /widget-header -->
								
								<div class="widget-content" style="text-align:left"   style="margin:10px;width:100%">
									
									<ul class="news-items" >
									<?php
										
										echo '<li>		';
											echo '<div class="news-item-detail" style="width:100%">			';							
												
												echo '<p class="news-item-preview" style="padding-left:10px">'.stripslashes($data_news['news_extended']).' </p>';
				
												echo '</div>';
											
											echo '<div class="news-item-date">';
											echo '	<span class="news-item-day">'.date('d',$data_news['news_datestamp']).'</span>';
											echo '	<span class="news-item-month">'.date('M',$data_news['news_datestamp']).'</span>';
											echo '</div>';
										echo '</li>		';					
										
									?>
										
											



									</ul>
									<div style="text-align:right;padding:5px;padding-right:15px;"><a href="news/">Все новости </a></div>
								</div> <!-- /widget-content -->
							
							</div> <!-- /widget -->
				</center>

				<?	
			}else{
				echo "<title>".$settings['sitename']." | Новости</title>\n";
				echo "<center><br><br><br><br><h2><font color='red'>Данная новость не найдена в нашей базе</font></h2><br><br><br><br></center>";
			}
	
	}else{
		echo "<title>".$settings['sitename']." | Новости</title>\n";
		echo "<center><br><br><br><br><h2><font color='red'>Данная новость не найдена в нашей базе</font></h2><br><br><br><br></center>";
	}
}else{
	echo "<title>".$settings['sitename']." | Новости</title>\n";
	$result = dbquery("SELECT * FROM ".DB_NEWS." WHERE news_del=0  order by news_datestamp desc");
	if(dbrows($result)==1){
	?>
	<center>
				<div class="widget widget-nopad stacked" style="width:60%">
							
					<div class="widget-header" style="text-align:left">
						<i class="icon-list-alt"></i>
						<h3>Последние новости</h3> 
					</div> <!-- /widget-header -->
					
					<div class="widget-content" style="text-align:left"   style="margin:10px;width:100%">
						
						<ul class="news-items" >
						<?php
							while($r=dbarray_fetch($result)) {
							echo '<li>		';
								echo '<div class="news-item-detail" style="width:100%">			';							
									echo '<a href="news/'.$r['news_id'].'" class="news-item-title">'.stripslashes($r['news_subject']).'</a>';
									echo '<p class="news-item-preview">'.str_name(stripslashes($r['news_extended']), 300, "...").' </p>';
	
									echo '</div>';
								
								echo '<div class="news-item-date">';
								echo '	<span class="news-item-day">'.date('d',$r['news_datestamp']).'</span>';
								echo '	<span class="news-item-month">'.date('M',$r['news_datestamp']).'</span>';
								echo '</div>';
							echo '</li>		';					
							}
						?>
				</ul>
						
					</div> <!-- /widget-content -->
				
				</div> <!-- /widget -->
	</center>

	<?
	}else{
				echo "<title>".$settings['sitename']." | Новости</title>\n";
				echo "<center><br><br><br><br><h2><font color='red'>Новостей в базе нет</font></h2><br><br><br><br></center>";	
	}
}



	echo"<hr class='clear'>";
?>