<?php
/* 
     AMX MONITORING v.1.1.6
	Разработчик: Virtus-pro

	Сайт: www.amxservers.ru 
	
	******Спасибо. Надеемся Вам понравится наш продукт.********
*/
if (isset($_GET['pages_id'])) {
    $id = intval($_GET['pages_id']);
    if ($id > 0) {
		
			
			$result = dbquery("SELECT * FROM ".DB_PAGES." WHERE pages_id='".$id."' AND pages_del=0");
			if(dbrows($result)==1){
			
				$data_pages=dbarray_fetch($result);
				echo "<title>".$settings['sitename']." |  ".stripslashes($data_pages['pages_subject'])."</title>\n";
				?>
				<center>
							<div class="widget widget-nopad stacked" style="width:80%">
										
								<div class="widget-header" style="text-align:left">
									<i class="icon-list-alt"></i>
									<h3><?php echo $data_pages['pages_subject'];?></h3> 
								</div> <!-- /widget-header -->
								
								<div class="widget-content" style="text-align:left"   style="margin:10px;width:100%">
									
									<div style="padding:8px">
									<?php
										
								
											echo '<div class="pages-item-detail" style="width:100%">			';							
												
												echo '<p class="pages-item-preview" style="padding-left:10px">'.stripslashes($data_pages['pages_extended']).' </p>';
				
												echo '</div>';
											

													
										
									?>
										
											



									</div>
									
								</div> <!-- /widget-content -->
							
							</div> <!-- /widget -->
				</center>

				<?	
			}else{
				error_404();
			}
	
	}else{
		error_404();
	}
}else{
	error_404();
}


	echo"<hr class='clear'>";
?>