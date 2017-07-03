<?php
/* 
     AMX MONITORING v.1.1.6
	Разработчик: Virtus-pro

	Сайт: www.amxservers.ru 
	
	******Спасибо. Надеемся Вам понравится наш продукт.********
*/

/* Добавлено */
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
/* Конец Добавлено */
require_once("maincore.php");
/* Добавлено */
$day = date("Y-m-d H:i:s");
dbquery ("DELETE FROM ".DB_VOTES." WHERE date_resp < '$day'");
/* Конец Добавлено */

function getAllVotes($id)
	{
	/**
	Returns an array whose first element is votes_up and the second one is votes_down
	**/
	$votes = array();
	$q = "SELECT * FROM ".DB_SERVERS." WHERE server_id = $id";
	$r = dbquery($q);
	if(mysql_num_rows($r)==1)//id наден в таблице
		{
		$row = dbarray($r);
		$votes[0] = $row['votes'];
		}
	return $votes;
	}

function getEffectiveVotes($id)
	{
	/**
	Returns an integer
	**/
	$votes = getAllVotes($id);
	$effectiveVote = $votes[0];
	return $effectiveVote;
	}

$id = intval($_POST['id']);

//get the current votes
$cur_votes = getAllVotes($id);


/* Добавлено */
// проверяем юзера на IP
$ip = $_SERVER['REMOTE_ADDR']; 
$r = dbquery("SELECT * FROM ".DB_VOTES." WHERE id_resp = '$id' AND ip = '$ip'");
if(mysql_num_rows($r)==1)
{
echo getEffectiveVotes($id);
exit;
}
	$votes_up = $cur_votes[0]+1;
$q = "UPDATE ".DB_SERVERS." SET votes = $votes_up WHERE server_id = $id";

dbquery($q);
if(mysql_affected_rows())
    {
    $effectiveVote = getEffectiveVotes($id);
    echo $effectiveVote;
    $date_resp = date("Y-m-d",time()+ 1*24*60*60); // запоминаем завтрашнююю дату
	dbquery("INSERT INTO ".DB_VOTES."(id_resp, ip, date_resp) VALUES ('".$id."','".$ip."','".$date_resp."')");
    // В таблицу vote_ip заносим id статьи, ip посетителя и завтрашнюю дату-время
    }

elseif(!$r) 
	{
	echo "Ошибка!";
	}
}
else
{
header("Location: /"); exit;
}

?>
