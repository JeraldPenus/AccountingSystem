<?php 
session_start();
ob_start();
?> 
<!DOCTYPE html>
<html lang="en">
<html>
<head>

	<link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/bootstrap.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.min.js"></script>

<script>
function validateEntries() 
{
  
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

</head>
<body>

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

<div class="container">
  <div class="row">
    <div class="Absolute-Center is-Responsive">
      <div id="logo-container"></div>
      <div class="col-sm-12 col-md-10 col-md-offset-1">
        <form action="" id="loginForm" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input type="text" class="checkbox" name="username" id="username" maxlength="20" />          
          </div>
          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input class="form-control" type="password" name='password' placeholder="password"/>     
          </div>
          <div class="checkbox">
            <label>
              <input type="password" class="checkbox" name="pass" id="pass" maxlength="50" />
            </label>
          </div>
          <div class="form-group">
            <button class="btn btn-default" type="submit" name="submit" onclick="javascript:return validateEntries()" value="Login">Login</button>
          </div>
          <div class="form-group text-center">
          <div id="message">&nbsp;&nbsp; <?php echo $message ?></div>
            <a href="#">Forgot Password</a>&nbsp;|&nbsp;<a href="#">Support</a>
          </div>
        </form>        
      </div>  
    </div>    
  </div>
</div>
</body>
</html>

<?php ob_end_flush() ?>