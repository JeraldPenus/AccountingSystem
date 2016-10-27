<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="css/bootstrap-3.3.6-dist/css/bootstrap.css">
<link rel="stylesheet" href="css/bootstrap-3.3.6-dist/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="css/jquery.min.js"></script>
<script src="css/jquery-ui-1.11.4/jquery-ui.min.js"></script>
<link rel="stylesheet" href="css/jquery-ui-1.11.4/jquery-ui.min.css">

<!-- Latest compiled Bootstrap JavaScript -->
<script src="css/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>

<!-- End of Main Container -->
<script>
function validateEntries() 
{
	var emailid = document.getElementById('emailid').value;
	if (emailid == ""){
		alert("Please enter the Email id.");
		return false;	
	}
}
</script>

<body>
<?php

    include_once 'lib.dbconnect.php';
	if (isset($_POST['submit']))
	{
		$message = "";
		mysql_select_db($main_database);
		if (isset($_POST['emailid'])){
			
			if (!filter_var($_POST['emailid'], FILTER_VALIDATE_EMAIL)) {
                $message = $message.' Invalid Email format.';
            }
			if (!get_magic_quotes_gpc()) {
				$emailid = addslashes($_POST['emailid']);				
			}
		}
	}
	
	$check = mysql_query("SELECT username, password, emailid FROM users WHERE emailid = '".$emailid."'") or die(mysql_error());
	$check2 = mysql_num_rows($check);
	
	
	//if the email id does not exists.
	if ($check2 == 0) {
		$message = $message.' Email Id '.$_POST['emailid'].' is not registered. Check the Email Address.';
		$to = $row['emailid'];
		$from = $row[''];		
	} else {
		while ($row = mysql_fetch_assoc($check)) {
            $emailid = $row['emailid'];
            $username = $row['username'];
            $password = $row['password'];
			$emsg.= "\r\n\r\n";
			$emsg.="YOU HAVE REQUESTED FOR YOUR PASSWORD TO BE SENT \r\n ";
			$emsg.="Your username : ".$username." \r\n ";
			$emsg.="Your password : ".$password." \r\n ";			
			$emsg.= "\r\n\r\n";
			if (mail($emailid, "Daybookaccounts.com Password Recovery", $emsg)){
				$message = 'Username and Password sent to the registered email.';
			} else {
				$message = 'Problem sending email. Try recovering password after sometime.';
			}
		}
	}

	mysql_free_result($check);
?>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
    </button>
    
    </div>    
    <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
	   <li><a href="registration.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Register</a></li>
	   <li class="active"><a href="login.php"><span class="glyphicon glyphicon-log-in"></span>&nbsp;Log in</a></li>
	   <li><a href="../docs"><span class="glyphicon glyphicon-book"></span>&nbsp;User Guide</a></li>	
    </ul>
    </div>
  </div>
</nav>

<div class="container">
  <div class="row">
     <div class="col-sm-6">
	 	<?php 
		if ($message == ""){
			echo "<div class=\"alert alert-info\">Password sent to email address</div>";
		}
		if (isset($_POST['submit']) && $message != ""){
			echo "<div class=\"alert alert-warning\">".$message."</div>";
		}
	    ?>
	    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
		<div class="panel panel-default">
			<div class="panel-heading">Forgot your password</div>
			<div class="panel-body">
			<div class="form-group">
				<label for="username">Enter your Email Id</label>
				<input type="text" class="form-control input-sm" name="emailid" id="emailid" maxlength="50" value="<?php echo $_POST['emailid'] ?>" />
			</div>
			<button class="btn btn-default" type="submit" name="submit" onclick="javascript:return validateEntries()">Send</button>
			</div>			
		</div>
		</form>
     </div>
  </div>
  
  <!-- Footer -->
	<div class="row">
	<div class="page-header">
		<?php include_once 'footer.php' ?>
	</div>
	</div>
<!-- End of Footer -->

</div>	

</body>
</html>
<?php ob_end_flush() ?>