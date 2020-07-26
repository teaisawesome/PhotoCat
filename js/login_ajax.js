$(function(){
	$(".loginBtn").on("click", function()
	{			

				var user = $(".loginUser").val();
				var pwd = $(".loginPwd").val();

				$.ajax
				({
					url: 'classes/login.php',
					type: 'post',
					data:
					{
						uname: user,
						pword: pwd
					},
					success: function(data)
					{
						$(".loginUserError").html(data);
					}
				});
	});
});