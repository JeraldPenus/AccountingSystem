<?php 
session_start();
ob_start(); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
<?php
include_once 'nav1.php';
include_once 'header.php';
?>
<meta charset="utf-8">
	
  <!-- Mobile support -->
<meta name="viewport" content="width=device-width, initial-scale=1">


<title>Bootstrap Material</title>

<!-- Material Design fonts -->
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/material.css">	
<link rel="stylesheet" href="css/custom.css">


				    <div class="footer-above">
									<div style="margin: 0px auto; padding: 40px; color: black">
                        <h4>This system came about from my love of Google's Material Design.<br> I currently using this project for a test for few days now <br>and planning to make it better in the coming months.</h4>
                        <i class="material-icons">face</i>
									</div>
              </div>
	    <div style="padding-top: 50px; padding-bottom: 50px; padding-left: 200px; box-sizing: border-box; background-color:white">
									<div style="box-sizing: border-box; content: " "; display: table;">
									<div style="color: rgba(0, 0, 0, 0.870588); background-color: rgb(255, 255, 255); transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; box-sizing: border-box; font-family: Roboto, sans-serif; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); border-radius: 2px; max-width: 300px; margin: 0px 4px 0px 0px; float: left; width: 33%;"><h3 style="font-size: 20px; padding: 0px; margin: 0px; letter-spacing: 0px; font-weight: 500; color: rgba(0, 0, 0, 0.870588); background-color: rgb(238, 238, 238); text-align: center; line-height: 64px;">Codes</h3><a href="#"><img src="img/codes.svg" style="margin-bottom: -6px;"></a></div>
									<div style="color: rgba(0, 0, 0, 0.870588); background-color: rgb(255, 255, 255); transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; box-sizing: border-box; font-family: Roboto, sans-serif; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); border-radius: 2px; max-width: 300px; margin: 0px 4px 0px auto; float: left; width: 33%;"><h3 style="font-size: 20px; padding: 0px; margin: 0px; letter-spacing: 0px; font-weight: 500; color: rgba(0, 0, 0, 0.870588); background-color: rgb(238, 238, 238); text-align: center; line-height: 64px;">Customization</h3><a href="#"><img src="img/customization.svg" style="margin-bottom: -6px;"></a></div>
									<div style="color: rgba(0, 0, 0, 0.870588); background-color: rgb(255, 255, 255); transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; box-sizing: border-box; font-family: Roboto, sans-serif; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); border-radius: 2px; max-width: 300px; margin: 0px 0px 0px auto; float: left; width: 33%;"><h3 style="font-size: 20px; padding: 0px; margin: 0px; letter-spacing: 0px; font-weight: 500; color: rgba(0, 0, 0, 0.870588); background-color: rgb(238, 238, 238); text-align: center; line-height: 64px;">Components</h3><a href="#"><img src="img/components.svg" style="margin-bottom: -6px;"></a></div>
									<div style="box-sizing: border-box; content: &quot; &quot;; clear: both; display: table;"></div>
					</div>	
			</div>
	<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="js/material.min.js"></script>
<script src="js/ripples.min.js"></script>


</body>
</html>
<?php include_once 'footer.php' ?>
<?php ob_end_flush() ?>