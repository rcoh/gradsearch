<!--TODO:
  Beautify
  Form validation
  Ajax?
-->
<html>
<body>
Signup!
<form name= "signup" action="newuser.php" method="post">
Email: <input type="text" name="email" value="" /> <br />
Password: <input type="password" name="password1" value="" /> <br />
Confirm Password: <input type="password" name="password2" value="" /> <br />
<script type="text/javascript">
//first, we check if the email is already in our records:
    function readEmail (form){
	email = signup.email.value;
	//access the db and check if email is already taken
	document.write("email already in our records")
    }


// wanna check if password matches confirm password or is empty
function readpassword (form){
    if (signup.password1.value.length || signup.password2.value.length) ==0)
    {document.write("Password is blank!")
    }
    else if (signup.password1.value != signup.password2.value)
    {document.write("Passwords don't match, please re-enter password")
    }
    else 
    {document.signup.submit()}


</script>

<input type="button" value="Submit" onClick="readpassword()" /> 
<form action="newuser.php" method="post">
Email: <input type="text" name="email" /> <br />
Password: <input type="password" name="password1" /> <br />
Confirm Password: <input type="password" name="password2" /> <br />
<input type="submit" /> 
</form>

</body>
</html>
