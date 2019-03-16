<?php
@ $db = new mysqli('localhost','root','','assignment');
if (mysqli_connect_error())
{//handle error
	echo '<p>Error connecting to the database. Eror message:</p>';
	echo '<p>'.mysqli_connect-error().'</p>';
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>User Registration Results</title>
</head>

<body>

<?php
	//create short variable names from the data received from the form
	$firstname = $_POST['first_name'];
	$surname = $_POST['surname'];
	$gender = $_POST['gender'];
	$DOB = $_POST['DOB'];
	$mobilePhone = $_POST['mobile'];
	$password = $_POST['password']; 
	$confirmPassword = $_POST['confirm_password'];
?>

<?php

$error_message ='';

if(empty($firstname) || empty($surname) || empty($gender) || empty($DOB) || empty($mobilePhone) || empty($password) || empty($confirmPassword)){

	$error_message = 'one of the rquried field is blank';
}

elseif (!is_numeric($mobilePhone))
{
$error_message = 'Your Mobile Number is Not Numeric';
}

elseIf (strlen($mobilePhone) == 9){
$error_message = 'Your Mobile Number must be aaa 10 digit';
}

elseIf (preg_match( "/^\d{4}\/\d{1,2}\/\d{1,2}$/",$DOB) == 9){
$error_message = 'DOB is not in valid format';
}

// checking the mobile number is exist in data base 

$mobile_query = "SELECT mobile_number FROM attendees WHERE mobile_number = '".$mobilePhone."'";
$mobile_result = $db->query($mobile_query);

if($mobile_result->num_rows > 0)
{
$error_message  = 'your mobile number already exist, plz check ur mobile number';
}

//////////////////////////////////////

elseIf (strlen($password) < 6){
$error_message = 'Password is too short';
}

elseIf ($password != $confirmPassword){
$error_message = 'Password does not match';
}

if ($error_message!= '')
{
echo 'Error'.$error_message.'<a href = "javascript:history.back();">Go Back</a>';
exit;

}
else
{
	$query = "INSERT INTO attendees VAlUES('".$firstname."','".$surname."','".$DOB."','".$mobilePhone."','".$gender."','".$password."','".$confirmPassword."')";

	$result = $db->query($query);

	if ($result)
	{
	echo '<p> user details inserted in database </p>';
	
	}
	else
	{
	echo '<p> Error inserting details.Error message:</p>';
	echo '<p>'.$db->error.'</p>';
	
	
	}



}

?>

<h2><strong>New User Details</strong></h2>
  <table style="width: 500px; border: 0px;" cellspacing="1" cellpadding="1">
    <tr>
      <td colspan="2"><strong>Personal Details</strong></td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>First Name</td>
      <td> 
        <?php echo $firstname; ?></td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Surname</td>
      <td> 
        <?php echo $surname; ?></td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Gender</td>
      <td> 
        <?php echo $gender; ?></td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>D.O.B. (dd/mm/yyyy)</td>
      <td> 
        <?php echo $DOB; ?></td>
    </tr>
   <tr style="background-color: #FFFFFF;"> 
      <td>Mobile</td>
      <td> 
        <?php echo $mobilePhone; ?></td>
    </tr>
    
    <tr style="background-color: #FFFFFF;"> 
      <td>Password</td>
      <td> 
        <?php echo $password; ?></td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Confirm Password</td>
      <td> 
        <?php echo $confirmPassword; ?></td>
    </tr>
  </table>

  <a href = "public_section.php">Home Page</a>
</body>
</html>