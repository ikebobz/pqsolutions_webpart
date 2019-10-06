<?php
include 'db_connect.php';
$response = array();
//Check for mandatory parameter mcode
if(isset($_POST['mcode'])){
	$mcode = $_POST['mcode'];
	$query = "DELETE FROM course WHERE code=?";
	if($stmt = $con->prepare($query)){
		//Bind mcode parameter to the query
		$stmt->bind_param("s",$mcode);
		$stmt->execute();
		//Check if the movie got deleted
		if($stmt->affected_rows == 1){
			$response["success"] = 1;			
			$response["message"] = "Course deleted successfully";
			
		}else{
			$response["success"] = 0;
			$response["message"] = "Course not found";
		}					
	}else{
		$response["success"] = 0;
		$response["message"] = mysqli_error($con);
	}
 
}else if(isset($_POST['qdesc']) && isset($_POST['course']))
{
    $qdesc = $_POST['qdesc'];
	$course = $_POST['course'];
	$query = "DELETE FROM qahistory WHERE description=? AND course =?";
	if($stmt = $con->prepare($query)){
		//Bind mcode parameter to the query
		$stmt->bind_param("ss",$qdesc,$course);
		$stmt->execute();
		//Check if the movie got deleted
		if($stmt->affected_rows == 1){
			$response["success"] = 1;			
			$response["message"] = "Entry deleted successfully";
			
		}else{
			$response["success"] = 0;
			$response["message"] = "Entry not found";
		}					
	}else{
		$response["success"] = 0;
		$response["message"] = mysqli_error($con);
	}
}
 else
{
	$response["success"] = 0;
	$response["message"] = "missing mandatory parameter";
}
echo json_encode($response);
?>