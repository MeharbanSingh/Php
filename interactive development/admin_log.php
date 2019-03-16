<!DOCTYPE html>
<html>
 <head>

  <script language="JavaScript" type="text/javascript">

 function ValidateForm()
	{

		if (document.band.newband.value == '')
		{
			alert('band field is blank.');
			return false;
		}
         

		return true;

	}

	function Validate()
	{

	if (document.venue.newvenue.value == '')
		{
			alert('venue field is blank.');
			return false;
		}

		return true;

	}

	function ValidateConcert()
	{

		 var e = document.getElementById("1");
                var strUser = e.options[e.selectedIndex].value;

                var strUser1 = e.options[e.selectedIndex].text;
                if(strUser==0)
                {
                    alert("Please select a band");
					return false;
                }

				var e = document.getElementById("2");
                var strUser = e.options[e.selectedIndex].value;

                var strUser1 = e.options[e.selectedIndex].text;
                if(strUser==0)
                {
                    alert("Please select a venue");
					return false;
                }

	if (document.concert.date.value == '')
		{
			alert('Date field is blank.');
			return false;
		}

		 re=/^\d{4}\/\d{1,2}\/\d{1,2}$/;

		if (!document.concert.date.value.match(re))
		{
			alert('Date not valid must be in YYYY/MM/DD Format!.');
			return false;
		}

		var EnteredDate = document.getElementById("txtdate").value; //for javascript

            var date = EnteredDate.substring(0, 2);
            var month = EnteredDate.substring(3, 5);
            var year = EnteredDate.substring(6, 10);

            var myDate = new Date(EnteredDate);

            var today = new Date();

            if (myDate > today) {

				//do nothing
                
            }

            else {
                alert("Entered date is less than today's date ");
				return false;
            }
            
            
        

		if (document.concert.time.value == '')
		{
			alert('time field is blank.');
			return false;
		}

		re=/^([0-1]?[0-9]|[2][0-3]):([0-5][0-9])(:[0-5][0-9])?$/;

		if (!document.concert.time.value.match(re))
		{
			alert('time field must be in HH:MM format!.');
			return false;
		}

          return true;
	}


  </script>

 </head>
 </html>

<h1>welcome admin</h1>
<h2>Admin area</h2>





<?php 



session_start();

if ( !isset($_SESSION['uname']) || $_SESSION['uname'] == '' )
{
	header('Location: admin.php');
	exit;
}

// connecting with database

@ $db = new mysqli('localhost','root','','assignment');
if (mysqli_connect_error())
{//handle error
	echo '<p>Error connecting to the database. Eror message:</p>';
	echo '<p>'.mysqli_connect-error().'</p>';
	exit;
}

?>

<?php




// creating links for admin functionality

echo '<a href = "admin_log.php?manage_id">Manage Bands</a>'.'<br />'.'<br />';
echo '<a href = "admin_log.php?venue_id">Manage Venues</a>'.'<br />'.'<br />';
echo '<a href = "admin_log.php?concert_id">Add Concert</a>'.'<br />'.'<br />';
echo '<a href = "admin_log.php?list">ALL Concerts</a>'.'<br />'.'<br />';

echo '<a href = "log_out.php">log Out</a> <br /> <br />';


// show bands name if admin click on manage band link

if (isset($_GET['manage_id']))
{

echo "<h1>Current Bands:</h1>";

$band_query = 'SELECT band_name,band_id FROM bands';
$band_result = $db->query($band_query);

while($row = $band_result->fetch_assoc( ))
	{

echo $row['band_name'].'&nbsp;'.'<a href = "admin_log.php?band_edit_id='.$row['band_id'].'&username='.$_SESSION['uname'].'">Edit</a>'.'&nbsp;'.'&nbsp;';
	
echo '<a href = "admin_log.php?band_del_id='.$row['band_id'].'&username='.$_SESSION['uname'].'" onclick = " return confirm(\'Are you sure?\');">Delete</a>'.'<br />';


}

// create input field if admin want to add new band.

echo '<form method="post" name = "band" action="admin_log.php " onsubmit="return ValidateForm();" >';

 echo "<h2>Add New Band:</h2>";
 echo '<input name = "newband" type = "text" maxlength = "15"/>';
 echo '<input type="submit" name="Add" value="Add" />';

 echo '</form>';

}

if(isset($_POST['newband']))
{
	$b_query_duplicate = "select * from bands;";
	$b_result_duplicate = $db->query($b_query_duplicate);
	
	$duplicate=false;
	while($row = $b_result_duplicate->fetch_assoc( ) )
	{
		if($row['band_name']==$_POST['newband']){
			echo "<script>alert('Sorry! This band already exist!')</script>";
			
			$duplicate=true;
		}
	}

if(!$duplicate)
	{
 
 $b_query = "insert into bands values (null,'".$_POST['newband']."')";
 $b_result = $db->query($b_query);

if($b_result)
		{

echo 'New band added';


}

 }

}

if(isset($_GET['band_del_id']))
{

$query = 'SELECT band_id FROM concerts';
$result = $db->query($query);

$allowed=true;
while($row = $result->fetch_assoc())

	{
	
	if($row['band_id']==$_GET['band_del_id']){
			echo "<script>alert('You Cannot delete this band! this band linked to the concert')</script>";
			
			$allowed=false;
		}
	
	
	}


if($allowed){

$del_query = 'DELETE FROM bands WHERE band_id='.$_GET['band_del_id'];
$del_result = $db->query($del_query);



if($del_result)
{

echo ' Band deleted';

}

}

}


////////////////////////////////////////////////////

if (isset($_GET['venue_id']))
{

echo "<h1>Current Venues:</h1>";

$venue_query = 'SELECT venue_name, venue_id FROM venues';
$venue_result = $db->query($venue_query);

while($vrow = $venue_result->fetch_assoc( ))
	{

echo $vrow['venue_name'].'&nbsp;'.'<a href = "admin_log.php?venue_edit_id='.$vrow['venue_id'].'&username = '.$_SESSION['uname'].'">Edit</a>'.'&nbsp;'.'&nbsp;'.'<a href = "admin_log.php?venue_del_id='.$vrow['venue_id'].'&username = '.$_SESSION['uname'].'" onclick = " return confirm(\'Are you sure?\');">Delete</a>'.'<br />';


}

echo '<form method="post" name = "venue" action="admin_log.php" onsubmit="return Validate();" >';

 echo "<h2>Add New Venue:</h2>";
 echo '<input name = "newvenue" type = "text" maxlength = "15"/>';
 echo '<input type="submit" name="Add" value="Add" />';

 echo '</form>';


}

 if(isset($_POST['newvenue']))
{
	$b_query_duplicate = "select * from venues;";
	$b_result_duplicate = $db->query($b_query_duplicate);
	
	$duplicate=false;
	while($row = $b_result_duplicate->fetch_assoc( ) )
	{
		if($row['venue_name']==$_POST['newvenue']){
			echo "<script>alert('Sorry! This venue already exist!')</script>";
			
			$duplicate=true;
		}
	}


 if(!$duplicate)
	{
 
 $b_query = "insert into venues values (null,'".$_POST['newvenue']."')";
 $b_result = $db->query($b_query);

if($b_result)
		{

echo 'New venue added';


}

}

}

if(isset($_GET['venue_del_id']))
{

$query = 'SELECT venue_id FROM concerts';
$result = $db->query($query);

$allowed=true;
while($row = $result->fetch_assoc())

	{
	
	if($row['venue_id']==$_GET['venue_del_id']){
			echo "<script>alert('You Cannot delete this venue! This venue linked to concert')</script>";
			
			$allowed=false;
		}
	
	
	}

	if($allowed){

$del_query = 'DELETE FROM venues WHERE venue_id='.$_GET['venue_del_id'];
$del_result = $db->query($del_query);

if($del_result)
{

echo ' venue deleted';

}

}


}


//////////////
if (isset($_GET['concert_id']))
{
echo '<form method="post" name = "concert" action="admin_log.php" onsubmit="return ValidateConcert();">';

echo "<h1>Add Concert:</h1>";

echo "<strong>Band:</strong>";
echo '<select name = "band" id="1" >' ;

$query = 'SELECT * FROM bands ORDER BY band_id';
$result = $db->query($query);
echo '<option value = "0" >select</option>';

for ($i = 0; $i < $result->num_rows; $i++)
	{

$row = $result->fetch_assoc();

echo '<option value="'.$row['band_id'].'">';
echo $row['band_name'].'</option>';

}
	echo '</select>';

	echo '<br  /> <br />';

	echo '<strong>Venue:</strong>';

	echo '<select name = "venue" id="2" >' ;

$query = 'SELECT * FROM venues ORDER BY venue_id';
$result = $db->query($query);

echo '<option value = "0" >select</option>';

for ($i = 0; $i < $result->num_rows; $i++)
	{

$row = $result->fetch_assoc();

echo '<option value="'.$row['venue_id'].'">';
echo $row['venue_name'].'</option>';

}
	echo '</select>';

	echo '<br  />';
	echo '<br  /> <br />';

	echo '<strong>Date</strong>';
	echo '<input type = "date" name = "date" id = "txtdate" placeholder = "YYYY/MM/DD"/> ';

	echo '<br  /> <br  />';

	echo '<strong>Time</strong>';
	echo '<input type = "int" name = "time" placeholder = "HH:MM" />';

	echo '<br  />';

	echo '<input type="submit" name="AddConcert" value="AddConcert" />';



 echo '</form>';


}

if(isset($_POST['AddConcert']))
{

$query = 'INSERT INTO concerts VALUES(null,"'.$_POST['band'].'","'.$_POST['venue'].'","'.$_POST['date'].'","'.$_POST['time'].'")';
$result = $db->query($query);

if($result){

	echo 'concert added';

}


}






if (isset($_GET['list'])){

$Concert_query = "SELECT concerts.concert_date,concerts.concert_time,concerts.concert_id,bands.band_name, venues.venue_name FROM concerts,bands,venues WHERE concerts.band_id = bands.band_id AND concerts.venue_id = venues.venue_id order by concerts.concert_date";

$Concert_result = $db->query($Concert_query);

while($row = $Concert_result->fetch_assoc( ) )
{
  echo '<ul style="list-style-type:circle">'.'<li>'.$row['concert_date'].',&nbsp;&nbsp;'.$row['concert_time'].','.'&nbsp;'.$row['band_name'].'&nbsp;'.'playing at'.'&nbsp;'.$row['venue_name'].'&nbsp;'.'<br  />'.'</li>'.'</ul>';


}

}


// if admin want to edit band name and check updated band should not exsit in database if do so then show error message else update with new name



if(isset($_GET['band_edit_id']))

{

$query = 'SELECT * FROM bands WHERE band_id="'.$_GET['band_edit_id'].'"';
$result = $db->query($query);
while($row = $result->fetch_assoc()){


echo '<form method="post" name = "bandEdit" action = "admin_log.php?edit_id='.$_GET['band_edit_id'].'&name='.$row['band_name'].'">';

echo '<input name="b" type= "text" value="'.$row['band_name'].'"/>';

echo '<input type="submit" name="done" value="done"/>';
echo '</form>';

}
}

if(isset($_GET['edit_id'])){
$query = 'SELECT * FROM bands';
$result = $db->query($query);

$duplicate=false;

while($row = $result->fetch_assoc())
	
	{

	if($_POST['b']==$row['band_name']){

echo "<script>alert('plz enter different name! This band name already exist')</script>";
			
			$duplicate=true; 

	}
	}

}

if(isset($_GET['edit_id']) AND (!$duplicate)){


$Uquery = 'UPDATE bands SET band_name="'.$_POST['b'].'" WHERE band_id="'.$_GET['edit_id'].'"';
	$Uresult = $db->query($Uquery);

	if($Uresult){
echo 'Band name updated';

	}

}

//???????????????????????????????????????????????????????????????????????????????????????????????????????????????

if(isset($_GET['venue_edit_id']))

{

$vquery = 'SELECT * FROM venues WHERE venue_id="'.$_GET['venue_edit_id'].'"';
$vresult = $db->query($vquery);
while($vrow = $vresult->fetch_assoc()){


echo '<form method="post" name = "venueEdit" action = "admin_log.php?venue_id='.$_GET['venue_edit_id'].'&name='.$vrow['venue_name'].'">';

echo '<input name="d" type= "text" value="'.$vrow['venue_name'].'"/>';

echo '<input type="submit" name="update" value="update"/>';
echo '</form>';

}
}

if(isset($_GET['venue_id'])){
$vquery = 'SELECT * FROM venues';
$vresult = $db->query($vquery);

$Vduplicate=false;

while($vrow = $vresult->fetch_assoc())
	
	{

	if($_POST['d']==$vrow['venue_name']){

echo "<script>alert('plz enter different name! This venue name already exist')</script>";
			
			$Vduplicate=true; 

	}
	}

}

if(isset($_GET['venue_id']) AND (!$Vduplicate)){


$Vquery = 'UPDATE venues SET venue_name="'.$_POST['d'].'" WHERE venue_id="'.$_GET['venue_id'].'"';
	$Vresult = $db->query($Vquery);

	if($Vresult){
echo 'venue name updated';

header('location:admin_log.php');
exit;

	}

}

?>