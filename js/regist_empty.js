$(function(){
	var registBtn = $(".registBtn");

	var pwdagainfield = $(".registPwdAgain");

	function registEmpty(e)
	{
		var user = $(".registUser");
		var pwd = $(".registPwd");
		var pwdagain = $(".registPwdAgain");

		var usererror = $(".registUserError");
		var pwderror = $(".registPwdError");
		var pwdagainerror = $(".registPwdAgainError");

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
		if(pwdagain.val() == "")
		{
			e.preventDefault();
			pwdagainerror.html("<i class='fas fa-exclamation-circle'></i> Jelszó ismét mező kitöltése kötelező!");
			pwdagain.css("border", "1px solid red");
		}
		else
		{
			pwdagainerror.html("");
			pwdagain.css("border", "none");
		}
		if(user.val() != "" && pwd.val() != "" && pwdagain.val() != "")
		{
			if(pwd.val() != pwdagain.val())
			{
				e.preventDefault();
				pwdagainerror.html("<i class='fas fa-exclamation-circle'></i> Jelszavaknak meg kell egyezniük!");
				pwdagain.css("border", "1px solid red");
				pwd.css("border", "1px solid red");
			}
			else
			{
				pwdagainerror.html("");
				pwdagain.css("border", "none");
				pwd.css("border", "none");
			}
			if(pwd.val().length < 5 && pwd.val()!= "")
			{
				e.preventDefault();
				pwderror.html("<i class='fas fa-exclamation-circle'></i> Jelszó minimum 5 karakter!");
				pwd.css("border", "1px solid red");
			}
			else
			{
				pwderror.html("");
				pwd.css("border", "none");
			}
		}
	}
	registBtn.on("click", function(e)
	{
		registEmpty(e);
	});
	pwdagainfield.on("keyup", function(e)
	{
			pwdagainfield.css("border","none");
			$(".registPwdAgainError").html("");
	});


});