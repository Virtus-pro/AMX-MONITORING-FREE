<?php
/* 
     AMX MONITORING v.1.1.6
	Разработчик: Virtus-pro

	Сайт: www.amxservers.ru 
	
	******Спасибо. Надеемся Вам понравится наш продукт.********
*/
header('Content-type: text/html; charset=utf-8');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Pragma: no-cache"); // HTTP/1.0'



Error_Reporting(E_ALL & ~E_NOTICE);
require_once "maincore.php";
lamx();
require_once LOCALE.LOCALESET."global.php";
//------------------------------------------------------------------------------------------------------------+

if ($settings['maintenance'] == "1" AND empty($_SESSION['admin_name']) AND empty($_SESSION['admin_id'])) {
	echo $settings['maintenance_message'];
}
else {
require_once THEM."header.php";
  if (isset($_GET['id']))
  {
    if ($_GET['id'] == "add")
    {
      require "register.php";
    }
	elseif ($_GET['id'] == "all_servers")
    {
      require "all_servers.php";
    }
	elseif ($_GET['id'] == "contact")
    {
      require "contact.php";
    }
	elseif ($_GET['id'] == "news")
    {
      require "news.php";
    }
	elseif ($_GET['id'] == "page")
    {
      require "pages.php";
    }
		elseif ($_GET['id'] == "search")
    {

      require "search.php";
    }
    elseif ($_GET['id'] == "info")
	   {
      if($_GET['serv'] !="")
	  {require "serv.php"; }
	  else {require "servers.php";}
    }else{
		error_404();	
	}
  }
  else
  {
    require "servers.php";
  }
//------------------------------------------------------------------------------------------------------------+
require_once THEM."footer.php";
}


?>


