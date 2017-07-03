<?php
/* 
     AMX MONITORING v.1.1.6
	Разработчик: Virtus-pro

	Сайт: www.amxservers.ru 
	
	******Спасибо. Надеемся Вам понравится наш продукт.********
*/
require_once "maincore.php";
if(!isset($_GET['p']))die("Доступ запрещен");
$p=intval($_GET['p']);

require_once THEM."header.php";

?>

<div class="container">
	
	<div class="row">
		
		<div class="span12">
			
			<div class="error-container">
				<h1>Упс!</h1>
				
				<h2><?php echo $p;?> Страница не существует</h2>
				
				<div class="error-details">
				
					Если вы перешли на страницу с 404 ошибкой по ссылке, скорее всего, ссылка устарела или страница была удалена.<br>
					Вводя адрес страницы самостоятельно вы могли просто ошибиться при наборе. Если ошибки нет, попробуйте зайти на главную страницу сайта — возможно, вы найдете интересующую вас информацию на другой странице.
					
				</div> <!-- /error-details -->
				
				<div class="error-actions">
					<a href="index.php" class="btn btn-large btn-primary">
						<i class="icon-chevron-left"></i>
						&nbsp;
						На главную					
					</a>
					
					<a href="contact/" class="btn btn-large">
						<i class="icon-envelope"></i>
						&nbsp;
						Написать автору					
					</a>
					
				</div> <!-- /error-actions -->
							
			</div> <!-- /error-container -->			
			
		</div> <!-- /span12 -->
		
	</div> <!-- /row -->
	
</div> <!-- /container -->


<?php

require_once THEM."footer.php";

?>