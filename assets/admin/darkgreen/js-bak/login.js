$(document).ready(function() { 
	
     // change Password
    $('#btn-changepassword').on('click', function(e) {
        changePassword();								   
    });
	
    // creat User
    $('#btnSaveAdminUser').on('click', function(e) { 
         creatUser();							   
    });
	
	

    /*
    $('.remember').on('click', function(e) { 
            if ( $('#remember').is(":checked") ) { 
                    $('#remember').removeAttr('checked');
            } else {
                    $('#remember').attr('checked', 'checked');
            }			   
    });
    */
	
});

function hideFieldRequire(field){
	$('#'+field).html(''); 
}

// var test = !validateEmail(email) ? 0 : 1; 
function validateEmail($email) {
  	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  	return emailReg.test( $email );
}

function isnumberic(s) {
	var str="01234556789";
	var i, l, ch;
	l = s.length;
	
	for(i=0; i<l; i++) 	{
		ch=s.charAt(i);
		if(str.indexOf(ch)== -1) return false;
	}
	
	return true;
}


function changePassword(){
    var new_pwd 	= $('#new_pwd').val();
    var confirm_new_pwd = $('#confirm_new_pwd').val();
	
	if( new_pwd != confirm_new_pwd || new_pwd =='' || confirm_new_pwd =='') {
        $('#valid_confirm_new_pwd').html(passsword_not_match); return;
    }
	

    $('form#frm_data').submit();
}

function creatUser(){
    var user_name 	= $('#user_name').val();
    var user_password = $('#user_password').val();
	var confirm_new_pwd = $('#re-user_password').val();
	var role_id = $('#role_id').val();
	
	if( user_name == '') {
        $('#valid_user_name').html(require_username); return;
    }
	
	if(user_name.match(/\s/g)) {
		$('#valid_user_name').html(username_invalid_there_space); return;
	}
	
	if( user_password != confirm_new_pwd || user_password =='' || confirm_new_pwd =='') {
        $('#valid_confirm_new_pwd').html(passsword_not_match); return;
    }
	
    if( role_id == '') {
        $('#valid_role_id').html(require_role); return;
    }

    $('form#frm_data').submit();
}