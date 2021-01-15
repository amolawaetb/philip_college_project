<?php
   include("dbconnection.php");
   $conn = OpenCon();
   
   if(!$conn) 
   {
		die("Connection failed: " . $conn->connect_error);
   }
	
   ##CloseCon($conn);

   session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") 
   {      
      $myusername = mysqli_real_escape_string($conn,$_POST['username']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 
	  
      $sql = "SELECT user_id FROM user_login WHERE user_name = '$myusername' and user_password = '$mypassword'";
	  
      $result = mysqli_query($conn,$sql);

      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      $count = mysqli_num_rows($result);
		
      if($count == 1) 
	  {
         #session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         
         header("location: home.php");
      }
	  else 
	  {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<html>
<body>
<head><link rel="stylesheet" type="text/css" href="style.css"></head>
<form class="centered" action="" method="post">
<table>
<tr><td>Login:</td><td><input type="text" name="username"></td></tr>
<tr><td>Password:</td><td><input type="password" name="password"></td></tr>
<tr><td colspan="2" align="center"><input type="submit"></td></tr>
</table>
</form>
</body>
</html>