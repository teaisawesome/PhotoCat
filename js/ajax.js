$(function(){

	$('#select').on('change', function(){
				$.ajax
				({
					url: 'registration.php',
					type: 'post',
					success: function(data)
					{
						$("#result").html(data);
					}
				});
			});
});