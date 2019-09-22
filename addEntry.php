<?php
include 'db_connect.php';
$response = array();
 
//Check for mandatory parameters
if(isset($_POST['qdesc'])&&isset($_POST['qans'])&&isset($_POST['course'])){
	$qdesc = $_POST['qdesc'];
	$qans = $_POST['qans'];
	$course = $_POST['course'];
	
	//Query to insert a movie
	$query = "INSERT INTO qahistory(course, description, answer) VALUES (?,?,?)";
	//Prepare the query
	if($stmt = $con->prepare($query)){
		//Bind parameters
		$stmt->bind_param("sss",$course,$qdesc,$qans);
		//Exceting MySQL statemenct
		$stmt->execute();
		//Check if data got inserted
		if($stmt->affected_rows == 1){
			$response["success"] = 1;			
			$response["message"] = "Entry Successfully Added";			
			
		}else{
			//Some error while inserting
			$response["success"] = 0;
			$response["message"] = "Error while adding entry";
		}					
	}else{
		//Some error while inserting
		$response["success"] = 0;
		$response["message"] = mysqli_error($con);
	}
 
}else{
	//Mandatory parameters are missing
	$response["success"] = 0;
	$response["message"] = "missing mandatory parameters";
}
//Displaying JSON response
echo json_encode($response);
?>