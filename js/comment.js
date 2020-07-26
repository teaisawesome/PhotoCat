$(function()
{
	var comment = $(".comment");

	comment.on("click", function()
	{			
		
		$.ajax
		({
					
					url: 'classes/comment.php',
					type: 'post',
					data:
					{
						uname: user
					},
					success: function(data)
					{
						
					}
		});
	});
});