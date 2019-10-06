<?php
include 'db_connect.php';
$answers = array();
$result = array();
$response = array();
//Check for mandatory parameter fields
if(isset($_GET['qdesc']) && isset($_POST['course'])){
	$qdesc = $_GET['qdesc'];
	$course = $_GET['course'];
	//Query to fetch question details
	$query = "SELECT answer from qahistory where course=? AND description like ?";
	if($stmt = $con->prepare($query)){
		//Bind  parameters to the query
		$stmt->bind_param("ss",$course,$qdesc);
		$stmt->execute();
		//Bind fetched result to variables
		$stmt->bind_result($answer);
		//Check for results		
		while($stmt->fetch())
	{
	  $solution['description']= $answer;
	  $result[] = $solution;
	}
		$stmt->close();
		$response['success'] = 1;
		$response['data'] = $result;
 
	}else{
		//Whe some error occurs
		$response["success"] = 0;
		$response["message"] = mysqli_error($con);
		
	}
 
}else{
	//When the mandatory parameters are missing
	$response["success"] = 0;
	$response["message"] = "missing parameter movie_id";
}
//Display JSON response
echo json_encode($response);
?>