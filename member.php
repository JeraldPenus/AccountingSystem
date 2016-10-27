<?php
ob_start();
include_once 'lib.dbconnect.php';
//mysql_select_db(ecindiao_daybook);
//checks cookies to make sure they are logged in
if(isset($_COOKIE['username']))
{
	$username = $_COOKIE['username'];
	$pass = $_COOKIE['userkey'];	
	$check = mysql_query("SELECT * FROM users WHERE username = '$username'")or die(mysql_error());
	while($info = mysql_fetch_array( $check ))
	{		
		$companyname = $info['cname'];
		//if the cookie has the wrong password, they are taken to the login page
		if ($pass != $info['password'])
		{
			header("Location: login.php");
			
		} else {
			//echo "Admin Area<p>";
			//echo "Your Content<p>";
			$user_login_status = "User : $username. <a href=logout.php>Logout</a>";
		}		
	}
} else { 
	//if the cookie does not exist, they are taken to the login screen
	header("Location: login.php");
}
ob_end_flush();
?>