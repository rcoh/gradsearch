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
<div id="pass_match"></div>
<script type="text/javascript">
//first, we check if the email is already in our records:
    function readEmail (form){
	email = form.email.value;
	//access the db and check if email is already taken
	document.write("email already in our records")
    }


// wanna check if password matches confirm password or is empty
function readpassword(form) {
     if (form.password1.value.length ==0 || form.password2.value.length ==0 )
     {document.getElementById("pass_match").innerHTML = '<p> <color=red> Password is blank, please enter a password </p>'}
     else if (form.password1.value != form.password2.value)
     {document.getElementById("pass_match").innerHTML = '<p> <color=red> Passwords do not match, please re-enter password </p>'}
     else 
     {document.signup.submit()}
}


</script>

<input type="button" value="Submit" onClick="readpassword(this.form)" /> 
</form>

</body>
</html>



