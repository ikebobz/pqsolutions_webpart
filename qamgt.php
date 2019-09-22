<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>QA Management Portal</title>
  <script type = "text/javascript" src = "jquery.js"></script>
 <link rel="stylesheet" href="style.css">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
<ul class = "navbar">
<li class = "hide"><a href = "qamgt.php">QAManagement</a></li>
<li class = "hide"><a href = "coursemgt.php">Course Management</a></li>
<li><a href = "default.php">SignOut</a></li>
</ul>
<div class="form-style-8">
  <h2>Q&A MANAGEMENT</h2>
  <form id = "form1" method = "post" action = "">
  <div id = "operations">
  <input type = "radio" name = "optype" id = "radio1"><span>Add New Entry</span>
  <input type = "radio" name = "optype" id = "radio2"><span>Modify Existing Entry</span>
  </div>
  <select name = "course" id = "course">
  <option>Select Course</option>
  <?php
  include_once("db_connect.php");
  //$code="";
  $query = "select code,description from course";
  if($stmt = $con->prepare($query))
  {
 $stmt->execute();
 $stmt->bind_result($code,$description);
  while($stmt->fetch())
  {
  echo "<option value =".$code.">".$code."-".$description."</option>";
  }//end of while loop
 $stmt->close();
  }
  ?>
  </select>
    <textarea id = "qdesc" name = "qdesc" placeholder = "Enter Question "></textarea>
	<textarea id = "qans" name = "qans" placeholder = "Field Answer"></textarea>
 <input type="submit" value="Add Entry" id = "send" />
 
  </form>
</div>
<script>
$(document).ready(function(){
   //
  $('#send').click(function(){
  //alert('I love Halima');
  $.post('addEntry.php',$('#form1').serialize(),function(result){
   var jsonobj = JSON.parse(result);
   alert(jsonobj.message);   
    });
  return false;
  })
  });
</script>
</body>
</html>