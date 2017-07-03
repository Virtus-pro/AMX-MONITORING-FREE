<?php
/* 
     AMX MONITORING v.1.1.6
	Разработчик: Virtus-pro

	Сайт: www.amxservers.ru 
	
	******Спасибо. Надеемся Вам понравится наш продукт.********
*/
    session_start();
    ?>
    <form action="index.php" method="post">
    <p>Enter text shown below:</p>
    <p><img src="test.php?<?php echo session_name()?>=<?php echo session_id()?>"></p>
    <p><input type="text" name="keystring"></p>
    <p><input type="submit" value="Check"></p>
    </form>
    <?php
    if(count($_POST)>0){
        if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] ==  $_POST['keystring']){
            echo "Correct";
        }else{
            echo "Wrong";
        }
    }
    unset($_SESSION['captcha_keystring']);
    ?> 