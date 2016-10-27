  <meta charset="utf-8">
	
  <!-- Mobile support -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Bootstrap Material</title>

  <!-- Material Design fonts -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/material.css">
  <link rel="stylesheet" href="css/ripples.css">

  <script src="js/material.min.js"></script>
  <script src="js/ripples.min.js"></script>
<section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <br><br><br><br><img src="img/laptop.png">
                </div>
            </div>				
            <div class="row">
                <div class="text-center">
                    <h1>Accounting System</h1>
										<h3>A Set of Components that Implement<br>
										Google's Material Design</h3>
                </div>
            </div>
            <div class="row">
                
                    <script>
										function validateEntries() 
										{
											$.material.init()
											var reg = /[a-zA-Z]{1}[a-zA-Z0-9]{5,19}$/
											var str = document.getElementById("username").value;
											if (!(str.match(reg)))
											{
												document.getElementById("message").innerHTML = "<div class=\"alert alert-warning\">Not a valid username. Please enter alpha numeric minimum of 6 characters and maximum of 20 characters and should start with alphabet.</div>";
												return false;	
											}
											
											var reg = /^[A-Za-z]\w{6,}$/;
											var str = document.getElementById("pass").value;
											if (!(str.match(reg)))
											{
												document.getElementById("message").innerHTML = "<div class=\"alert alert-warning\">Please enter a valid password!</div>";
												return false;	
											}	
											return true;
										}
										</script>
										<?php	include_once 'nav1.php';?>
										</head>
										<body>
										<?php	include_once 'lib.dbconnect.php';?>

										<div class="container">
										<div class="text-center">

											<button type="button" class="btn btn-info" id="signin">Login</button>
											<a class="btn btn-info" href="register.php" role="button">Register</a>
											<br><br><br><br>
											</div>
											<div class="modal fade in" id="signinmodal" role="dialog" style="margin-top: 80px;">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 style="color:black;">Member Login</h4>
														</div>
														<div class="modal-body">
													<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
														
															<div class="form-group">	
																<div class="form-group input-group">
																<span class="input-group-addon"><i class="material-icons">person_outline</i></span>
																	<input  type="text" class="form-control" placeholder="Username" name="username" id="username" maxlength="20" />
																</div>
																<div class="form-group input-group">
																<span class="input-group-addon"><i class="material-icons">lock_outline</i></span>
																	<input type="password" class="form-control" placeholder="Password" name="pass" id="pass" maxlength="50" />
																</div>
																
																<button class="btn btn-raised btn-info" type="submit" name="submit" onclick="javascript:return validateEntries()" value="Login">Login</button>
																
																<div id="message">&nbsp;&nbsp; <?php echo $message ?></div>
															</div
															
												</form>
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
															</div>
													</div>
													
												</div>
											</div>

										<script>
										$(document).ready(function(){
												$("#signin").click(function(){
														$("#signinmodal").modal();
												});
										});
										</script>

										</div>
										</div>
											
										<?php
											//if the login form is submitted
											if (isset($_POST['submit'])) 
											{ 
												/* echo "Username :".$_POST['username'];
												echo "Password :".$_POST['pass'];
												*/
												
												if(!$_POST['username'] | !$_POST['pass']) {
													$message ='<div class="alert alert-warning">You did not fill in a required field.</div>';
												}
												if (!get_magic_quotes_gpc()) {
													$_POST['username'] = addslashes($_POST['username']);
												}
												$query = "SELECT * FROM users WHERE username = '".$_POST['username']."'";	
												$check = mysql_query($query)or die(mysql_error());
												$check2 = mysql_num_rows($check);
												if ($check2 == 0) {
													$message = '<div class="alert alert-warning">Incorrect username or password.</div>';
												}
												while($info = mysql_fetch_array( $check ))
												{
													$_POST['pass'] = stripslashes($_POST['pass']);
													$info['password'] = stripslashes($info['password']);		
													$password = $_POST['pass'];		
													if ($password != $info['password']) {
														$message = '<div class="alert alert-warning">Incorrect password, please try again.</div>';
													} else {
														/* if login is ok then we add a cookie */
														$_POST['username'] = stripslashes($_POST['username']);
														$hour = time() + 86400;
														setcookie(username, $_POST['username'], $hour);
														setcookie(userkey, $password, $hour);
														setcookie(cname, $_POST['cname'], $hour);			
														/* then redirect them to the members area */
														$_SESSION['database'] = $_POST['username'];
														header("Location: index.php");
													}
												}
										}?>
                </div>
								
            </div>
        </div>
    </section>
		