$(document).ready(function() {
  valid_email = false;
  $("input#email_register").blur(function() {
    $.ajax({
      url:"validateemail.php",
      type:"GET",
      dataType: "json",
      data : {
        email : $('input#email_register').val()
      },
      success : function(data) {
                  if(data[0]) { //true -> email taken
                    $('input#email_register').addClass('error');
                    $('div#email_register').addClass('error').removeClass('success');
                    $('#email_taken').show();
                    $('#email_free').hide();
                    valid_email = false;
                  } else {
                    $('input#email_register').addClass('error');
                    $('div#email_register').addClass('success').removeClass('error');
                    $('#email_taken').hide();
                    $('#email_free').show();
                    valid_email = true;
                  }
                }
    });
    return false;
  });
  
  $.passwords_match = function() {
    return ($("input#confirm_password").val() == $("#password_register").val()); 
  }
  $("input#confirm_password").keyup(function() {
    $.show_passwords_valid();
  });
  $("input#password_register").keyup(function() {
    if($("input#confirm_password").val() != '') {
      $.show_passwords_valid();
    }
  });

  $.show_passwords_valid = function() {
    if($.passwords_match()) {
      $('div#confirm_password').addClass('success').removeClass('error');
      $('input#confirm_password').addClass('error');
      $('#password_match').show();
      $('#password_different').hide();
    } else {
      $('div#confirm_password').addClass('error').removeClass('success');
      $('input#confirm_password').addClass('error');
      $('#password_match').hide();
      $('#password_different').show();
    }
  }

  $("#register_submit").click(function() {
   if(valid_email && $.passwords_match()) {
      return true;
   } else {
     $('#bad_registration').show()
     return false;
   }
  });



});

