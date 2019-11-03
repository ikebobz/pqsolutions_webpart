<?php
include('db_connect.php');
if(isset($_POST['qdesc'])&&isset($_POST['course']))
  {
	$query = "select answer from qahistory where description = ? and course = ?";
	if($stmt = $con->prepare($query))
  {
 $stmt->bind_param("ss",$_POST['qdesc'],$_POST['course']);
 $stmt->execute();
 $stmt->bind_result($answer);
 $stmt->fetch();
 echo $answer;
 $stmt->close();
  }//end of if statement
}
if(isset($_POST['qfrag']) && isset($_POST['course']))
{
    //echo "hello guys";
	$qfrag = $_POST['qfrag'];
	$course = $_POST['course'];
	$collection = array();
	$response = array();
	
	//Query to insert a new user
	$query = "select qid,answer,description,rownum,colnum,content from qahistory left outer join tabledata on qahistory.qid=tabledata.owner where description like ? and course = ?";
	//Prepare the query
	if($stmt = $con->prepare($query)){
		//Bind parameters
		//echo $stmt->error;
		$stmt->bind_param("ss",$qfrag,$course);

		//Exceting MySQL statemenct
		$stmt->execute();
		//echo $stmt->error;
		$stmt->bind_result($qid,$answer,$description,$rownum,$colnum,$content);
		//echo $stmt->error;
		while($stmt->fetch())
	{
	$rset['qid'] = $qid;
	$rset['answer'] = $answer;
	$rset['description'] = $description;
	$rset['rownum'] = $rownum;
	$rset['colnum'] = $colnum;
	$rset['content'] = $content;
	$collection[] = $rset;
	}// end of while statement
	//echo $stmt->error;
	$stmt->close();
    $response['success'] = 1;
	$response['data'] = $collection;
	}
	else
	{
		//Some error while inserting
		$response["success"] = 0;
		$response["message"] = mysqli_error($con);
	}
	echo json_encode($response);
	
}
?>