<?php
    include('session.php');
    $uid = checkSession();
    if (!$uid)
    {
        header('Location:login.php');
        return;
    }
    
?>
    <a href="do_logout.php">Logout</a>
<?php

    $binary = "clnyi.py";
    #TODO: protect app from command line injection

    //if $_POST array if empty:
    //Call command to get function index
    if (count($_POST) == 0 && count($_GET) == 0)
    {
        echo exec($binary." -c webindex -p");
        return;
    }
    elseif (count($_POST) == 0)
    {
        if (isset($_GET["mode"]) && isset($_GET["app"]) && ($_GET["mode"] == "translate"))
        {
            $inputdic = "{\\\"input\\\":\\\"".$_GET["app"]."\\\"\\,\\\"session\\\":\\\"".rand()."\\\"}";
            $outputdic = "{\\\"output\\\":\\\"stdout\\\"}";
            echo exec($binary." -t webdisplaypage -e ".$inputdic."  -o ".$outputdic);
        }
        elseif (isset($_GET["mode"]) && isset($_GET["app"]) && ($_GET["mode"] == "procedure"))
        {
            echo exec($binary." -c ".$_GET["app"]." -p ");
        }
        else
        {
            echo "Unknown mode";
        }
        return;
    }
    else
    {
        //generate requestsession directory
        $tmpdir = sys_get_temp_dir();
        $workdir = $tmpdir."/".$_POST["session"];
        mkdir($workdir);
        //store dir in requestsession table
        $query = "INSERT INTO apprequest (appsession, iduser, tmppath) VALUES ('".$_POST["session"]."','".$uid."','".$workdir."')";
        mysql_query($query) or die(mysql_error());


        //generate a $_POST copy, delete session entry

        $mypost = $_POST;
        unset($mypost['session']);

        $inputdic = "{";
        //store results at directory
        foreach ($mypost as $key => $value)
        {
            file_put_contents($workdir."/".$key, $value); 
            $inputdic = $inputdic."\\\"".$key."\\\":\\\"".$workdir."/".$key."\\\",";
        }
        $inpudic[strlen($inputdic)-1] = '}';
        $inputdic = substr($inputdic, 0, strlen($inputdic)-1)."}";
        $outputdic = "{\\\"output\\\":\\\"".$workdir."/output\\\"}";
        exec($binary." -t ".$_GET["app"]." -i ".$inputdic." -o ".$outputdic);
        header('Location:result.php?requestsession='.$_POST['session']);

        //refresh to result.php?requestsession=value
    }

?>
