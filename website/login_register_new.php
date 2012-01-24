<?php
  session_start();
  require('util.php');
$con = get_con();
$email = "";
if(isset($_POST['pass']) && isset($_POST['email'])) {
  $email = $_POST['email'];
  $hashed=hashpass($_POST['pass']); 
  $query = "select password from users 
    where email='$_POST[email]'";
  $result = query_or_die($query, $con);
  $row = mysql_fetch_row($result);
  if(!$row) {
    $no_user="error";
    $help_text_user = "This email address is not registered for this site";
  } else if($row[0] == $hashed) {
    $_SESSION['email'] = $email; 
    go_home();
  } else {
    $bad_pass = "error";
    $help_text_pass = "Invalid password. TODO: forgot password";
  }
} 
?>
 <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Login | re:search</title>
        <meta name="description" content="Search for professors by research interest">
        <meta name="author" content="Leah Alpert, Russell Cohen, Ram Bhaskar">
        <!-- styles -->
        <link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css">
        <link rel="stylesheet" href="my_css.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
        <script src="js/register.js"></script>
        <!-- Le fav and touch icons ??? -->
        <link rel="shortcut icon" href="images/favicon.ico">
        <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
    </head>
    <body>
        <?php include('topbar.php'); ?>
        <div class="floater" style="height:30px;">
        </div>
        <div class="container">
            <div class="row">
                <div class="span8" id="login">
                    <form action="loginregister.php" method="post">
                        <fieldset>
                            <legend>
                                Log In
                            </legend>
                            <div class="clearfix <?php echo $no_user;?>">
                                <label for="email">
                                    Email
                                </label>
                                <div class="input">
                                    <input class="xlarge <?php echo $no_user; ?>" id="email" value="<?php echo $email; ?>" name="email" size="30" type="text" />
                                    <?php 
if (isset($help_text_user)) {
  echo "<span class=\"help-inline\">" . $help_text_pass . "</span>";
}
                                    ?>
                                </div>
                            </div><!-- /clearfix -->
                            <div class="clearfix <?php echo $bad_pass;?>">
                                <label for="pass">
                                    Password
                                </label>
                                <div class="input">
                                    <input class="xlarge <?php echo $bad_pass;?>" id="pass" name="pass" size="30" type="password" />
                                    <?php 
if (isset($help_text_pass)) {
  echo "<span class=\"help-inline\">" . $help_text_pass . "</span>";
}
                                    ?>
                                </div>
                            </div><!-- /clearfix -->
                            <div style="margin-left:150px;">
                                <input type="submit" class="btn primary" value="Log in">
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="span8" id="register">
                    <form action="newuser.php" method="post">
                        <fieldset>
                            <legend>
                                Register
                            </legend>
                            <div class="clearfix">
                                <label for="email_register">
                                    Email
                                </label>
                                <div class="input">
                                	<input class="large" id="email_register" name="email" size="30" type="text" />
                                </div>
                                <div class="message_space">
                                    <span class="help-inline" id="email_taken" style="display:none">Whoops!  Someone already has that email.</span>
                                    <span class="help-inline" id="email_free" style="display:none">You're home free!  That email is all yours. </span>
                                </div>
                            </div>
                            <!-- /clearfix -->
                            <div class="clearfix">
                                <label for="password_register">
                                    Password
                                </label>
                                <div class="input">
                                    <input class="large" id="password_register" name="password" size="30" type="password" />
                                </div>
                                <div class="message_space">
                                    <span class="help-inline" id="password_short" style="display:none">Password must be at least 6 characters.</span>
                                    <span class="help-inline" id="password_good" style="display:none">Perfect!</span>
                                </div>
                            </div>
                            <!-- /clearfix -->
                            <div class="clearfix">
                                <label for="confirm_password">
                                    Confirm Password
                                </label>
                                <div class="input">
                                    <input class="large" id="confirm_password" name="confirm_password" size="30" type="password" />
                                </div>
                                <div class="message_space">
                                    <span class="help-inline" id="password_different" style="display:none">Uh oh.  Passwords are different or empty... </span>
                                    <span class="help-inline" id="password_match" style="display:none">Huzzahh!  Passwords match!</span>
                                </div>
                            </div>
                            <!-- /clearfix -->
                            <div style="margin-left:150px;">
                                <input type="submit" class="btn primary" value="Register">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="floater" style="height:100px;">
        </div>
        <footer class="stuck">
            <p>
                &copy; 2012 re:search
            </p>
        </footer>
        </div>
        <!-- /container -->
    </body>
</html>
