$(function()
{
	$(".registUser").on("keyup", function()
	{			
				var user = $(".registUser").val();
				
				//foglalt felhasználónév ellenőrzés AJAX-al
				$.ajax
				({
					url: 'classes/checkUsernameCaller.php',
					type: 'post',
					data:
					{
						uname: user
					},
					success: function(data)
					{
						$(".registUserError").html(data);
						if(user == "")
						{
							$(".registUserError").html("");
						}
						else
						{
							$(".registUser").css("border", "none");
						}
					}
				});
	});
	$(".registPwd").on("keyup", function()
	{
				var pwd = $(".registPwd").val();

				//megfelelő hosszúságú jelszó ellenőrzés AJAX-al
				$.ajax
				({
					url: 'classes/checkPasswordLengthCaller.php',
					type: 'post',
					data:
					{
						pword: pwd
					},
					success: function(data)
					{
						$(".registPwdError").html(data);
						if(pwd == "")
						{
							$(".registPwdError").html("");
						}
						else
						{
							$(".registPwd").css("border", "none");
						}
						if(pwd.length > 4)
						{
							$(".registPwdError").html("");
							$(".registPwd").css("border", "none");
						}
					}
				});
	});
});