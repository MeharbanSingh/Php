<?php
@ $db = new mysqli('localhost','root','','assignment');
if (mysqli_connect_error())
{//handle error
	echo '<p>Error connecting to the database. Eror message:</p>';
	echo '<p>'.mysqli_connect-error().'</p>';
	exit;
}
?>


<?php
//Start or resume a session
session_start();

//If the "uname" session variable is set and not empty, redirect to menu page
if ( isset($_SESSION['mobile']) && $_SESSION['mobile'] != '' )
{
	header('Location: attendee.php');
	exit;
}

//If form has been submitted, check login credentials
if ( isset($_POST['mobile']) )
{

	@ $db = new mysqli('localhost', 'root', '','assignment');
	if (mysqli_connect_errno())
	{
		echo 'Could not conenct the database - Please try again later';
		exit;
	}

	$att_query = "SELECT * FROM attendees WHERE mobile_number ='".$_POST['mobile']."'                                                                                                                AND password='".$_POST['password']."'";

	$att_results = $db->query($att_query);

	if ($att_results->num_rows == 0)
	{
		echo '<div style="color: red;">Invalid login. Please Try again.</div>';
	}
	else
	{
		//Log the user in
		$attendee = $att_results->fetch_assoc();

		//Set session variables then redirect to menu page
		$_SESSION['mobile'] = $attendee['mobile_number'];
		$_SESSION['first_name'] = $attendee['first_name'];
		$_SESSION['sur_name'] = $attendee['sur_name'];
		header('Location: attendee.php');
		exit;
	}
}
?>
<!DOCTYPE html>
<html>
 <head>
  <title>public section</title>
  <meta name="author" content="Meharban waraich" />
  <meta name="description" content="Demonstration of various basic form processing in PHP" />
 </head>

 <body>
  <form method="post" name="form_processing" action="public_section.php">

	<p><strong>Welcome to free-gigs, the free concert website</strong></p>
	<hr  />

	<b>You cannot book tickets<br  /> 
	unless you are logged in</b>

	<p>Mobile #:
		<input type="int" name="mobile" maxlength="20" />
	</p>

	<p>Password:
		<input type="password" name="password" maxlength="10" />
	</p>

	

	<input type="submit" name="login" value="login" />

<p><strong><a  href = "register.php" >click here to register</a></strong></p>




<b><a href = "admin.php" >Admin Login</a></b>



<?php

echo "<h1>Upcoming Concerts:</h1>";

$Concert_query = 'SELECT concerts.concert_date,concerts.concert_time,concerts.concert_id,bands.band_name, venues.venue_name FROM concerts,bands,venues WHERE concerts.band_id = bands.band_id AND concerts.venue_id = venues.venue_id AND DATE(concerts.concert_date) >= DATE(NOW()) order by concerts.concert_date';

$Concert_result = $db->query($Concert_query);




while($row = $Concert_result->fetch_assoc( ) )
{
  echo '<p dir = "rtl">'.'<ul style="list-style-type:circle">'.'<li>'.$row['concert_date'].',&nbsp;&nbsp;'.$row['concert_time'].','.'&nbsp;'.$row['band_name'].'&nbsp;'.'playing at'.'&nbsp;'.$row['venue_name'].'&nbsp;'.'<br  />'.'</li>'.'</ul>'.'</p>';


}

?>


  </form>
 </body>
</html>
