<?php
include 'db_connect.php';
$response = array();
 
//Check for mandatory parameters
if(isset($_POST['qdesc'])&&isset($_POST['qans'])&&isset($_POST['course'])&&isset($_POST['rdbtn_check'])){
	$qdesc = $_POST['qdesc'];
	$qans = $_POST['qans'];
	$course = $_POST['course'];
	$rdbtn = $_POST['rdbtn_check'];
	
	//Query to insert a movie
	if(strcmp($rdbtn,"1")==0)
	$query = "INSERT INTO qahistory(course, description, answer) VALUES (?,?,?)";
 else $query = "UPDATE qahistory SET answer=? where course =? AND description = ?";
	//Prepare the query
	if($stmt = $con->prepare($query)){
		//Bind parameters
		if(strcmp($rdbtn,"1")==0)
		$stmt->bind_param("sss",$course,$qdesc,$qans);
	  else  $stmt->bind_param("sss",$qans,$course,$qdesc);

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
 
}

else if(isset($_POST['mcode'])&&isset($_POST['mdesc'])&&isset($_POST['rdbtn_check']))
{
    $mcode = $_POST['mcode'];
	$mdesc = $_POST['mdesc'];
	$rdbtn = $_POST['rdbtn_check'];
	
	//Query to insert a movie
	if(strcmp($rdbtn,"1")==0)
	$query = "INSERT INTO course(code, description) VALUES (?,?)";
 else $query = "UPDATE course SET description=? where code =?";
	//Prepare the query
	if($stmt = $con->prepare($query)){
		//Bind parameters
		if(strcmp($rdbtn,"1")==0)
		$stmt->bind_param("ss",$mcode,$mdesc);
	  else  $stmt->bind_param("ss",$mdesc,$mcode);

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
}
else if(isset($_POST['names'])&&isset($_POST['email'])&&isset($_POST['pass']))
{
    $names = $_POST['names'];
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	
	//Query to insert a new user
	$query = "INSERT INTO users(names,email,passphrase) VALUES (?,?,?)";
	//Prepare the query
	if($stmt = $con->prepare($query)){
		//Bind parameters
		$stmt->bind_param("sss",$names,$email,$pass);

		//Exceting MySQL statemenct
		$stmt->execute();
		//Check if data got inserted
		if($stmt->affected_rows == 1){
			$response["success"] = 1;			
			$response["message"] = "New User Successfully Added";			
			
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
}
else{
	//Mandatory parameters are missing
	$response["success"] = 0;
	$response["message"] = "missing mandatory parameters";
}
//Displaying JSON response
echo json_encode($response);
?>