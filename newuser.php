<?php
    include('session.php');
    $uid = checkSession();
    if ($uid)
    {
        header('Location:index.php');
        return;
    }
    
?>
<html>
<body>
<h2>User registration </h2>
<h2>Which user type do you want to be</h2>
<form action="https://nesaro.servebeer.com/do_newuser.php" method="POST">
Username: <input type="text" name="username"></input><br />
<select name="userlevel">
<?php
include ('config.php');
mysql_connect($DBHOST, $DBUSER, $DBPASS);
mysql_select_db($DBNAME);
$query = "SELECT id, name, description FROM userlevel ";
$result = mysql_query($query) or die(mysql_error());
while($info = mysql_fetch_array( $result ))
{
    echo '<option value="'.$info['id'].'">'.$info['name'].': '.$info['description'].'</option>';
}
?>
</select><br />
Password: <input type="password" name="password"></input><br />
<input type="submit" value="Continue"></input>
</form>
</body>
</html>
