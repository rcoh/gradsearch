$(document).ready(function() {
  $.passwords_valid = function() {
    return $("input#confirm_password").val() == $("#password_register").val() &&
      $("input#password_register").val() != ''; 
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
    if($.passwords_valid()) {
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
   if($.passwords_valid()) {
      return true;
   } else {
     $('#bad_registration').show()
     return false;
   }
  });
});