<?php
/* 
     AMX MONITORING v.1.1.6
	Разработчик: Virtus-pro

	Сайт: www.amxservers.ru 
	
	******Спасибо. Надеемся Вам понравится наш продукт.********
*/
if (empty($_SESSION['admin_name']) or empty($_SESSION['admin_id']))die("Доступ запрещен");

include LOCALE.LOCALESET."/admin/servers.php";








?>    
</center>
    <div class="container">

      <div class="row">
      	
      	<div class="span6">
      		

			
			
			<div class="widget widget-nopad stacked">
						
				<div class="widget-header">
					<i class="icon-list-alt"></i>
					<h3>Последние 5 новости</h3> [ <a href="admin/index.php?id=news&add">добавить</a> ]
				</div> <!-- /widget-header -->
				
				<div class="widget-content">
					
					<ul class="news-items">
						<?php
							$result = dbquery("SELECT * FROM ".DB_NEWS."  order by news_datestamp desc LIMIT 5");
							while($r=dbarray_fetch($result)) {
								if($r['news_del']==1){$del_news="<span class=\"label label-important\">Не активна</span>";}else{$del_news="";}
							echo '<li>		';
								echo '<div class="news-item-detail" style="width:100%">			';							
									echo '<a href="news/'.$r['news_id'].'" target="_blank" class="news-item-title" title="( откроется в новом окне )" alt="( откроется в новом окне )" data-toggle="tooltip" data-placement="top">'.stripslashes($r['news_subject']).'</a>   | [ <a href="admin/index.php?id=news&edit='.$r['news_id'].'" class="news-item-title"> ред.</a> ] '.$del_news.'';
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
					
										

      		
	    </div> <!-- /span6 -->
      	
      	
      	<div class="span6">	
      		
      		

      		
      		
					
					

					
					
					
			<div class="widget stacked widget-table action-table">
					
				<div class="widget-header">
					<i class="icon-th-list"></i>
					<h3>Новые сервера</h3>
				</div> <!-- /widget-header -->
				
				<div class="widget-content">
					
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>IP</th>
								<th>Статус</th>
								<th class="td-actions">Действие</th>
							</tr>
						</thead>
						<tbody>
<?php						
$result = dbquery("SELECT * FROM ".DB_SERVERS." WHERE server_new = 1");
$serv_num_new=dbrows($result);
if($serv_num_new!=0){		
		while($r=dbarray_fetch($result)) {	
					if($r['server_status']==1){
						$startus="<span class=\"label label-success\">Включен</span>";

					}else{
						$startus="<span class=\"label label-important\">Выключен</span>";
					}
					
					if($r['server_name']=='0')$startus="<span class=\"label label-warning\">Сервер еще не обновлялся</span>";
							echo "<tr>";
								echo "<td><a href='admin/index.php?id=info&amp;serv=".$r['server_id']."' id='link'>".$r['server_ip']."</a></td>";
								echo "<td>".$startus."</td>";
								echo "<td class=\"td-actions\">";
								echo "	<a href=\"admin/".AMX_SELF."?id=obpost&new_serv_gl&serv=".$r['server_id']."&add\" class=\"btn btn-small btn-success\">";
								echo "		<i class=\"btn-icon-only icon-ok\"></i>				";						
								echo "	</a>";
									
								echo "
										<a  class=\"btn btn-danger\" onClick='return DeleteItem(".$r['server_id'].")'>
										";
								echo "		<i class=\"btn-icon-only icon-remove\"></i>	";									
								echo "	</a>";
								echo "</td>";
							echo "</tr>";
		}
	}else{
		echo "<tr><td  colspan='3'><center>Нет новых серверов</center></td></tr>";
}	
?>						
							</tbody>
						</table>
					
				</div> <!-- /widget-content -->
			
			</div> <!-- /widget -->
			<div class="widget stacked">
				
				<div class="widget-header">
					<i class="icon-thumbs-up"></i>
					<h3>Об авторе</h3>
				</div> <!-- /widget-header -->
				
				<div class="widget-content">
					
					<p>Автор данного AMX MONITORING v.1.1.6: <span class="label label-info"><a href="http://www.amxservers.ru/" target="_blank" style="color:#FFF"><b>Virtus-pro</b></a></span></p>
					
					
					<p>Это новая,БЕСПЛАТНАЯ  версия зарекомендовавшего себя мониторинга v.1.1.5. Я постарался улучшить его, учел многие просьбы. </p>
					
					<p>Я сделал достаточно функций, он работает при принципу поставил и забыл! Полностью переработал 1.1.5 версию.<br><span class="label label-warning">Версия не содержит никакой рекламы</span>, специально, чтобы не раздражало. Оставил только копирайты внизу, надеюсь вы оставите его, это будет мальнькая плата за мои труды</p>					
					<p>Если кто то желает отблагодарить материально, вот реквизиты:<br><ul><li>Webmoney WMR: R308955513295</li><li>Webmoney WMZ: Z101851704801</li><li>Яндекс кошелек: 41001212733280</li></ul></p>
					<p><div class="alert alert-info">Так же вы можете приобрести платную версию, в которой функционал намного богаче и много игр. <br>Приобрести можно тут <a href="http://www.amxservers.ru/main/pay" target="_blank">www.amxservers.ru</a></div></p>
					Все вопросы относительно этого мониторинга можете задавать на <a href="http://forum.amxservers.ru/index.php?/forum/27-amx-monitoring-free/" target="_blank">форум<a/>
					<p><div class="alert alert-success">Спасибо за выбор моего продукта! Надеюсь он вам понравится <img src="images/wink.png">. Приятной работы!</div></p>
				</div> <!-- /widget-content -->
			
			</div> <!-- /widget -->
								
	      </div> <!-- /span6 -->
      	
      </div> <!-- /row -->

    </div> <!-- /container -->
    
<script type='text/javascript'>function DeleteItem(id) {
	if (confirm("Уверены, что хотите удалить сервер?")) {
	document.location.href='admin/index.php?id=obpost&new_serv_gl&serv='+id+'&del';
	} else { alert("Действие отменено"); }
	} </script>

