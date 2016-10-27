<?php
error_reporting(E_ERROR | E_PARSE);
$database_hostname = "localhost";
$database_username = "install";
$database_password = "installuser";
$main_database = "daybooka_daybook";
mysql_connect($database_hostname,$database_username,$database_password);
mysql_select_db("daybooka_daybook");
?>