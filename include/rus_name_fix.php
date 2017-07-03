<?
/* 
     AMX MONITORING v.1.1.6
	Разработчик: Virtus-pro

	Сайт: www.amxservers.ru 
	
	******Спасибо. Надеемся Вам понравится наш продукт.********
*/
  function name_filtered($name)
  {
    $name = iconv('UTF-8', 'windows-1251', $name);
    $name = preg_replace("/[^(\x9|\xA|\xD|\x20-\xD7FF|\xE000-\xFFFD|\x10000\-\x10FFFF)]*/", "", $name);
    if (strlen($name)<=50) return $name; 
    return substr($name,0,50).'... ';
  }

?>
