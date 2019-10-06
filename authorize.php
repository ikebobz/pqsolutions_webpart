<?php
include 'db_connect.php';
$login_details = array();
$credentials = array();
$response = array();
//Check for mandatory parameter fields
	//Query to fetch question details
if(isset($_POST['email']) && isset($_POST['pass']))
{
	$query = "SELECT email,passphrase from users where email = ? and passphrase = ?";
	if($stmt = $con->prepare($query)){
		//Bind  parameters to the query
		$stmt->bind_param("ss",$_POST['email'],$_POST['pass']);
		$stmt->execute();
		if($stmt->rowCount()>0){
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
	}
		else
	{
	    $stmt->close();
		$response['success'] = 0;
		$response['message'] = "user not found";
	}
 
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