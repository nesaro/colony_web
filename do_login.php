<?php

//FIXME: mysql injection

include ('config.php');
mysql_connect($DBHOST, $DBUSER, $DBPASS);
mysql_select_db($DBNAME);
$query = "SELECT id, name, password FROM users ";
$query .= "WHERE name='".$_POST['user']."' AND password='".$_POST['pass']."'";
$result = mysql_query($query);
if(mysql_num_rows($result)) {
    $ids = rand();
    $info = mysql_fetch_array( $result );
    setcookie("ids",$ids,time()+3600);
    $sessionquery = "INSERT INTO websession (websession, iduser) VALUES ('".$ids."','".$info['id']."')";
    $result = mysql_query($sessionquery);
    header('Location:index.php');

} else {
    print("Sorry, this login is invalid.");
    exit;
}

?>
