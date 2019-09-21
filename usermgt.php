<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Class Registration Portal</title>
  <script type = "text/javascript" src = "jquery.js"></script>
 <link rel="stylesheet" href="style.css">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
<ul class = "navbar">
<li class = "hide"><a href = "venuemgt.php">Venue</a></li>
<li class = "hide"><a href = "classmgt.php">Class</a></li>
<li class = "hide"><a href = "usermgt.php">User </a></li>
<li class = "hide"><a href = "register.php">Registration</a></li>
<li><a href = "default.php">SignOut</a></li>
</ul>
<div class="form-style-8">
  <h2>NEW USER INFORMATION</h2>
  <form id = "form1" method = "post" action = "">
    <input type="text" name="uid" placeholder="UserId" />
 <input type="text" name="mname" placeholder="Full Name" />
  <input type="text" name="emp" placeholder="Employer" />
 <input type="text" name="unit" placeholder="Department" />
 <input type="text" name="date" placeholder="Registration Date" />
 <input type="text" name="uname" placeholder="LoginId" />
<input type="text" name="pass" placeholder="Password" />
 <input type="submit" value="Add User" id = "send" />
  </form>
</div>
<script>
$(document).ready(function(){
   //
  $('#send').click(function(){
  //alert('I love Halima');
  $.post('datamgt.php',$('#form1').serialize(),function(result){
   alert(result);   
  });
  return false;
  })
  });
</script>
</body>
</html>