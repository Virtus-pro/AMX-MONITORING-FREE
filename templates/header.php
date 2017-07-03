<?php
/* 
     AMX MONITORING v.1.1.6
	Разработчик: Virtus-pro

	Сайт: www.amxservers.ru 
	
	******Спасибо. Надеемся Вам понравится наш продукт.********
*/
echo "<!DOCTYPE HTML PUBLIC 'a-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>";
echo "<html class='inner' xmlns='http://www.w3.org/1999/xhtml'>\n<head>\n ".ASR."\n";lamx();
echo "<meta http-equiv='Content-Type' content='text/html' charset='utf-8'>\n";
echo "<meta name='description' content='".$settings['description']."'>\n";
echo "<meta name='keywords' content='".$settings['keywords']."'>\n";
echo "<meta name='generator' content='".$settings['Generator']." ".$settings['version']."' />\n";
// echo "<link rel='stylesheet' href='".THEM."two-tiers.css' type='text/css'></link>\n";
// echo "<link rel='stylesheet' href='".THEM."default.css' type='text/css'></link>\n";
// echo "<script type='text/javascript' src='".JS."scrate.js'></script>\n";
$result_m = dbquery("SELECT server_map, COUNT(*) AS cnt FROM " . DB_SERVERS .
    " where server_status != 0 and server_new != 1 and server_off != 1 GROUP BY server_map  ORDER BY cnt  DESC  LIMIT 3 ");
 
$row_map = dbrows($result_m);
$data_map="";
$i=0;
while($r=dbarray_fetch($result_m)) {

	$data_map.=$r['server_map']." (".$r['cnt'].") ";
	if($i==0){$data_map.=", ";}else{$data_map.=".";}
		
	$i++;
}


?>

    <base href="<?php echo $settings['siteurl'];?>" /> 
<script src="templates/js/jquery-1.7.2.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />    
    
    <link href="templates/css/bootstrap.min.css" rel="stylesheet" />
    <link href="templates/css/bootstrap-responsive.min.css" rel="stylesheet" />
    
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet" />
    <link href="templates/css/font-awesome.css" rel="stylesheet" />
    
    <link href="templates/css/base-admin.css" rel="stylesheet" />
    <link href="templates/css/base-admin-responsive.css" rel="stylesheet" />
    
    <link href="templates/css/pages/dashboard.css" rel="stylesheet" />   

<style>
a.vote {
	display:inline-block;
	background-position:center;
	height:16px;
	width:16px;
	background:url("images/arrow_up.png");
	vertical-align: middle;
}
a.voteserv {
	display:inline-block;
	background-position:center;
	height:16px;
	width:16px;
	background:url("images/arrow_large_up.png");
	vertical-align: middle;
}

</style>
	
	
	<link rel='shortcut icon' href='images/icon.ico' type='image/x-icon' />
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>


<body>

<div class="navbar navbar-fixed-top">
	
	<div class="navbar-inner">
		
		
			
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
	<table>
		<tr><td>
			<a class="brand" href="./">
				<?php echo $settings['sitename'];?>			
			</a>
</td><td >			
		
В нашем мониторинге <?php echo $serv_num;?> серверов(а),  В данный момент играют <?php echo $players_now;?> игроков(а) из <?php echo $players_all;?> максимально возможных.
<br>Большинство серверов предпочитают карты: <?php echo $data_map;?>
</td></tr></table>	
	
		
	</div> <!-- /navbar-inner -->
	
</div> <!-- /navbar -->
    

<?

$admin_l="";
$home_l="";
$search_l="";
$register_l="";
$news_l="";
$contact_l="";

$url=strrev(stristr(strrev($_SERVER['REQUEST_URI']),'/'));
if($url=="/admin/"){
	$admin_l='class="active"';
}elseif($url=="/search/"){
	$search_l='class="active"';
}
elseif($url=="/register/"){
	$register_l='class="active"';
}
elseif($url=="/contact/"){
	$contact_l='class="active"';
}
elseif($url=="/news/"){
	$news_l='class="active"';
}elseif($url=="/pages/"){
}else{
	$home_l='class="active"';
}
?>

    
<div class="subnavbar">

	<div class="subnavbar-inner">
	
		<div class="container">

			<ul class="mainnav">
			
				<li <?php echo $home_l;?>>
					<a href="./">
						<i class="icon-home"></i>
						<span>Главная</span>
					</a>	    				
				</li>
				
				<li <?php echo $search_l;?>>
					<a href="search/">
						<i class="icon-search"></i>
						<span>Поиск</span>
					</a>	    				
				</li>
				
				<li <?php echo $register_l;?>>					
					<a href="register/" class="dropdown-toggle">
						<i class="icon-plus"></i>
						<span>Добавить сервер</span>
					</a>	  				
				</li>
				
				<li <?php echo $news_l;?>>
					<a href="news/">
						<i class="icon-comment"></i>
						<span>Новости</span>
					</a>    				
				</li>
				
				<li <?php echo $contact_l;?>>					
					<a href="contact/">
						<i class="icon-info-sign"></i>
						<span>Обратная связь</span>
					</a>  									
				</li>
				<?php
						if (!empty($_SESSION['admin_name']) or !empty($_SESSION['admin_id']))
						{
									echo '	<li '.$admin_l.'>				';	
									echo '		<a href="admin/">';
									echo '			<i class="icon-eye-close	"></i>';
									echo '			<span>Админ панель</span>';
									echo '		</a>  		';
									echo '	</li>';
						}
				?>				

		
			</ul>

		</div> <!-- /container -->
	
	</div> <!-- /subnavbar-inner -->

</div> <!-- /subnavbar -->
 