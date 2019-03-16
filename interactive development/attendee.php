<?php


@ $db = new mysqli('localhost','root','','assignment');
if (mysqli_connect_error())
{//handle error
	echo '<p>Error connecting to the database. Eror message:</p>';
	echo '<p>'.mysqli_connect-error().'</p>';
	exit;
}

if(isset($_GET['concert_id']))
{
	$b_query_duplicate = "select * from bookings;";
	$b_result_duplicate = $db->query($b_query_duplicate);
	
	$duplicate=false;
	while($row = $b_result_duplicate->fetch_assoc( ) )
	{
		if($row['concert_id']==$_GET['concert_id'] && $row['mob_number']==$_GET['mobile']){
			echo "<script>alert('You Already Booked this concert!')</script>";
			
			$duplicate=true;
		}
	}


	if(!$duplicate){
		$b_query = "insert into bookings values (null,'".$_GET['mobile']."','".$_GET['concert_id']."')";
		$b_result = $db->query($b_query);

		if ($b_result)
		{
			echo '<p> user details inserted in database </p>';	
		}
		else
		{
			echo '<p> Error inserting details.Error message:</p>';
			echo '<p>'.$db->error.'</p>';
		}
	}



	

}






?>

<!DOCTYPE html>
<html>
<head>
<title>Attendes</title>
</head>

<body>

<h1>Welcome to Free-Gigs, the Free Concert Website!</h1>
<br  />

<a href = "log_out.php">log Out</a>

<?php
session_start();

if ( !isset($_SESSION['mobile']) || $_SESSION['mobile'] == '')
{
	header('Location: public_section.php');
	exit;
}


echo '<br />'.'<br />'.'You are logged in as'.'&nbsp;'.$_SESSION['first_name'].'&nbsp;'.$_SESSION['sur_name'];



echo "<h1>Upcoming Concerts:</h1>";

$Concert_query = "SELECT concerts.concert_date,concerts.concert_time,concerts.concert_id,bands.band_name, venues.venue_name FROM concerts,bands,venues WHERE concerts.band_id = bands.band_id AND concerts.venue_id = venues.venue_id AND DATE(concerts.concert_date) >= DATE(NOW()) order by concerts.concert_date";

$Concert_result = $db->query($Concert_query);

while($row = $Concert_result->fetch_assoc( ) )
{
  echo '<ul style="list-style-type:circle">'.'<li>'.$row['concert_date'].',&nbsp;&nbsp;'.$row['concert_time'].','.'&nbsp;'.$row['band_name'].'&nbsp;'.'playing at'.'&nbsp;'.$row['venue_name'].'&nbsp;'.'<a href="attendee.php?concert_id='.$row['concert_id'].'&mobile='.$_SESSION['mobile'].'">book</a>'.'<br  />'.'</li>'.'</ul>';


}

?>

<h1>Your Bookings:</h1>

<?php

	if(isset($_GET['concert_id']))
	{
		echo $_GET['concert_id'].'<br>';

		$booking_query="SELECT concerts.concert_date, concerts.concert_time,concerts.concert_id, bands.band_name, venues.venue_name,bookings.booking_id FROM bookings,concerts,bands,venues WHERE bookings.concert_id=concerts.concert_id AND concerts.band_id = bands.band_id AND concerts.venue_id = venues.venue_id AND bookings.mob_number = '".$_SESSION['mobile']."' ORDER BY concerts.concert_date;" ;

		

		$booking_result = $db->query($booking_query);

		while($row = $booking_result->fetch_assoc( ) )
		{
		  echo '<ul style="list-style-type:circle">'.'<li>'.$row['concert_date'].',&nbsp;&nbsp;'.$row['concert_time'].','.'&nbsp;'.$row['band_name'].'&nbsp;'.'playing at'.'&nbsp;'.$row['venue_name'].'&nbsp;'.'<a href="attendee.php?cancel_id='.$row['concert_id'].'&mobile='.$_SESSION['mobile'].'">cancel</a>'.'<br  />'.'</li>'.'</ul>';
		}
	}
	else

{

$query = 'SELECT * FROM bookings WHERE mob_number="'.$_SESSION['mobile'].'"';
$result = $db->query($query);

if($result->num_rows == 0){

echo 'YOU HAVE NO BOOKINGS!';

	

}




}

?>

<?php


if(isset($_GET['cancel_id']))
{
$cancel_query = "DELETE  FROM bookings WHERE bookings.concert_id='".$_GET['cancel_id']."' AND bookings.mob_number='".$_GET['mobile']."'";

$cancel_result = $db->query($cancel_query);

if($cancel_result)
	{


header('Location: attendee.php');
	exit;
}




}






?>




</body>
</html>