$(function(){

	//error üzenetek mezői
	var reg_btn = $('#reg_btn');
	var log_btn = $('#log_btn');


	function registationEmpty(e)
	{
		var user = $(".reg_user").val();
		var pwd = $(".reg_pwd").val();
		var pwdCopy = $(".reg_pwd_copy").val();

			var usererror = $(".userError");
			var pwderror = $('.pwdError');
			var pwdagainerror = $('.pwdAgainError');


		if(user == "")
		{
			e.preventDefault();
			usererror.html("Felhasználónév mező kitöltése kötelező!");
		}
		else
		{
			usererror.html("");
		}
		if(pwd == "")
		{
			e.preventDefault();
			pwderror.html("Jelszó mező kitöltése kötelező!");
		}
		else
		{
			pwderror.html("");
		}
		if(pwdCopy == "")
		{
			e.preventDefault();
			pwdagainerror.html("Jelszó ismét mező kitöltése kötelező!");
		}
		else
		{
			if(pwd != pwdCopy)
			{
				e.preventDefault();
				pwdagainerror.html("Jelszavaknak meg kell egyezniük!");
			}
			else
			{
				pwdagainerror.html("");
			}
		}
	}
	function loginEmpty(e)
	{
		var user = $(".log_user").val();
		var pwd = $(".log_pwd").val();


		var usererror = $(".userError");
		var pwderror = $('.pwdError');

		if(user == "")
		{
			e.preventDefault();
			usererror.html("Felhasználónév mező kitöltése kötelező!");
		}
		else
		{
			usererror.html("");
		}
		if(pwd == "")
		{
			e.preventDefault();
			pwderror.html("Jelszó mező kitöltése kötelező!");
		}
		else
		{
			pwderror.html("");
		}
	}
	reg_btn.on('click', function(e)
	{
		registationEmpty(e);
	});
	log_btn.on('click', function(e)
	{
		loginEmpty(e);
	});
});