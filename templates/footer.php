<?php
/* 
     AMX MONITORING v.1.1.6
	Разработчик: Virtus-pro

	Сайт: www.amxservers.ru 
	
	******Спасибо. Надеемся Вам понравится наш продукт.********
*/
include LOCALE.LOCALESET."footer.php";
// echo"<div id='footer'>";
// echo $locale_footer['001'] .": $serv_num, ".$locale_footer['002'].": $servs_num_online<br><br>".$settings['license'];
// echo SITECOPY."<br><br><small>".$settings['Generator']." ".$settings['version']."</small></a></div></body>";lamx();

?>

<div class="extra">

	<div class="extra-inner">

		<div class="container">

			<div class="row">
				
    			<div class="span3">
    				
    				<h4>Новости</h4>
    				
    				<ul>
					<?php
					//Запрос
					$result_news = dbquery("SELECT news_subject,news_datestamp,news_id FROM ".DB_NEWS." WHERE news_del=0 order by news_datestamp desc  LIMIT " .$settings['news_top'] . " ");
						
					$row_news = dbrows($result_news);
					if ($row_news != 0) {
					
					while($data=dbarray_fetch($result_news)) {

					$data['news_str']=str_name($data['news_subject'], 250, "...");
					echo "<li><a href='news/".$data['news_id']."'>".$data['news_str']."</a></li>";		
								
						
						
					}
					
					}else{
						echo "<li>В базе отсутствую Новости</li>";
					}	
					?>
    				</ul>
    				
    			</div> <!-- /span3 -->
    			

    			
    			<div class="span3" style="margin-left:400px">
    				
    				<h4>Топ <?php echo $settings['top_maps'];?> карт</h4>
    				
    				<ul>
					<?php
					//Запрос
					$result_top = dbquery("SELECT server_map, COUNT(*) AS cnt FROM " . DB_SERVERS .
						" where server_status =1 and server_new=0 and server_off = 0 GROUP BY server_map  ORDER BY cnt  DESC LIMIT " .
						$settings['top_maps'] . " ");
						
					$row_top = dbrows($result_top);
					if ($row_top != 0) {
					
					while($data=dbarray_fetch($result_top)) {
				
						
		  

					$data['server_map_img_str']=str_name($data['server_map'], 50, "...");
					echo "<li>".$data['server_map_img_str']." <font color='#666666'>( на ".$data['cnt']." серверах(е)  )</font></li>";		
								
						
						
					}
					
					}else{
						echo "<li>В базе отсутствую сервера</li>";
					}	
					?>

						
    				</ul>
    				
    			</div> <!-- /span3 -->
    			
    		</div> <!-- /row -->

		</div> <!-- /container -->

	</div> <!-- /extra-inner -->

</div> <!-- /extra -->


    
    
<div class="footer">
	
	<div class="footer-inner">
		
		<div class="container">
			
			<div class="row">
				
    			<div class="span12">
    				
<table cellpadding='0' cellspacing='0' width='100%'>
<tr>
<td class='sub-header-left'></td>
<td align='left'><?php echo $settings['license'];?></td>
<td align='right'>AMX MONITORING v1.1.6,  &copy; <a href='http://www.amxservers.ru'>www.amxservers.ru</a> 2008-2013</td>
<td class='sub-header-right'></td>
</tr>
</table>
					
					
    			</div> <!-- /span12 -->
    			
    		</div> <!-- /row -->
    		
		</div> <!-- /container -->
		
	</div> <!-- /footer-inner -->
	
</div> <!-- /footer -->
    

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="templates/js/excanvas.min.js"></script>
<script src="templates/js/jquery.flot.js"></script>
<script src="templates/js/jquery.flot.pie.js"></script>
<script src="templates/js/jquery.flot.orderBars.js"></script>
<script src="templates/js/jquery.flot.resize.js"></script>


<script src="templates/js/bootstrap.js"></script>
<script src="templates/js/base.js"></script>

<script src="templates/js/charts/area.js"></script>
<script src="templates/js/charts/donut.js"></script>

  </body>
<?php
echo"</html>";
mysql_close();
?>