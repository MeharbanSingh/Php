<?php
//Start or resume a session
session_start();

//If the "uname" session variable is set and not empty, redirect to menu page
if ( isset($_SESSION['uname']) && $_SESSION['uname'] != '' )
{
	header('Location: admin_log.php');
	exit;
}

//If form has been submitted, check login credentials
if ( isset($_POST['username']) )
{

	@ $db = new mysqli('localhost', 'root', '','assignment');
	if (mysqli_connect_errno())
	{
		echo 'Could not conenct the database - Please try again later';
		exit;
	}

	$query = "SELECT * FROM admin WHERE user_name='".$_POST['username']."'                                                                                                                AND password='".$_POST['password']."'";

	$results = $db->query($query);

	if ($results->num_rows == 0)
	{
		echo '<div style="color: red;">Invalid login.  Try again.</div>';
	}
	else
	{
		//Log the user in
		$user = $results->fetch_assoc();

		//Set session variables then redirect to menu page
		$_SESSION['uname'] = $user['user_name'];
		header('Location: admin_log.php');
		exit;
	}
}
?>




<!DOCTYPE html>
<html>
 <head>
  <title>admin section</title>
  <meta name="author" content="Meharban waraich" />
  <meta name="description" content="Demonstration of various basic form processing in PHP" />
 </head>

 <body>
  <form method="post" name="admin_form" action="admin.php">


  <h1>Welcome to Admin Login</h1>

	<p>UserName:
		<input type="text" name="username" required maxlength="20" oninvalid="alert('You must fill out the user name');" />
	</p>

	<p>Password:
		<input type="password" name="password" required maxlength="10" oninvalid="alert('You must fill out the password');"/>
	</p>

	

	<input type="submit" name="login" value="login" />  <button type = "button" onclick = "javascript:history.back();" >BACK</button>


  </form>
 </body>
</html>
