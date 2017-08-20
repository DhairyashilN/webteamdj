$("#name").keypress(function(event){
	var inputValue = event.which;
	if(!(inputValue >= 65 && inputValue <= 122) && (inputValue != 32 && inputValue != 0) && (inputValue != 46)) { 
		return false; 
	}
});

$("#phone").keypress(function (e) {
	if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)  ) {
		return false;
	}
});

//check for password and confirm password field is matching
$('#cpassword').on('keyup', function(){
	if(($('#password').val()) != ($('#cpassword').val())) {
		$('#pass-warning').text('Password and confirm password are not matching.');
		//$('#pass-warning').css('color','red');
	} else {
		$('#pass-warning').text('');
	}
});

//check for email availability
$("#user_email").on('blur',function(){
	var email = $('#user_email').val();
	/*$.ajax({
		url:'checkuser',
		data:{email:email},
		type:'POST',
		success:function(data){
			console.log('email');	
		}
	});*/
});
