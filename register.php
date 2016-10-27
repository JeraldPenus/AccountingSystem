<?php 
ob_start();
include_once 'lib.dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
	
  <!-- Mobile support -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Bootstrap Material</title>

  <!-- Material Design fonts -->
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/material.css">
  <link rel="stylesheet" href="css/ripples.css">
  <link rel="stylesheet" href="css/custom.css">

<script>
<script>
function validateEntries() 
{
	var reg = /^[a-zA-Z]{1}[a-zA-Z0-9]{5,19}$/
	var str = document.getElementById("username").value;
	if (!(str.match(reg)))
	{
		alert("Not a valid username. Please enter alpha numeric minimum of 6 characters and maximum of 20 characters and should start with alphabet.");
		return false;	
	}
	
	var reg = /^\w{6,20}$/;
	var str = document.getElementById("pass").value;		
	if (!(str.match(reg)))
	{
		alert("Please enter a valid password! password must be at least 6 characters and maximum of 20 characters long.");
		return false;	
	}	
	
	var pass = document.getElementById('pass').value;
	var pass2 = document.getElementById('pass2').value;
	var cname = document.getElementById('cname').value;
	var emailid = document.getElementById('emailid').value;
	var contactno = document.getElementById('contactno').value;
	var secque = document.getElementById('secque').value;
	var secque = document.getElementById('secans').value;
	
	if (pass != pass2){
		alert("Please enter the confirm password correctly.");
		return false;	
	}
	
	if (cname == ""){
		alert("Please enter the Company Name / Individual Name.");
		return false;	
	}
		
	if (emailid == ""){
		alert("Please enter the Email id.");
		return false;	
	}
	
	if (contactno == ""){
		alert("Please enter the Contact Number.");
		return false;	
	}
	
	if (secque == ""){
		alert("Please enter the Secret Question.");
		return false;	
	}
	
	if (secans == ""){
		alert("Please enter the Secret Answer.");
		return false;	
	}
			
	return true;
}
</script>
</head>

<body background="img/material.jpg">
<style>
body { 
 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}

</style>

<?php
 include_once 'lib.dbconnect.php';
//This code runs if the form has been submitted
		if (isset($_POST['submit'])) 
		{
			$message = "";
			mysql_select_db($main_database);
			
			//This makes sure they did not leave any fields blank
			if ($_POST['username'] == "" || $_POST['pass'] == "" || $_POST['pass2'] == "") 
			{
				$message = $message.' You did not complete all of the required fields.';
			}

			// checks if the username is in use
			if (!get_magic_quotes_gpc()) {
				$_POST['username'] = addslashes($_POST['username']);
			}
			
			$usercheck = $_POST['username'];
			$check = mysql_query("SELECT username FROM users WHERE username = '".$usercheck."'") or die(mysql_error());
			$check2 = mysql_num_rows($check);

			//if the name exists it gives an error
			if ($check2 != 0) {
				$message = $message.' Sorry, the username '.$_POST['username'].' is already in use.';								
			}

			// this makes sure both passwords entered match
			if ($_POST['pass'] != $_POST['pass2']) {
				$message = $message.' Your passwords did not match.';						
			}
			
			if (!filter_var($_POST['emailid'], FILTER_VALIDATE_EMAIL)) {
                $message = $message.' Invalid Email format.';
            }
			
			if (!filter_var($_POST['contactno'], FILTER_VALIDATE_INT)) {
               /* $message = $message.' Contact Number is not valid'; */
            } else {
               $message = $message.' Contact Number is not valid, Use only digits.';
            }
			
			if (strlen($_POST['contactno']) > 15){
			   $message = $message.' Contact Number cannot exceed 15 digits';
			}
			
			// here we encrypt the password and add slashes if needed
			$password = $_POST['pass'];
			$_POST['pass'] = $_POST['pass'];
			if (!get_magic_quotes_gpc()) {
				$_POST['pass'] = addslashes($_POST['pass']);
				$_POST['username'] = addslashes($_POST['username']);
				$_POST['cname'] = addslashes($_POST['cname']);
				$_POST['emailid'] = addslashes($_POST['emailid']);
				$_POST['contactno'] = addslashes($_POST['contactno']);
				$_POST['secque'] = addslashes($_POST['secque']);
				$_POST['secans'] = addslashes($_POST['secans']);
				
			}

			// now we insert it into the database			
			
			if ($message == "")
			{
			   $insert = "INSERT INTO users (username, password, cname, emailid, contactno,secque,secans) VALUES ('".$_POST['username']."', '".$_POST['pass']."','".$_POST['cname']."','".$_POST['emailid']."','".$_POST['contactno']."','".$_POST['secque']."','".$_POST['secans']."')";
 			   $add_member = mysql_query($insert);
 		    }
			
			if ($add_member && $message == "") 
			{
				$create_tables_query = "CREATE TABLE ".$_POST['username']."_account_name (".
				  "refid int(11) NOT NULL auto_increment,".
				  "acc_name varchar(30) NOT NULL default '',".
				  "acc_head enum('bs','tr','pl') NOT NULL default 'bs',".
				  "group_head enum('asset','liability','debit','credit') NOT NULL default 'asset',".
				  "other_details text,".
				  "act_group_head varchar(50) NOT NULL,".
				  "opening_balance bigint(15) default '0',".
				  "opening_balance_type enum('debit','credit') default NULL,".
				  "closing_balance bigint(15) default '0',".
				  "closing_balance_type enum('debit','credit') default NULL,".
				  "status char(1) default NULL,".
				  "backup char(1) default NULL, ".
				  "PRIMARY KEY  (refid)".
				") ENGINE=MyISAM DEFAULT CHARSET=latin1;";
				
				$create_tables_query1 = "CREATE TABLE ".$_POST['username']."_daybook (".
				  "refid int(10) NOT NULL auto_increment,".
				  "dayBookDate date NOT NULL default '0000-00-00',".
				  "debit varchar(50) NOT NULL default '',".
				  "credit varchar(50) NOT NULL default '',".
				  "dayBookContra enum('Y','N') NOT NULL default 'Y',".
				  "dayBookAmount double NOT NULL default '0',".
				  "description text NOT NULL,".
				  "status char(1) NOT NULL default '',".
				  "backup char(1) NOT NULL default '',".
				  "PRIMARY KEY  (refid)".
				  ") ENGINE=MyISAM DEFAULT CHARSET=latin1;";
 				//echo $create_tables_query;
 				
				//$create_tables_result = mysql_query($create_tables_query);
				
				
				
				if (mysql_query($create_tables_query) && mysql_query($create_tables_query1))
				{
					
					$insert_data = "INSERT INTO ".$_POST['username']."_account_name VALUES(1,'CASH', 'bs', 'asset', 'CASH', 'CASH', 0, 'debit', 0, NULL, NULL, NULL)";
				mysql_query($insert_data);	
				
				$insert_data = "INSERT INTO ".$_POST['username']."_account_name VALUES(2,'SALES', 'tr', 'credit', 'SALES ACCOUNT', 'SALES', 0, NULL, 0, NULL, NULL, NULL)";
				
				mysql_query($insert_data);
				
				$insert_data = "INSERT INTO ".$_POST['username']."_account_name VALUES(3,'PURCHASE', 'tr', 'debit', 'PURCHASE ACCOUNT', 'PURCHASE', 0, NULL, 0, NULL, NULL, NULL)";
				
				mysql_query($insert_data);
					
				$insert_data = "INSERT INTO ".$_POST['username']."_account_name VALUES(4,'CAPITAL', 'bs', 'liability', 'CAPITAL INVESTED', 'CAPITAL', 0, 'debit', 0, NULL, NULL, NULL)";
				
				mysql_query($insert_data);
				
				$insert_data = "INSERT INTO ".$_POST['username']."_account_name VALUES(5,'OFFICE EXPENSES', 'pl', 'debit', 'OFFICE EXPENSES', 'INDIRECT EXPENSES', 0, NULL, 0, NULL, NULL, NULL)";
				
				mysql_query($insert_data);
				
				$insert_data = "INSERT INTO ".$_POST['username']."_account_name VALUES(6,'MOBILE EXPENSES', 'pl', 'debit', 'MOBILE EXPENSES', 'INDIRECT EXPENSES', 0, NULL, 0, NULL, NULL, NULL)";
				mysql_query($insert_data);
				$insert_data = "INSERT INTO ".$_POST['username']."_account_name VALUES(7,'ACCOUNTING FEES', 'pl', 'debit', 'ACCOUNTING EXPENSES', 'INDIRECT EXPENSES', 0, NULL, 0, NULL, NULL, NULL)";
				mysql_query($insert_data);
				$insert_data = "INSERT INTO ".$_POST['username']."_account_name VALUES(8,'AUDIT FEES', 'pl', 'debit', 'AUDIT EXPENSES', 'INDIRECT EXPENSES', 0, NULL, 0, NULL, NULL, NULL)";
				mysql_query($insert_data);
				$insert_data = "INSERT INTO ".$_POST['username']."_account_name VALUES(9,'LEGAL FEES', 'pl', 'debit', 'LEGAL EXPENSES', 'INDIRECT EXPENSES', 0, NULL, 0, NULL, NULL, NULL)";
				mysql_query($insert_data);
				$insert_data = "INSERT INTO ".$_POST['username']."_account_name VALUES(10,'CUSTOMER 1', 'bs', 'asset', '', 'SUNDRY DEBTORS', 0, NULL, 0, NULL, NULL, NULL)";
				mysql_query($insert_data);
				$insert_data = "INSERT INTO ".$_POST['username']."_account_name VALUES(11,'CUSTOMER 2', 'bs', 'asset', 'CUSTOMER ACCOUNT2', 'SUNDRY DEBTORS', 0, 'debit', 0, NULL, NULL, NULL)";
				mysql_query($insert_data);
				$insert_data = "INSERT INTO ".$_POST['username']."_account_name VALUES(12,'RESERVES', 'bs', 'liability', '', 'RESERVES', 0, NULL, 0, NULL, NULL, NULL)";
				mysql_query($insert_data);		
				$insert_data = "INSERT INTO ".$_POST['username']."_account_name VALUES(13,'TERM LOAN', 'bs', 'liability', 'TERM LOAN TAKEN', 'TERM LOAN', 0, NULL, 0, NULL, NULL, NULL)";
				mysql_query($insert_data);
				$insert_data = "INSERT INTO ".$_POST['username']."_account_name VALUES(14,'VENDOR OR SUPPLIER 1', 'bs', 'liability', 'VENDOR OR SUPPLIER 1', 'SUNDRY CREDITORS', 0, 'debit', 0, NULL, NULL, NULL)";
				mysql_query($insert_data);
				$insert_data = "INSERT INTO ".$_POST['username']."_account_name VALUES(15,'VENDOR OR SUPPLIER 2', 'bs', 'liability', 'VENDOR OR SUPPLIER 2', 'SUNDRY CREDITORS', 0, 'credit', 0, NULL, NULL, NULL)15,";
				mysql_query($insert_data);
				$insert_data = "INSERT INTO ".$_POST['username']."_account_name VALUES(16,'BANK ACCOUNT', 'bs', 'asset', 'BANK CURRENT ACCOUNT', 'BANK CURRENT ACCOUNT', 0, NULL, 0, NULL, NULL, NULL)";
				mysql_query($insert_data);
				$insert_data = "INSERT INTO ".$_POST['username']."_account_name VALUES(17,'INVESTMENTS', 'bs', 'asset', 'INVESTMENTS ACCOUNT', 'INVESTMENTS', 0, NULL, 0, NULL, NULL, NULL)";
				mysql_query($insert_data);
				
					
					$hour = time() + 86400;
					setcookie(username, $_POST['username'], $hour);
					setcookie(userkey, $_POST['pass'], $hour);
					setcookie(cname, $_POST['cname'], $hour);			
					/* 
					then redirect them to the members area 
					*/
					$_SESSION['database'] = $user;
					header("Location: addAccount.php?new=yes");	
					
					echo $user;
					echo $password;
					echo $_POST['cname'];
				} else {
					$message = "Problem in creating user accounts.";
				}
			}	
		} else {	
				
		}		
		?>



<div class="container">
	<div class="row" style="padding-left: 320px;">
		<div class="col-sm-6">
			<div class="well" style="margin:20px; width: 438px;">
				<div class="panel-heading">
				<h4>Register</h4>
				</div>	
				<div class="panel-body">	
				<?php if ($message == ""){
					   }else{
						  echo "<div class=\"alert alert-warning\">".$message."</div>";
					   } 
				?>		
				<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
					<div class="form-group">
						<div class="form-group input-group">
							<span class="input-group-addon"><i class="material-icons">person_outline</i></span>
							<input type="text" class="form-control" placeholder="Username" name="username" id="username" maxlength="30" value="<?php echo $_POST['username']; ?>" />
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon"><i class="material-icons">lock_outline</i></span>
							<input type="password" class="form-control" placeholder="Password" name="pass" id="pass" maxlength="20" value="<?php echo $password; ?>" />
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon"><i class="material-icons">lock_outline</i></span>
							<input type="password" class="form-control" placeholder="Confirm Password" name="pass2" id="pass2" maxlength="20" value="<?php echo $_POST['pass2']; ?>" />
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon"><i class="material-icons">card_travel</i></span>
							<input type="text" class="form-control" placeholder="Company Name / Individual Name" name="cname" id="cname" maxlength="20" value="<?php echo $_POST['cname']; ?>" />
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon"><i class="material-icons">mail_outline</i></span>
							<input type="text" class="form-control" placeholder="Email Address" name="emailid" id="emailid" maxlength="50" value="<?php echo $_POST['emailid']; ?>" />
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon"><i class="material-icons">perm_contact_calendar</i></span>
							<input type="text" class="form-control" placeholder="Contact Number" name="contactno" id="contactno" maxlength="15" value="<?php echo $_POST['contactno']; ?>" />
						</div>
						
						<div class="form-group input-group">
							<span class="input-group-addon"><i class="material-icons">security</i></span>
							<input type="text" class="form-control" placeholder="Secret Question" name="secque" id="secque" value="<?php echo $_POST['secque']; ?>" />
						</div>
						
						<div class="form-group input-group">
							<span class="input-group-addon"><i class="material-icons">security</i></span>
							<input type="text" class="form-control" placeholder="Secret Answer" name="secans" id="secans" value="<?php echo $_POST['secans']; ?>" />
						</div>
						<button class="btn btn-raised btn-info" type="submit" name="submit" onclick="javascript:return validateEntries()">Register</button>
					</div>
				</form>
				</div>
			</div>			
		</div>
	</div>
</div> 
<a id="portfolio" href="home.php" title="Home!"><i class="material-icons">home</i></a>
<a id="codepen" href="facebook.com/JeraldPenus" title="Follow me!"><img src="img/github.png" style="padding-top: 11px;"></a>
</body>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/material.min.js"></script>
<script src="js/ripples.min.js"></script>
</html>
<?php ob_end_flush(); ?>