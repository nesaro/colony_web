<?php
include('session.php');
$uid = checkSession();
?>
<html>
<head>
<?php
echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\"/>";
echo "<link rel=\"stylesheet\" href=\"/main.css\" type=\"text/css\" media=\"screen\" />";
?>
<title>Colony</title>
</head>
<body>
<div id="mainbar">
<?php //User is not registered 
if (!$uid)
{
?>
<a href="login.php">Login</a>
<a href="newuser.php">Sign up</a>
<?php 
}    
else
{
    //User is registered ?>
<a href="do_logout.php">Logout</a>
<a href="applist.php">AppList</a>
<a href="user.php">User</a>
<?php
} 
?>
</div>
<h1>ColonyLogo</h1>
<form name="mainform">
<input type="text" name="search" />
<input type="submit" value="Search app" />
</form>
<h3>Future</h3>
<ul>
    <li><a href="pygraph.php">Python class graph</a></li>
    <li><a href="linkstozip.php">Web links extractor</a></li>
    <li><a href="upperchar.php">UpperChar</a></li>
</ul>
</body>
</html>
