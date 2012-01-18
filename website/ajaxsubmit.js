$(document).ready(function(){
    $('#email').blur(function(){
	$.ajax({
	    type: 'POST'
	    url: 'post.php'
	    dataType: 'json'
	    data: { user_email: $('#email').val()
		  },
	    success: function(data){
		if ($return_array[0] == false)
		{ document.getElementById("pass_match").innerHTML = '<p> <color=red> Email Already in our records, etc. </p>'}
	});
    });
return false;
});