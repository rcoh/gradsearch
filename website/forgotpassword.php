<?php
require ('util.php');
$con = get_con();

$email='';
$new_password = generatePassword(9,1);
$hash_new_password = hashpass($new_password);

if(isset($_POST['email'])) {
  $email = $_POST['email']; 
  $new_query = "select password from users 
    where email='$_POST[email]'";
  $result = query_or_die($new_query, $con);
  $row = mysql_fetch_row($result);
  if(!$row) {
    $no_user="error";
    $help_text_user = "This email address is not registered for this site";
  } 
  }
$adminemail = 'gradschool-search@mit.edu';
if(isset($_POST['email'])){

$query = "UPDATE users SET password = '$hash_new_password' where email='$_POST[email]'";
$result = query_or_die($query, $con);
}

function generatePassword($length, $strength) {
	$vowels = 'aeuy';
	$consonants = 'bdghjmnpqrstvz';
	if ($strength & 1) {
		$consonants .= 'BDGHJLMNPQRSTVWXZ';
	}
	if ($strength & 2) {
		$vowels .= "AEUY";
	}
	if ($strength & 4) {
		$consonants .= '23456789';
	}
	if ($strength & 8) {
		$consonants .= '@#$%';
	}
 
	$password = '';
	$alt = time() % 2;
	for ($i = 0; $i < $length; $i++) {
		if ($alt == 1) {
			$password .= $consonants[(rand() % strlen($consonants))];
			$alt = 0;
		} else {
			$password .= $vowels[(rand() % strlen($vowels))];
			$alt = 1;
		}
	}
	return $password;
}
 


if (email_exists($email, $con)) {
$to = $email;
$subject = "Gradsearch Login Details ...";
$message = "This is in response to your request for login details to Gradsearch.\n\nYour Password is ".$new_password.".\n\n Log in now and change your password to something you can remember! ";
$headers = "From: ".$adminemail."\r\n Reply-To: ".$email;

if(mail($to, $subject, $message, $headers)){
include("sent_email.php");}

}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Graduate School Search</title>
        <meta name="description" content="Search for professors by research interest">
        <meta name="author" content="Leah Alpert, Russell Cohen, Ram Bhaskar">
        <!-- styles -->
        <link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css">
        <link rel="stylesheet" href="my_css.css">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.5.2/jquery-ui.min.js"></script>
        <!-- Le fav and touch icons ??? -->
        <link rel="shortcut icon" href="images/favicon.ico">
        <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
    </head>
    <body>
        <?php include('topbar.php'); ?>
        <div class="container">
            <div id="main_content" style="margin:50px 0px 200px 0px;">
                <div class="hero-unit" id="login" style="float:left;">
			
                    <form action="forgotpassword.php" method="post">
                        <fieldset>
                            <legend>
                                Forgot Password?
                            </legend>
                            
                            <div class="clearfix <?php echo $no_user;?>">
                                <label for="email">
                                    Email
                                </label>
                                <div class="input">
                                    <input class="xlarge <?php echo $no_user; ?>" id="email" value="<?php echo $email; ?>" name="email" size="30" type="text" />
                                    <?php 
if (isset($help_text_user)) {
  echo "<span class=\"help-inline\">". $help_text_user . "</span>";
}
                                    ?>
                                </div>
                            </div><!-- /clearfix -->
                            
							<div style="margin-left:150px;">
            <input id="register_submit" type="submit" class="btn primary" value="Recover Password">
            <span id="bad_registration" style="display:none">
Please style me leaAHAHAHAH!! And also please correct your errors before submitting</span>
          </div>
                        </fieldset>
                    </form>
                </div>
            </div>
            <div class="floater" style="height:150px;">
            </div>
            <footer class="center" style="vertical-align:bottom;">
                <p>
                    &copy; 2012 re:search
                </p>
            </footer>
        </div>
        <!-- /container -->
    </body>
</html>
