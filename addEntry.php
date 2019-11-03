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
	if(strcmp($rdbtn,"1")==0)//2
{
try{
//$con->autocommit(false);
$con->begin_transaction();
$sql1 = "INSERT INTO qahistory(course, description, answer) VALUES (?,?,?)"; 
$sql2 = "insert into tabledata(rownum,colnum,owner,content) values(?,?,?,?)";
$stmt1 = $con->prepare($sql1);
$stmt1->bind_param("sss",$course,$qdesc,$qans);
$stmt1->execute();
if(isset($_POST['numofrow']))
{
$nrow = (int)$_POST['numofrow'];
$ncol = (int)$_POST['numofcol'];
$content = $_POST['content'];
$lastid=$stmt1->insert_id;
$stmt1 = $con->prepare($sql2);
$stmt1->bind_param("iiis",$nrow,$ncol,$lastid,$content);
$stmt1->execute();
}
$con->commit();
$response["success"] = 1;			
$response["message"] = "Entry Successfully Added ".$stmt1->error;
}
catch(Exception $e)
{
$response["success"] = 1;			
$response["message"] = $e->getMessage();
}
}//2
if(strcmp($rdbtn,"2")==0 && isset($_POST['quid']))//3
{
try{
$con->begin_transaction();
$sql1 = "update qahistory set answer = ? where qid = ?"; 
$sql2 = "update tabledata set colnum = ?,rownum = ?,content = ? where owner = ?";
$stmt1 = $con->prepare($sql1);
$stmt1->bind_param("ss",$qans,$_POST['quid']);
$stmt1->execute();
if(isset($_POST['numofrow']))
{
$nrow = (int)$_POST['numofrow'];
$ncol = (int)$_POST['numofcol'];
$content = $_POST['content'];
$stmt1 = $con->prepare($sql2);
$stmt1->bind_param("iisi",$ncol,$nrow,$content,$_POST['quid']);
$stmt1->execute();
}
$con->commit();
$response["success"] = 1;			
$response["message"] = "Entry Successfully Modified ".$stmt1->error;
}
catch(Exception $e)
{
$response["success"] = 1;			
$response["message"] = $e->getMessage();
}
}//3
}

/*if(isset($_POST['quid'])&&isset($_POST['qans'])&&isset($_POST['rdbtn_check'])){
	$quid = $_POST['quid'];
	$qans = $_POST['qans'];
	//$course = $_POST['course'];
	$rdbtn = $_POST['rdbtn_check'];
	
	//Query to insert a movie
	if(strcmp($rdbtn,"1")==0)
	$query = "INSERT INTO qahistory(course, description, answer) VALUES (?,?,?)";
 else $query = "UPDATE qahistory SET answer=? where qid = ?";
	//Prepare the query
	if($stmt = $con->prepare($query)){
		//Bind parameters
		if(strcmp($rdbtn,"1")==0)
		$stmt->bind_param("sss",$course,$qdesc,$qans);
	  else  $stmt->bind_param("ss",$qans,$quid);

		//Exceting MySQL statemenct
		$stmt->execute();
		//Check if data got inserted
		if($stmt->affected_rows > 0){
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
 
}*/

 if(isset($_POST['mcode'])&&isset($_POST['mdesc'])&&isset($_POST['rdbtn_check']))
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
if(isset($_POST['names'])&&isset($_POST['email'])&&isset($_POST['pass']))
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

//Displaying JSON response
echo json_encode($response);
?>