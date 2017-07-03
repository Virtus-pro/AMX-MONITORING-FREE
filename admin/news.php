<?php
/* 
     AMX MONITORING v.1.1.6
	Разработчик: Virtus-pro

	Сайт: www.amxservers.ru 
	
	******Спасибо. Надеемся Вам понравится наш продукт.********
*/
if (empty($_SESSION['admin_name']) or empty($_SESSION['admin_id']))die("Доступ запрещен");


if(isset($_GET['add'])){
				$news_subject="";
				$body="";

				if (isset($_POST['save'])) {
					$error="";
					$news_subject = mysql_real_escape_string($_POST['news_subject']);
					$body = mysql_real_escape_string($_POST['body']);

					if ($body=="") {
						$error .= "<li>Вы не ввели текст новости</li>";
					}
					if ($news_subject=="") {
						$error .= "<li>Вы не ввели заголовок новости</li>";
					}
					if(isset($_POST['del'])){$del=0;}else{$del=1;}
					if($error=="") {
						$result = dbquery("INSERT INTO  `".DB_NEWS."` (
												`news_subject` ,
												`news_extended` ,
												`news_datestamp` ,
												`news_del`
												)
												VALUES (
												'".$news_subject."',  '".$body."',  '".time()."',  '".$del."'
												);

										");
								if($result) {
									echo "<div class=\"alert alert-success\" style='text-align:left;width:500px'><p><strong><center>Новость успешно добавлена.</center></strong></p></div>";
									$status=1;
									}else{
									echo "<div class=\"alert alert-error\" style='text-align:left;width:500px'><p>Ошибка добавления новости</p></div>";	
								}
						}else{
						echo "<div class=\"alert alert-error\" style='text-align:left;width:500px'>".$error."</div>";	
					}
					
				}
				?>
				<script type="text/javascript" src="admin/ckeditor/ckeditor.js"></script>
				<form name='inputform' method='post' action='admin/index.php?id=news&add' > 
				<table cellpadding='0' cellspacing='0' class='center'> 
				<tr> 
				<td width='100' class='tbl'>Тема:</td> 
				<td width='80%' class='tbl'><input type='text' name='news_subject' value='' class='textbox' style='width: 250px' /><br /><br /></td> 
				</tr> 

				<tr> 
				<td valign='top' width='100' class='tbl'>Текст новости:</td> 
				<td class='tbl'><textarea name='body' id="body" cols='95' rows='10'  class="tinymce" style='width:98%'></textarea></td> 
				</tr> 
				<tr> 
				<td valign='top' width='100' class='tbl'>Активировать новость?</td> 
				<td class='tbl'> <input type="checkbox" name="del" value="del" checked> Да</td> 
				</tr> 

				<tr> 
							<script type="text/javascript">
								CKEDITOR.replace( 'body' );
							</script>
							
				<tr> 
				<td align='left' colspan='2' class='tbl'><br /> 

				<input type='submit' name='save' value='Добавить новость' class='btn btn-primary' /></td> 
				</tr> 
				</form>
				</table>
			<?



}elseif(isset($_GET['edit'])){


			$id=intval($_GET['edit']);
		

				if(isset($_POST['news_subject']))$news_subject=$_POST['news_subject'];

				if (isset($_POST['save'])) {
					$error="";
					$news_subject = mysql_real_escape_string($_POST['news_subject']);
					$body = mysql_real_escape_string($_POST['body']);

					if ($body=="") {
						$error .= "<li>Вы не ввели текст новости</li>";
					}
					if ($news_subject=="") {
						$error .= "<li>Вы не ввели заголовок новости</li>";
					}
					if(isset($_POST['del'])){$del=0;}else{$del=1;}

					if($error=="") {
						$result = dbquery("UPDATE  `".DB_NEWS."` SET 
												`news_subject`='".$news_subject."' ,
												`news_extended`='".$body."' ,
												`news_del`='".$del."'
												WHERE news_id='".$id."'
												

										");
								if($result) {
									echo "<div class=\"alert alert-success\" style='text-align:left;width:500px'><p><strong><center>Новость успешно сохранена.</center></strong></p></div>";
									$status=1;
									}else{
									echo "<div class=\"alert alert-error\" style='text-align:left;width:500px'><p>Ошибка при сохранении новости</p></div>";	
								}
						}else{
						echo "<div class=\"alert alert-error\" style='text-align:left;width:500px'>".$error."</div>";	
					}
					
				}
			$result = dbquery("SELECT * FROM ".DB_NEWS." WHERE news_id='".$id."'");
			$data_news=dbarray_fetch($result);
				
				$news_subject=$data_news['news_subject'];
				$body=$data_news['news_extended'];

				?>
				<script type="text/javascript" src="admin/ckeditor/ckeditor.js"></script>
				<form name='inputform' method='post' action='admin/index.php?id=news&edit=<?php echo $id;?>' > 
				<table cellpadding='0' cellspacing='0' class='center'> 
				<tr> 
				<td width='100' class='tbl'>Тема:</td> 
				<td width='80%' class='tbl'><input type='text' name='news_subject' value='<?php echo $news_subject;?>' class='textbox' style='width: 250px' /><br /><br /></td> 
				</tr> 

				<tr> 
				<td valign='top' width='100' class='tbl'>Текст новости:</td> 
				<td class='tbl'><textarea name='body' id="body" cols='95' rows='10'  class="tinymce" style='width:98%'><?php echo $body;?></textarea></td> 
				</tr> 
				<tr> 
				<td valign='top' width='100' class='tbl'>Активировать новость?</td> 
				<td class='tbl'> <input type="checkbox" name="del" value="del" <?php echo ($data_news['news_del'] == 0 ? " checked" : "");?>> Да</td> 
				</tr> 				
				
				<tr> 
							<script type="text/javascript">
								CKEDITOR.replace( 'body' );
							</script>
							
				<tr> 
				<td align='left' colspan='2' class='tbl'><br /> 

				<input type='submit' name='save' value='Сохранить' class='btn btn-primary' /></td> 
				</tr> 
				</form>
				</table>
			<?



}else{
	$result = dbquery("SELECT * FROM ".DB_NEWS."  order by news_datestamp desc");

	echo"<center><a href='admin/index.php?id=news&add' class=\"btn btn-primary\" >Добавить новость</a><br><br><table border='0'  align='center' cellpadding='0' cellspacing='0' class=\"table table-bordered table-striped\" style='width:60%'>";
	if(!dbrows($result)==0){
	echo "<thead><tr><th width=5px><center>ID</center></th><th width=350><center>Заголовок новости</center></th><th width=70><center>Статус</center></th><th width=70><center>Действия</center></th></tr>";
	$i=0;
		while($r=dbarray_fetch($result)) {

			$i++;

						if($r['news_del']==0){
							$startus="<span class=\"label label-success\">Активна</span>";

						}else{
							$startus="<span class=\"label label-important\">Не активна</span>";
						}
						

			echo"<tr><td><center>".$r['news_id']."</center></td>";
			echo"<td align='left'><a href='admin/index.php?id=news&edit=".$r['news_id']."' id='link'>".stripslashes($r['news_subject'])."</a></td>";
					
						
			echo"<td align='center'><center>".$startus."</center></td>";


									echo "<td class=\"td-actions\"><center>";

									
									echo "	<a href=\"admin/index.php?id=news&edit=".$r['news_id']."\" class=\"btn btn-small btn-primary\">";
									echo "		<i class=\"btn-icon-only  icon-pencil\"></i>				";						
									echo "	</a>";									
									echo "
											<a class=\"btn btn-danger\" onClick='return DeleteItem(".$r['news_id'].")'>
											";
									echo "		<i class=\"btn-icon-only icon-remove\"></i>	";									
									echo "	</a>";
									
									
									echo "</center></td>";
					
					
			echo "</tr></tr>";
		}
	}else {
		echo "<th><center> Новостей в базе нет</center></th>";
	}
	echo"</tbody></table></center>";
}



?>
<script type='text/javascript'>function DeleteItem(id) {
	if (confirm("Уверены, что хотите удалить новость?")) {
	document.location.href='admin/index.php?id=obpost&news&news_id='+id+'&del';
	} else { alert("Действие отменено"); }
	} </script>




