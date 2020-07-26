$(function(){
	var loginBtn = $(".loginBtn");

	function loginEmpty(e)
	{
		var user = $(".loginUser");
		var pwd = $(".loginPwd");

		var usererror = $(".loginUserError");
		var pwderror = $('.loginPwdError');

		if(user.val() == "")
		{
			e.preventDefault();
			usererror.html("<i class='fas fa-exclamation-circle'></i> Felhasználónév mező kitöltése kötelező!");
			user.css("border", "1px solid red");
		}
		else
		{
			usererror.html("");
			user.css("border", "none");
		}
		if(pwd.val() == "")
		{
			e.preventDefault();
			pwderror.html("<i class='fas fa-exclamation-circle'></i> Jelszó mező kitöltése kötelező!");
			pwd.css("border", "1px solid red");
		}
		else
		{
			pwderror.html("");
			pwd.css("border", "none");
		}
	}
	loginBtn.on("click", function(e)
	{
		loginEmpty(e);
	});
});