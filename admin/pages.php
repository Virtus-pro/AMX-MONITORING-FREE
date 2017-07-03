<?php
/* 
     AMX MONITORING v.1.1.6
	Разработчик: Virtus-pro

	Сайт: www.amxservers.ru 
	
	******Спасибо. Надеемся Вам понравится наш продукт.********
*/
if (empty($_SESSION['admin_name']) or empty($_SESSION['admin_id']))die("Доступ запрещен");



if(isset($_GET['add'])){
				$pages_subject="";
				$body="";

				if (isset($_POST['save'])) {
					$error="";
					$pages_subject = mysql_real_escape_string($_POST['pages_subject']);
					$body = mysql_real_escape_string($_POST['body']);

					if ($body=="") {
						$error .= "<li>Вы не ввели Текст (HTML)</li>";
					}
					if ($pages_subject=="") {
						$error .= "<li>Вы не ввели заголовок страницы</li>";
					}
					if(isset($_POST['del'])){$del=0;}else{$del=1;}
					if($error=="") {
						$result = dbquery("INSERT INTO  `".DB_PAGES."` (
												`pages_subject` ,
												`pages_extended` ,
												`pages_datestamp` ,
												`pages_del`
												)
												VALUES (
												'".$pages_subject."',  '".$body."',  '".time()."',  '".$del."'
												);

										");
								if($result) {
									echo "<div class=\"alert alert-success\" style='text-align:left;width:500px'><p><strong><center>Страница успешно добавлена.</center></strong></p></div>";
									$status=1;
									}else{
									echo "<div class=\"alert alert-error\" style='text-align:left;width:500px'><p>Ошибка добавления страницы</p></div>";	
								}
						}else{
						echo "<div class=\"alert alert-error\" style='text-align:left;width:500px'>".$error."</div>";	
					}
					
				}
				?>
				<script type="text/javascript" src="admin/ckeditor/ckeditor.js"></script>
				<form name='inputform' method='post' action='admin/index.php?id=pages&add' > 
				<table cellpadding='0' cellspacing='0' class='center'> 
				<tr> 
				<td width='100' class='tbl'>Заголовок страницы:</td> 
				<td width='80%' class='tbl'><input type='text' name='pages_subject' value='' class='textbox' style='width: 250px' /><br /><br /></td> 
				</tr> 

				<tr> 
				<td valign='top' width='100' class='tbl'>Текст (HTML):</td> 
				<td class='tbl'><textarea name='body' id="body" cols='95' rows='10'  class="tinymce" style='width:98%'></textarea></td> 
				</tr> 
				<tr> 
				<td valign='top' width='100' class='tbl'>Активировать страницу?</td> 
				<td class='tbl'> <input type="checkbox" name="del" value="del" checked> Да</td> 
				</tr> 

				<tr> 
							<script type="text/javascript">
								CKEDITOR.replace( 'body' );
							</script>
							
				<tr> 
				<td align='left' colspan='2' class='tbl'><br /> 

				<input type='submit' name='save' value='Добавить страницу' class='btn btn-primary' /></td> 
				</tr> 
				</form>
				</table>
			<?



}elseif(isset($_GET['edit'])){


			$id=intval($_GET['edit']);
		

				if(isset($_POST['pages_subject']))$pages_subject=$_POST['pages_subject'];

				if (isset($_POST['save'])) {
					$error="";
					$pages_subject = mysql_real_escape_string($_POST['pages_subject']);
					$body = mysql_real_escape_string($_POST['body']);

					if ($body=="") {
						$error .= "<li>Вы не ввели Текст (HTML)</li>";
					}
					if ($pages_subject=="") {
						$error .= "<li>Вы не ввели заголовок страницы</li>";
					}
					if(isset($_POST['del'])){$del=0;}else{$del=1;}

					if($error=="") {
						$result = dbquery("UPDATE  `".DB_PAGES."` SET 
												`pages_subject`='".$pages_subject."' ,
												`pages_extended`='".$body."' ,
												`pages_del`='".$del."'
												WHERE pages_id='".$id."'
												

										");
								if($result) {
									echo "<div class=\"alert alert-success\" style='text-align:left;width:500px'><p><strong><center>Страница успешно сохранена.</center></strong></p></div>";
									$status=1;
									}else{
									echo "<div class=\"alert alert-error\" style='text-align:left;width:500px'><p>Ошибка при сохранении страницы</p></div>";	
								}
						}else{
						echo "<div class=\"alert alert-error\" style='text-align:left;width:500px'>".$error."</div>";	
					}
					
				}
			$result = dbquery("SELECT * FROM ".DB_PAGES." WHERE pages_id='".$id."'");
			$data_pages=dbarray_fetch($result);
				
				$pages_subject=$data_pages['pages_subject'];
				$body=$data_pages['pages_extended'];

				?>
				<script type="text/javascript" src="admin/ckeditor/ckeditor.js"></script>
				<form name='inputform' method='post' action='admin/index.php?id=pages&edit=<?php echo $id;?>' > 
				<table cellpadding='0' cellspacing='0' class='center'> 
				<tr> 
				<td width='100' class='tbl'>Заголовок страницы:</td> 
				<td width='80%' class='tbl'><input type='text' name='pages_subject' value='<?php echo $pages_subject;?>' class='textbox' style='width: 250px' /><br /><br /></td> 
				</tr> 

				<tr> 
				<td valign='top' width='100' class='tbl'>Текст (HTML):</td> 
				<td class='tbl'><textarea name='body' id="body" cols='95' rows='10'  class="tinymce" style='width:98%'><?php echo $body;?></textarea></td> 
				</tr> 
				<tr> 
				<td valign='top' width='100' class='tbl'>Активировать страницу?</td> 
				<td class='tbl'> <input type="checkbox" name="del" value="del" <?php echo ($data_pages['pages_del'] == 0 ? " checked" : "");?>> Да</td> 
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
	$result = dbquery("SELECT * FROM ".DB_PAGES."  order by pages_datestamp desc");

	echo"<center><a href='admin/index.php?id=pages&add' class=\"btn btn-info\" >Добавить страницу</a><br><br><table border='0'  align='center' cellpadding='0' cellspacing='0' class=\"table table-bordered table-striped\" style='width:60%'>";
	if(!dbrows($result)==0){
	echo "<thead><tr><th width=5px><center>ID</center></th><th ><center>Заголовок страницы</center></th><th width=150><center>Ссылка</center></th><th width=70><center>Статус</center></th><th width=100><center>Действия</center></th></tr>";
	$i=0;
		while($r=dbarray_fetch($result)) {

			$i++;

						if($r['pages_del']==0){
							$startus="<span class=\"label label-success\">Активна</span>";

						}else{
							$startus="<span class=\"label label-important\">Не активна</span>";
						}
						

			echo"<tr><td><center>".$r['pages_id']."</center></td>";
			echo"<td align='left'><a href='admin/index.php?id=pages&edit=".$r['pages_id']."' id='link'>".stripslashes($r['pages_subject'])."</a></td>";
					
			echo"<td align='center'><center><a href='pages/".$r['pages_id']."' target='_blank'> Ссылка</a><br> <small>(откроется в новом окне)</small></center></td>";			
			echo"<td align='center'><center>".$startus."</center></td>";


									echo "<td class=\"td-actions\"><center>";

									
									echo "	<a href=\"admin/index.php?id=pages&edit=".$r['pages_id']."\" class=\"btn btn-small btn-primary\">";
									echo "		<i class=\"btn-icon-only  icon-pencil\"></i>				";						
									echo "	</a>";									
									echo "
											<a class=\"btn btn-danger\" onClick='return DeleteItem(".$r['pages_id'].")'>
											";
									echo "		<i class=\"btn-icon-only icon-remove\"></i>	";									
									echo "	</a>";
									
									
									echo "</center></td>";
					
					
			echo "</tr></tr>";
		}
	}else {
		echo "<th><center> Страниц в базе нет</center></th>";
	}
	echo"</tbody></table></center>";
}



?>
<script type='text/javascript'>function DeleteItem(id) {
	if (confirm("Уверены, что хотите удалить страницу?")) {
	document.location.href='admin/index.php?id=obpost&pages&pages_id='+id+'&del';
	} else { alert("Действие отменено"); }
	} </script>




