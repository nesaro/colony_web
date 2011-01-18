<?php

include ('config.php');
mysql_connect($DBHOST, $DBUSER, $DBPASS);
mysql_select_db($DBNAME);
$query = "SELECT name FROM users ";
$query .= "WHERE name='".mysql_real_escape_string($_POST['username'])."'";
$result = mysql_query($query);
if(mysql_num_rows($result)) {
    die("Username exists");
} 
if($_POST['userlevel'] != 1)
{
    die("Account type not available");
}
$query = "INSERT into users (name, password, userlevel) VALUES ('";
$query .= mysql_real_escape_string($_POST['username'])."','";
$query .= mysql_real_escape_string($_POST['password'])."',1)";
echo $query;
$result = mysql_query($query) or die(mysql_error());
header('Location:index.php');

?>

