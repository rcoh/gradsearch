<?php
require ('util.php');
$con = get_con();

$email=$_POST['email'];
$adminemail = 'gradschool-search@mit.edu';

$new_password = generatePassword(9,1);
$hash_new_password = hashpass($new_password);
$query = "UPDATE users SET password = '$hash_new_password' where email='$_POST[email]'";
$result = query_or_die($query, $con);
 
function generatePassword($length=9, $strength=0) {
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
 

if (!email_exists($email, $con)){
echo '<script language="javascript">alert("This email address does not exist. Please try again.")</script>';
}
else {
$to = $email;
$subject = "Gradsearch Login Details ...";
$message = "This is in response to your request for login details to Gradsearch.\n\nYour Password is ".$new_password.".\n\n Log in now and change your password to something you can remember! ";
$headers = "From: ".$adminemail."\r\n Reply-To: ".$email;

if(mail($to, $subject, $message, $headers)){echo "<center> Your password has been sent to your email address. Please check your mail soon.</center>";}

else{echo "<center>There is some system problem in sending your password to your email address. </br></br><input type='button' value='Retry' onClick='history.go(-1)'></center>";} 

}

?>