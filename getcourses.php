<?php
include 'db_connect.php';
$course_details = array();
$courses = array();
$response = array();
//Check for mandatory parameter fields
	//Query to fetch question details
	$query = "SELECT * from course";
	if($stmt = $con->prepare($query)){
		//Bind  parameters to the query
		$stmt->execute();
		//Bind fetched result to variables
		$stmt->bind_result($code,$description);
		//Check for results		
		while($stmt->fetch())
	{
	  $course_details['code']= $code;
	 $course_details['description']= $description;
     $courses[] = $course_details;
	}
		$stmt->close();
		$response['success'] = 1;
		$response['data'] = $courses;
 
	}else{
		//Whe some error occurs
		$response["success"] = 0;
		$response["message"] = mysqli_error($con);
		
	}
 


//Display JSON response
echo json_encode($response);
?>