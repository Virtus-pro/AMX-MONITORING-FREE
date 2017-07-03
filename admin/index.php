<?php
/* 
     AMX MONITORING v.1.1.6
	Разработчик: Virtus-pro

	Сайт: www.amxservers.ru 
	
	******Спасибо. Надеемся Вам понравится наш продукт.********
*/
require_once "../maincore.php";
require_once THEM."header.php";
include LOCALE.LOCALESET."/admin/admin.php";
//------------------------------------------------------------------------------------------------------------+
echo "<title>".$locale_admin['001']." | ".$settings['sitename']."</title>";

if (empty($_SESSION['admin_name']) AND empty($_SESSION['admin_id']))
{
echo"<center><form action='admin/login.php' method='post'>";
?>
			<h1>Вход в админ панель</h1>		
			
			<div class="login-fields">
				
				
				<div class="field">
					<label for="login">Логин:</label>
					<input type="text" id="login" name="login" value="" placeholder="Логин" class="login username-field" />
				</div> <!-- /field -->
				
				<div class="field">
					<label for="password">Пароль:</label>
					<input type="password" id="password" name="password" value="" placeholder="Пароль" class="login password-field"/>
				</div> <!-- /password -->
				
			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				

									
				<button class="button btn btn-warning btn-large">Войти</button>
				
			</div> <!-- .actions -->

<?php






echo"</form></center><br>";
}else{

if($settings['proverka'] ==''){
 echo "<center><div style='width:650px;text-align:left'><font color='red'><b>Вы наверно скажите: \"а почему все всера которы я добавил показываются как выключенные?\"</b></font><br><br>
		<b><font color='green'>Отвечаю</font></b>: Необходимо настроть <a href='http://ru.wikipedia.org/wiki/Cron'>Cron</a> для файла http://site.ru/cron.php, 
		как настроить крон можете прочитать в интернете, под кажду операционную систему по разному. Лучше всего обратиться к хостеру.<br>
		<font color='red'>Так же подмечу!</font> На хостинге должны быть открыты UPD соединения на ВСЕ порты!<br>Любимый вопрос хостеров: На какие порты открыть или какой
		диапазон? Отвечаете надо на ВСЕ! Так как мы не можем угадать на каком порте клиент запустит свой сервер</div><br><br></center>";
}
?>

    <div class="container">

      <div class="row">
      	
      	<div class="span6">
      		
      		<div class="widget stacked">
					
				<div class="widget-header">
					<i class="icon-star"></i>
					<h3>Общая информация</h3>
				</div> <!-- /widget-header -->
				
				<div class="widget-content">
					
					<div class="stats">
<?php
$servs_num_ad = dbquery("SELECT * FROM ".DB_SERVERS . "");
$serv_num_ad=dbrows($servs_num_ad);
list($weekserv) = dbarray_fetch(dbquery("SELECT Count(server_id) FROM `".DB_SERVERS . "` WHERE server_regdata > '" . (time()-604900) . "'"));

$no_activ=$serv_num_ad-$servs_num_online;
?>						
						<div class="stat">
							<span class="stat-value"><?php echo $serv_num_ad;?></span>									
							Всего серверов в базе
						</div> <!-- /stat -->
						
						<div class="stat">
							<span class="stat-value"><?php echo $no_activ;?></span>									
							Не активных серверов
						</div> <!-- /stat -->
						
						<div class="stat">
							<span class="stat-value"><?php echo $weekserv;?></span>									
							Новых серверов за поледнию неделю
						</div> <!-- /stat -->
						
					</div> <!-- /stats -->
					
					
					<div id="chart-stats" class="stats">

						
						<div class="stat stat-time">									
							<span class="stat-value">
							<?php
							if($settings['proverka'] ==''){
								echo "<font color='red'>Cron не запускался!</font>";
							}else{
								echo date("G:i:s  d.m.Y",$settings['proverka']);
							}
							?>
							</span>
							Последнее время запуска Cron
						</div> <!-- /substat -->
						
					</div> <!-- /substats -->
					
				</div> <!-- /widget-content -->
					
			</div> <!-- /widget -->	
			
			
			
					
										

      		
	    </div> <!-- /span6 -->
      	
      	
      	<div class="span6">	
      		
      		 
      		<div class="widget stacked">
					
				<div class="widget-header">
					<i class="icon-bookmark"></i>
					<h3>Навигация</h3>  
				</div> <!-- /widget-header -->
				
				<div class="widget-content">
					
					<div class="shortcuts">
						<a href="admin/index.php" class="shortcut">
							<i class="shortcut-icon icon-home"></i>
							<span class="shortcut-label">Главная</span>	
						</a>
						<a href="admin/index.php?id=servers" class="shortcut">
							<i class="shortcut-icon icon-list-alt"></i>
							<span class="shortcut-label">Все сервера</span>
						</a>
						
						<a href="admin/index.php?id=global" class="shortcut">
							<i class="shortcut-icon icon-bookmark"></i>
							<span class="shortcut-label">Настройки</span>								
						</a>
						

						
						<a href="admin/index.php?id=news" class="shortcut">
							<i class="shortcut-icon icon-comment"></i>
							<span class="shortcut-label">Новости</span>								
						</a>
						
						<a href="admin/index.php?id=add" class="shortcut">
							<i class="shortcut-icon icon-plus"></i>
							<span class="shortcut-label">Добавить сервер</span>
						</a>
						
						<a href="admin/index.php?id=pages" class="shortcut">
							<i class="shortcut-icon icon-file"></i>
							<span class="shortcut-label">Страницы</span>	
						</a>

						
						<a href="admin/index.php?id=other" class="shortcut">
							<i class="shortcut-icon icon-tag"></i>
							<span class="shortcut-label">Прочие</span>
						</a>				
					</div> <!-- /shortcuts -->	
				
				<div style="text-align:right">[ <a href="admin/index.php?id=admin_pass" class="shortcut">изменить пароль админа</a> ]&nbsp;&nbsp;&nbsp; [ <a href="admin/index.php?exit" class="shortcut">выйти из админки</a> ]</div>
				</div> <!-- /widget-content -->
				
			</div> <!-- /widget -->
      		
      		
					
					

					
			
								
	      </div> <!-- /span6 -->
      	
      </div> <!-- /row -->

    </div> <!-- /container --><center>
<?



  if (isset($_GET['id']))
  {
    if ($_GET['id'] == "add")
    {
      require "add_server.php";
    }
	elseif ($_GET['id'] == "messages")
    {
      require "messages.php";
    }
		elseif ($_GET['id'] == "servers")
    {
      require "servers.php";
    }
		elseif ($_GET['id'] == "global")
    {
      require "global.php";
    }
	elseif ($_GET['id'] == "other")
    {
      require "other.php";
    }
		elseif ($_GET['id'] == "obpost")
    {
      require "obpost.php";
    }
		elseif ($_GET['id'] == "new_serv")
    {
      require "new_serv.php";
    }
			elseif ($_GET['id'] == "new")
    {
      require "new_serv_prov.php";
    }
			elseif ($_GET['id'] == "news")
    {
      require "news.php";
    }
			elseif ($_GET['id'] == "pages")
    {
      require "pages.php";
    }
			elseif ($_GET['id'] == "admin_pass")
    {
      require "admin_pass.php";
    }
			elseif ($_GET['id'] == "stat")
    {
      require "stat.php";
	  }
			elseif ($_GET['id'] == "info")
    {
      require "info.php";
    }

  }
  else
  {
    require "new_serv.php";
  }

//------------------------------------------------------------------------------------------------------------+
?></center><?php
require_once THEM."footer.php";
}
?>

