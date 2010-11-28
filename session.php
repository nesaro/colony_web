<?php

include('config.php');
mysql_connect($DBHOST, $DBUSER, $DBPASS);
mysql_select_db($DBNAME);

function checkSession()
{
    if (!isset($_COOKIE['ids']) || $_COOKIE['ids'] < 1)
    {
        return NULL;
    }
    else
    {
        $query = "SELECT * FROM websession WHERE websession='".$_COOKIE['ids']."'";
        $result = mysql_query($query) or die(mysql_error());
        $info = mysql_fetch_array( $result );
        return $info['iduser'];
    }
}

?>
