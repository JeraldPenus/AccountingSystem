<?php
function create_database($domain,$dbuser,$dbpass,$link) 
{
	if (mysql_connect($domain,'install','installuser','daybooka_daybook')){
		echo "Database setup already completed. <a href=\"login.php\">Click here to Navigate to login page</a>";
		exit;
	} 
	
	$result = mysql_query("CREATE DATABASE IF NOT EXISTS `daybooka_daybook` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci");
	if (!$result) {
		die('Invalid query: ' . mysql_error());		
	} else {
		/* echo "Successfully created database daybooka_daybook <br />"; */
	}
	/* mysql_free_result($result); */
	

	/* echo "Creating user 'install' "; */
	$sql = "CREATE USER 'install'@'localhost' IDENTIFIED BY 'installuser'";
	$result = mysql_query($sql);
	if (!$result) {
		//die('Cannot create mysql user: ' . mysql_error());
	} else {
		/* echo "Successfully created user 'install' user <br />"; */
	}
/* mysql_free_result($result); */
	
/*	mysql_close($link);
	$link = mysql_connect($domain,'install','installuser','daybooka_daybook');	
	
	if (!$link){
		die('Cannot create tables in database daybooka_daybook' . mysql_error());
	}
*/
	$sql = "CREATE TABLE IF NOT EXISTS daybooka_daybook.users (";
	$sql .="`ID` mediumint(9) NOT NULL AUTO_INCREMENT, ";
	$sql .="`username` varchar(60) DEFAULT NULL, ";
	$sql .="`password` varchar(60) DEFAULT NULL, ";
	$sql .="`cname` varchar(50) DEFAULT NULL, ";
	$sql .="`emailid` varchar(50) DEFAULT NULL, ";
	$sql .="`contactno` int(30) DEFAULT NULL, ";
	$sql .="`secque` varchar(150) NOT NULL, ";
	$sql .="`secans` varchar(150) NOT NULL, ";
	$sql .="PRIMARY KEY (`ID`) ";
	$sql .= ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 ";

	$result = mysql_query($sql);
	if (!$result) {
		die('Invalid query: ' . mysql_error());
	}
	/* echo "Successfully created 'users' database. <br />";	*/
	
	
	$sql = "GRANT ALL PRIVILEGES ON daybooka_daybook.* TO 'install'@'localhost'";
	$result = mysql_query($sql);
	if (!$result) {
		die('Cannot Grant all privileges to user install: ' . mysql_error());
	}
	echo "Successfully Granted all privileges on daybooka_daybook.* database for the user install <br />";

	/* Check the permissions again */
	
	mysql_close($link);
}
?>