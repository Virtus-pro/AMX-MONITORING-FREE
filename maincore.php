<?php
/* 
     AMX MONITORING v.1.1.6
	Разработчик: Virtus-pro

	Сайт: www.amxservers.ru 
	
	******Спасибо. Надеемся Вам понравится наш продукт.********
*/

session_start();
error_reporting(E_ALL);



unset($check_url);
// Калькулятор вывода генерации страницы
$start_time = microtime();
$start_array = explode(" ",$start_time);
$start_time = $start_array[1] + $start_array[0];

// Проверка существует ли файл конфигурации
$folder_level = ""; $i = 0;
while (!file_exists($folder_level."config.php")) {
	$folder_level .= "../"; $i++;
	if ($i == 5) { die("Config file not found"); }
}
require_once $folder_level."config.php";
define("BASEDIR", $folder_level);

// Если бд нет, то переадресует на install.php
if (!isset($db_name)) { 
	if(!file_exists("install.php"))die("Отсутствует файл установки мониторинга Install.php");
	redirect("install.php");

 }

// Multisite definitions
require_once BASEDIR."include/constants.php";
require_once BASEDIR."include/function.php";

// Конект к БД
$link = dbconnect($db_host, $db_user, $db_pass, $db_name);

//Переменные выбора таблиц
$settings = dbarray(dbquery("SELECT * FROM ".DB_SETTINGS));
//Определяем сколько серверов находится в БД
$servs_num_online = dbquery("SELECT * FROM ".DB_SERVERS . " where server_status != 0 and server_new != 1 and server_off != 1");
$servs_num_online = dbrows($servs_num_online);
$servs_num = dbquery("SELECT * FROM ".DB_SERVERS . " where server_new != 1");
$serv_num=dbrows($servs_num);

$resultsum = dbquery("SELECT sum(server_players) FROM " . DB_SERVERS ."  WHERE server_status != 0 and server_new != 1 and server_off != 1");

list($players_now) = dbarray_fetch($resultsum);

$resultsum = dbquery("SELECT sum(server_maxplayers) FROM " . DB_SERVERS ."  WHERE server_status != 0 and server_new != 1 and server_off != 1");

list($players_all) = dbarray_fetch($resultsum);


if (file_exists("./install.php")) {
    exit("<center><br><br><br><br><br><br>Удалите файл <b>install.php</b></cemter>");
}

// Констакнты
define("AMX_SELF", basename($_SERVER['PHP_SELF']));
define("QUOTES_GPC", (ini_get('magic_quotes_gpc') ? TRUE : FALSE));
define("ADMIN", BASEDIR."admin/");
define("IMAGES", BASEDIR."images/");
define("MAPS", IMAGES."images/maps/");
define("INCLUDES", BASEDIR."include/");
define("JS", BASEDIR."include/js/");
define("LOCALE", BASEDIR."locale/");
define("THEM", BASEDIR."templates/");
define("LOCALESET", $settings['locale']."/");
define("USER_IP", $_SERVER['REMOTE_ADDR']);


if(isset($_GET['exit'])){
	session_destroy();
	redirect($settings['siteurl']."admin/");
	exit();
}

// Функция извлекающая хтмл теги
function stripinput($text) {
	if (QUOTES_GPC) $text = stripslashes($text);
	$search = array("&", "\"", "'", "\\", '\"', "\'", "<", ">", "&nbsp;");
	$replace = array("&amp;", "&quot;", "&#39;", "&#92;", "&quot;", "&#39;", "&lt;", "&gt;", " ");
	$text = str_replace($search, $replace, $text);
	return $text;
}
lamx();
// MySQL функции
function dbquery($query) {
	$result = @mysql_query($query);
	if (!$result) {
		echo mysql_error();
		return false;
	} else {
		return $result;
	}
}

//Обрезка длинных слов
function str_name($str, $len, $end)
{

    if( $len >= mb_strlen( $str ) ){ 
        return $str; 
		$t = '';
    }
    $str_cut = mb_substr( $str, 0, $len ); 
	$t = $end;
    $space_pos = mb_strrpos( $str_cut, " " ); 
    $break_pos = mb_strrpos( $str_cut, "\n" ); 
     
    $pos = max( $break_pos, $space_pos ); 
         
    $str = $pos !== false ? mb_substr( $str_cut, 0, $pos ) : mb_substr( $str_cut, 0, $len - 3 ).$t; 
     
    return $str;


}

function dbresult($query, $row) {
	$result = @mysql_result($query, $row);
	if (!$result) {
		echo mysql_error();
		return false;
	} else {
		return $result;
	}
}
function dbarray($query) {
	$result = @mysql_fetch_assoc($query);
	if (!$result) {
		echo mysql_error();
		return false;
	} else {
		return $result;
	}
}
define("SITECOPY","<a href='http://www.amxservers.ru'>");
function dbarray_fetch($query) {
	$result = @mysql_fetch_array($query);
	if (!$result) {
		echo mysql_error();
		return false;
	} else {
		return $result;
	}
}
function redirect($location) {
        echo "<script type='text/javascript'>document.location.href='".str_replace("&amp;", "&", $location)."'</script>\n";
        exit;
}

function stripslash($text) {
	if (QUOTES_GPC) { $text = stripslashes($text); }
	return $text;
}

function addslash($text) {
	if (!QUOTES_GPC) {
		$text = addslashes(addslashes($text));
	} else {
		$text = addslashes($text);
	}
	return $text;
}
define("ASR",$settings['AMX']);
function descript($text, $striptags = true) {
	// Функция убирает все скрипты из запроса
	$search = array("40","41","58","65","66","67","68","69","70",
		"71","72","73","74","75","76","77","78","79","80","81",
		"82","83","84","85","86","87","88","89","90","97","98",
		"99","100","101","102","103","104","105","106","107",
		"108","109","110","111","112","113","114","115","116",
		"117","118","119","120","121","122"
		);
	$replace = array("(",")",":","a","b","c","d","e","f","g","h",
		"i","j","k","l","m","n","o","p","q","r","s","t","u",
		"v","w","x","y","z","a","b","c","d","e","f","g","h",
		"i","j","k","l","m","n","o","p","q","r","s","t","u",
		"v","w","x","y","z"
		);
	$entities = count($search);
	for ($i=0; $i < $entities; $i++) {
		$text = preg_replace("#(&\#)(0*".$search[$i]."+);*#si", $replace[$i], $text);
	}
	$text = preg_replace('#(&\#x)([0-9A-F]+);*#si', "", $text);
	$text = preg_replace('#(<[^>]+[/\"\'\s])(onmouseover|onmousedown|onmouseup|onmouseout|onmousemove|onclick|ondblclick|onfocus|onload|xmlns)[^>]*>#iU', ">", $text);
	$text = preg_replace('#([a-z]*)=([\`\'\"]*)script:#iU', '$1=$2nojscript...', $text);
	$text = preg_replace('#([a-z]*)=([\`\'\"]*)javascript:#iU', '$1=$2nojavascript...', $text);
	$text = preg_replace('#([a-z]*)=([\'\"]*)vbscript:#iU', '$1=$2novbscript...', $text);
	$text = preg_replace('#(<[^>]+)style=([\`\'\"]*).*expression\([^>]*>#iU', "$1>", $text);
	$text = preg_replace('#(<[^>]+)style=([\`\'\"]*).*behaviour\([^>]*>#iU', "$1>", $text);
	if ($striptags) {
		do {
			$thistext = $text;
			$text = preg_replace('#</*(applet|meta|xml|blink|link|style|script|embed|object|iframe|frame|frameset|ilayer|layer|bgsound|title|base)[^>]*>#i', "", $text);
		} while ($thistext != $text);
	}
	return $text;
}

function makefilelist($folder, $filter, $sort=true, $type="files") {
	$res = array();
	$filter = explode("|", $filter); 
	$temp = opendir($folder);
	while ($file = readdir($temp)) {
		if ($type == "files" && !in_array($file, $filter)) {
			if (!is_dir($folder.$file)) { $res[] = $file; }
		} elseif ($type == "folders" && !in_array($file, $filter)) {
			if (is_dir($folder.$file)) { $res[] = $file; }
		}
	}
	closedir($temp);
	if ($sort) { sort($res); }
	return $res;
}
function makefileopts($files, $selected = "") {
	$res = "";
	for ($i = 0; $i < count($files); $i++) {
		$sel = ($selected == $files[$i] ? " selected='selected'" : "");
		$res .= "<option value='".$files[$i]."'$sel>".$files[$i]."</option>\n";
	}
	return $res;
}

function servers($server_num_data)
{
	global $settings;
if($server_num_data=='all')
	{
	$result=dbquery("SELECT * FROM ".DB_SERVERS . " where server_new != 1 and server_status != 0 and server_off != 1 order by server_vip desc, votes desc limit ".$settings['top_search']."");
	}
else{
$result=dbquery("SELECT * FROM ".DB_SERVERS . " where server_new != 1 and server_status != 0 and server_off != 1 order by server_vip desc, votes desc limit ".$settings['top_servers']);
	}
	return $result;
}

function lamx(){
$lamx=defined("SITECOPY");
if ($lamx = false)exit();
}
function dbrows($query) {
	$result = @mysql_num_rows($query);
	return $result;
}

function dbconnect($db_host, $db_user, $db_pass, $db_name) {
	$db_connect = @mysql_connect($db_host, $db_user, $db_pass);
	$db_select = @mysql_select_db($db_name);
	if (!$db_connect) {
		die("<div style='font-family:Verdana;font-size:11px;text-align:center;'><b>Не могу подключиться к MySQL</b><br />".mysql_errno()." : ".mysql_error()."</div>");
	} elseif (!$db_select) {
		die("<div style='font-family:Verdana;font-size:11px;text-align:center;'><b>НЕ могу подключиться к MySQL базе данных</b><br />".mysql_errno()." : ".mysql_error()."</div>");
	}
}
/*
* Красиво выводим массивы
* $var - переменную которую будем обрабатывать
*/
function prt($var)
{
	echo '<pre>';
	print_r($var);
	echo '</pre>';
}



/*
* Формирование ссылок на поcтраничную навигацию
*/
function link_bar($page, $count, $pages_count, $show_link, $url)
{

    // $show_link - это количество отображаемых ссылок;
    // нагляднее будет, когда это число будет парное
    // Если страница всего одна, то вообще ничего не выводим
    if ($pages_count == 1)
        return false;
    $sperator = ' '; // Разделитель ссылок; например, вставить "|" между ссылками
    // Для придания ссылкам стиля
    $style = 'style=" text-align:center;"';
    $begin = $page - intval($show_link / 2);
    unset($show_dots); // На всякий случай :)
    // Сам постраничный вывод
    // Если количество отображ. ссылок больше кол. страниц
    if ($pages_count <= $show_link + 1)
        $show_dots = 'no';
    // Вывод ссылки на первую страницу
    if (($begin > 2) && ($pages_count - $show_link > 2)) {
        echo '<li><a ' . $style . ' href=' . $url.'1> В начало </a> </li>';
    }
    for ($j = 0; $j <= $show_link; $j++) // Основный цикл вывода ссылок
        {
        $i = $begin + $j; // Номер ссылки
        // Если страница рядом с началом, то увеличить цикл для того,
        // чтобы количество ссылок было постоянным
        if ($i < 1)
            continue;
        // Подобное находится в верхнем цикле
        if (!isset($show_dots) && $begin > 1) {
            echo ' <li><a ' . $style . ' href="' . $url . '' . ($i - 1) . '"><b>...</b></a> </li>';
            $show_dots = "no";
        }
        // Номер ссылки перевалил за возможное количество страниц
        if ($i > $pages_count)
            break;
        if ($i == $page) {
            echo '<li class="active"> <a ' . $style . ' ><b>' . $i . '</b></a> </li>';
        } else {
            echo '<li> <a ' . $style . ' href="' . $url . '' . $i . '">' . $i . '</a> </li>';
        }
        // Если номер ссылки не равен кол. страниц и это не последняя ссылка
        if (($i != $pages_count) && ($j != $show_link))
            echo $sperator;
        // Вывод "..." в конце
        if (($j == $show_link) && ($i < $pages_count)) {
            echo '<li> <a ' . $style . ' href="' . $url . '' . ($i + 1) . '"><b>...</b></a> </li>';
        }
    }
    // Вывод ссылки на последнюю страницу
    if ($begin + $show_link + 1 < $pages_count) {
        echo '<li> <a ' . $style . ' href="' . $url . '' . $pages_count . '"> На последнию</a></li>';
    }
    return true;
}

function error_404(){
	global $settings;
				echo "<title>".$settings['sitename']." | 404</title>\n"
				?>
				<div class="container">
					
					<div class="row">
						
						<div class="span12">
							
							<div class="error-container">
								<h1>Упс!</h1>
								
								<h2>404 Страница не существует</h2>
								
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
}
?>
