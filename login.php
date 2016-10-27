<?php 
session_start();
ob_start(); 
?>
<!DOCTYPE html>
<html>
  <head>
  <meta charset="UTF-8">
  <title>Material Login Form</title>
    
    
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="css/style.css">

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

<?php include_once 'lib.dbconnect.php';?>

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
    
<br><br>

<div class="container">
  <div class="card"></div>
  <div class="card">
    <h1 class="title">Login</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
      <div class="input-container">
        <input type="text" class="form-control" placeholder="Username" name="username" id="username" maxlength="20" />
        <label for="Username">Username</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input type="password" class="form-control" placeholder="Password" name="pass" id="pass" maxlength="50" />
        <label for="Password">Password</label>
        <div class="bar"></div>
      </div>
      <div class="button-container" type="submit" name="submit" onclick="javascript:return validateEntries()" value="Login">
        <button><span>Go</span></button>
      </div>
      <div id="message">&nbsp;&nbsp; <?php echo $message ?></div>
      <div class="footer"><a href="#">Forgot your password?</a></div>
    </form>
  </div>
  <div class="card alt">
    <div class="toggle"></div>
    <h1 class="title">Register
      <div class="close"></div>
    </h1>
    <form>
		
		<div class="input-container">
        <input type="text" id="Username" required="required"/>
        <label for="Username">Username</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input type="text" id="Username" required="required"/>
        <label for="Username">Username</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input type="password" id="Password" required="required"/>
        <label for="Password">Password</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input type="password" id="Repeat Password" required="required"/>
        <label for="Repeat Password">Repeat Password</label>
        <div class="bar"></div>
      </div>
      <div class="button-container">
        <button><span>Next</span></button>
      </div>
      <div id="message">&nbsp;&nbsp; <?php echo $message ?></div>
    </form>
  </div>

</div>
<!-- Portfolio--><a id="portfolio" href="home.php" title="Home"><i class="material-icons">home</i></a>
<!-- CodePen--><a id="codepen" href="https://codepen.io/JeraldPenus/" title="Follow me!"><i class="fa fa-codepen"></i></a>

    <script src='js/jquery.min.js'></script>
    <script src="js/index.js"></script>

    
    
  </body>
</html>
<?php ob_end_flush() ?>