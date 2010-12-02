<?php

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
