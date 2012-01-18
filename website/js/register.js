$(document).ready(function() {
  $("#email_register").blur(function() {
    $.ajax({
      url:"validateemail.php",
      type:"GET",
      dataType: "json",
      data : {
        email : $('#email_register').val()
      },
      success : function(data) {
                  if(data[0]) { //true -> email taken
                    $('#email_register').addClass('error');
                    $('#email_reg_div').addClass('error').removeClass('success');
                    $('#email_taken').show();
                    $('#email_free').hide();
                  } else {
                    $('#email_register').addClass('error');
                    $('#email_reg_div').addClass('success');
                    $('#email_taken').hide();
                    $('#email_free').show();
                  }
                }
    });
    return false;
  });
});

