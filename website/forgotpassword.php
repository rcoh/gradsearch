<?php
require ('util.php');
$con = get_con();

$email=$_POST['email'];
$adminemail = 'gradschool-search@mit.edu';

if (!email_exists($email, $con)){
echo '<script language="javascript">alert("This email address does not exist. Please try again.")</script>';
}
$query = "select password from users where email='$_POST[email]'";
$result = query_or_die($query, $con);
$row = mysql_fetch_row($result);
else {
$to = $email;
$subject = "Gradsearch Login Details ...";
$message = "This is in response to your request for login details to Gradsearch.\n\nYour Password is ".$row.".\n\n Log in now and access your preferences. ";
$headers = "From: ".$adminemail."\r\n Reply-To: ".$email;

if(mail($to, $subject, $message, $headers)){echo "<center> Your password has been sent to your email address. Please check your mail soon.</center>";}

else{echo "<center>There is some system problem in sending your password to your email address. </br></br><input type='button' value='Retry' onClick='history.go(-1)'></center>";} 

}

?>