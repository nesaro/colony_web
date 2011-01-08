<?php

/**
 * Checks if string is a colony element identifier
 */
function checkColonyName($mystring)
{
    if (!preg_match("/^\w*$/i",$mystring))
        die("Not a ColonyName: ".$mystring);
    return True;
}


/**
 * Converts an array into a scaped dictionary
 */
function arrayToDic(array $myarray)
{
    $result = "{";
    foreach ($myarray as $key => $value)
    {
        $result .= "\\\"".$key."\\\":\\\"".$value."\\\"\\,";
    }
    $result[strlen($result)-1] = '}';
    return $result;
}

?>
