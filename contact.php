<?php
/* 
     AMX MONITORING v.1.1.6
	Разработчик: Virtus-pro

	Сайт: www.amxservers.ru 
	
	******Спасибо. Надеемся Вам понравится наш продукт.********
*/
require_once LOCALE.LOCALESET."contact.php";
echo "<title>".$locale_conact['000']." | ".$settings['sitename']."</title>";

echo "<center><div id='contentForm' style='text-align:center'>";

          
          
                 $error    = ''; // сообщение об ошибке
                 $name     = ''; // имя отправителя
                 $email    = ''; // email отправителя
                 $subject  = ''; // тема
                 $message  = ''; // сообщение
               	 $spamcheck = ''; // проверка на спам

            if(isset($_POST['send']))
            {
                 $name     = stripinput($_POST['name']);
                 $email    = stripinput($_POST['email']);
                 $subject  = stripinput($_POST['subject']);
                 $message  = stripinput($_POST['message']);
				 $captcha = stripinput($_POST['keystring']);
                if(trim($name) == '')
                {
                    $error = "<div class=\"alert alert-error\" style='width:300px;text-align:center'>".$locale_conact['001']."</div></center>";
                }
            	    else if(trim($email) == '')
                {
                    $error = "<div class=\"alert alert-error\" style='width:300px;text-align:center'>".$locale_conact['002']."</div></center>";
                }
                else if(!isEmail($email))
                {
                    $error = "<div class=\"alert alert-error\" style='width:300px;text-align:center'>".$locale_conact['003']."</div></center>";
                }
            	    if(trim($subject) == '')
                {
                    $error = "<center><div class=\"alert alert-error\" style='width:300px;text-align:center'>".$locale_conact['004']."</div></center>";
                }
            	else if(trim($message) == '')
                {
                    $error = "<div class=\"alert alert-error\" style='width:300px;text-align:center'>".$locale_conact['005']."</div></center>";
                }
					
				else if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] !== $captcha){
				$error = "<div class=\"alert alert-error\">".$locale_conact['006']."</div>";
				}
				unset($_SESSION['captcha_keystring']);
                if($error == '')
                {
                    if(get_magic_quotes_gpc())
                    {
                        $message = stripslashes($message);
                    }

                 
                    $to      = $settings['siteemail'];

                
               

                    $subject = $locale_conact['007']." : " . $subject;

                    $msg     = "From : $name \r\ne-Mail : $email \r\nSubject : $subject \r\n\n" . "Message : \r\n$message";

                    mail($to, $subject, $msg, "From: $email\r\nReply-To: $email\r\nReturn-Path: $email\r\n");
            ?>

                  <div style="text-align:center;" class="alert alert-success">
                    <h2><?=$locale_conact['008']?></h2>
                       <p><?=$locale_conact['009']?><b><?=$name;?></b>, <?=$locale_conact['010']?></p>
                  </div>


            <?php
                }
            }

            if(!isset($_POST['send']) || $error != '')
            {
            ?>

            <h2><?=$locale_conact['011']?></h2>
            <?=$error;?>

            <form  method="post" name="contFrm" id="contFrm" action="">


                      <label><span class="required">*</span><?=$locale_conact['012']?></label>
            			<input name="name" type="text" class="box" id="name" size="30" value="<?=$name;?>" /><br>

            			<label><span class="required">*</span><?=$locale_conact['013']?></label>
            			<input name="email" type="text" class="box" id="email" size="30" value="<?=$email;?>" /><br>

            			<label><span class="required">*</span> <?=$locale_conact['014']?></label>
            			<input name="subject" type="text" class="box" id="subject" size="30" value="<?=$subject;?>" /><br>

                 		<label><span class="required">*</span> <?=$locale_conact['015']?></label>
                 		<textarea name="message" cols="40" rows="3"  id="message"><?=$message;?></textarea><br>

            			<label><img src="img.php?<?php echo session_name()?>=<?php echo session_id()?>" alt='<?=$locale_conact['016']?>'> </label>
						<input style="margin:5px;font-size:30px; font-color:blue; height:34px;width:120px;"  type="text" name="keystring" value="" size="6" maxlength="6"/><br /><br />

                 		<input name="send" type="submit" class="btn btn-primary" id="send" value="<?=$locale_conact['017']?>" />

            </form>

            <?php
            }

            function isEmail($email)
            {
                return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i"
                        ,$email));
            }
            ?>
     </div></center>
     

