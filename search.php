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
?>