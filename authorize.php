<?php
include 'db_connect.php';
$login_details = array();
$credentials = array();
$response = array();
//Check for mandatory parameter fields
	//Query to fetch question details
if(isset($_GET['email']))
{
	$query = "SELECT email,passphrase from users where email =?";
	if($stmt = $con->prepare($query)){
		//Bind  parameters to the query
		$stmt->bind_param("s",$_GET['email']);
		$stmt->execute();
		
		//Bind fetched result to variables
		$stmt->bind_result($email,$pass);
	
		//Check for results		
		while($stmt->fetch())
	{
	  $login_details['email']= $email;
	 $login_details['pass']= $pass;
     $credentials[] = $login_details;
	}
		$stmt->close();
		$response['success'] = 1;
		$response['data'] = $credentials;
	
	
 
	}else{
		//Whe some error occurs
		$response["success"] = 0;
		$response["message"] = mysqli_error($con);
		
	}
	
}
else 
	{
	$response["success"] = 0;
	$response["message"] = "missing parameters";
	}


//Display JSON response
echo json_encode($response);
?>