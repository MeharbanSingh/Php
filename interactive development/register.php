<?php

//This code simply checks if the form has been submitted by checking if 'submit' exists in the $_POST array  - i.e. if the variable which holds POST method form content has a value for what we named our submit button
if (isset($_POST['submit']))
{
	//If the form has been submitted, the content of the $_POST array is displayed

	echo '<p><strong>Form submitted successfully!</strong></p>';

	
}

//If the form has not been submitted, nothing happens...

?>

<!DOCTYPE html>
<html>
 <head>
  <title>Registration and validation</title>
  <meta name="author" content="Meharban waraich" />
  <meta name="description" content="Demonstration of various basic form processing in PHP" />

   <script language="JavaScript" type="text/javascript">

	//This function is used to validate the form
	//If any field is invalid, it will be mentioned in an error message and the function returns false
	//If all fields are valid, the function will return true, allowing the form to submit
	function ValidateForm()
	{

		//Tests if the FirstName is empty
		if (document.register.first_name.value == '')
		{
			alert('First Name is blank.');
			return false;
		}
         //Tests if the Surname is empty
		if (document.register.surname.value == '')
		{
			alert('Surname is blank.');
			return false;
		}

		//Tests if the Gender is empty
		if (document.register.gender.value == '')
		{
			alert('Gender is blank.');
			return false;
		}

		//Tests if the Gender is empty
		if (document.register.gender.value != 'Male' && document.register.gender.value != 'Female' )
		{
			alert('Gender must be Male or Female.');
			return false;
		}

		//Tests if the Date Of Birth is empty
		if (document.register.DOB.value == '')
		{
			alert('DateOfBirth is blank.');
			return false;
		}

		//Tests if the Date Of Birth is YYYY/MM/DD Format
        re =   /^\d{4}\/\d{1,2}\/\d{1,2}$/;
		if (!document.register.DOB.value.match(re))
		{
			alert('DateOfBirth is not in Valid Format.');
			return false;
		}
        
		//Tests if the Mobile Number is empty
		if (document.register.mobile.value == '')
		{
			alert('Mobile number is blank.');
			return false;
		}

		//Tests if the Mobile Number "is Not a Number" (isNaN)
		if (isNaN(document.register.mobile.value))
		{
			alert('Mobile must be a number.');
			return false;
		}

		//Tests if the Mobile Number is 10 Digit
		if (document.register.mobile.value.length != 10)
		{
			alert('Mobile Number must be 10 digit.');
			return false;
		}


		//Tests if the password is blank
		if (document.register.password.value == '')
		{
			alert('password is blank.');
			return false;
		}

		//Tests if the  confirm password is blank
		if (document.register.confirm_password.value == '')
		{
			alert('Confirm_password is blank.');
			return false;
		}

		//Tests if the password is less than 6 characters
		if (document.register.password.value.length < 6)
		{
			alert('Password is too short.');
			return false;
		}


		//Tests if the password and password confirmation do not match
		if (document.register.password.value != document.register.confirm_password.value)
		{
			alert('Passwords do not match.');
			return false;
		}

          return true;

	}

  </script>

 </head>

 <body>
  <form method="post" name="register" action="display.php " onsubmit="return ValidateForm();">

	<p><strong>Welcome to Registeration form</strong></p>
	<hr  />

	

	<p>First Name:
		<input type="text" name="first_name" maxlength="20" />
	</p>

	<p>Surname:
		<input type="text" name="surname" maxlength="10" />
	</p>

	<p>Gender:
		<input type="text" name="gender" maxlength="10" />
	</p>

	<p>Date Of Birth:
		<input type="Date" name="DOB" maxlength="10" placeholder = "YYYY/MM/DD"/>
	</p>

	<p>Mobile #:
		<input type="int" name="mobile" maxlength="10" />
	</p>

	<p>Password:
		<input type="password" name="password" maxlength="10" />
	</p>

	<p>Confirm Password:
		<input type="password" name="confirm_password" maxlength="10" />
	</p>

	

	<input type="submit" name="submit" value="submit" />  <button type = "button" onclick = "javascript:history.back();">BACK</button>


 
  </form>
 </body>
</html>
