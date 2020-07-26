$(function()
{
	var btn = $("#save");

	function categoryEmpty(e)
	{
		var categoryname = $("#categoryName");

		var error = $("#categoryNameError");

		if(categoryname.val() == "")
		{
			e.preventDefault();
			categoryname.css("border","1px solid red");
			error.html("<i class='fas fa-exclamation-circle'></i> Kategória név mező kitöltése kötelező!");
		}
		else
		{
			categoryname.css("border","none");
			error.html("");
		}
	}

	btn.on('click', function(e){
		categoryEmpty(e);
	});
});