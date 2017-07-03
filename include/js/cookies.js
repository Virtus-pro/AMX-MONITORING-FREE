$(document).ready(function(){

 
	$("a.vote").click(function(){
	the_id = $(this).attr('id');
	
	if ($.cookies.get("vote" + the_id)) alert ("Вы уже голосовали");
	// Проверяем, есть ли кука?

    
	else // Если нет, то тогда работаем дальше
	{
	$(this).parent().html("<img src='images/spinner.gif'/>");
	$("span#votes_count"+the_id).fadeOut("fast");
	
	// ajax - запрос
		$.ajax({
			type: "POST",
			data: "action=vote&id="+$(this).attr("id"),
			url: "votes.php",
			success: function(msg)
			{
				$("span#votes_count"+the_id).html(msg);
				
				$("span#votes_count"+the_id).fadeIn();
		
				$("span#vote_buttons"+the_id).remove();
				// добавляем куку
				$.cookies.set("vote" + the_id, 12345679, {hoursToLive: 24});
			}
		});
	} // конец условия
	});
	
});	