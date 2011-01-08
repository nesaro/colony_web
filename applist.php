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
    <br />
<?php
    include('lib.php');
    #FIXME: protect app var from command line injection

    //if $_POST array if empty:
    //Call command to get function index
    if (count($_POST) == 0 && count($_GET) == 0)
    {
        echo exec($BINARY." -c webindex -p");
        return;
    }
    elseif (count($_POST) == 0 && count($_FILES) == 0)
    {
        if (isset($_GET["mode"]) && isset($_GET["app"]) && ($_GET["mode"] == "translate"))
        {
            checkColonyName($_GET["app"]);
            $inputdic = arrayToDic(array("input" => $_GET["app"], "session" => rand()));
            $outputdic = arrayToDic(array("output" => "stdout"));
            echo exec($BINARY." -t webdisplaypage -e ".$inputdic."  -o ".$outputdic);
        }
        elseif (isset($_GET["mode"]) && isset($_GET["app"]) && ($_GET["mode"] == "procedure"))
        {
            checkColonyName($_GET["app"]);
            echo exec($BINARY." -c ".$_GET["app"]." -p ");
        }
        else
        {
            echo "Unknown mode";
        }
        return;
    }
    else
    {
        checkColonyName($_GET["app"]);
        //generate requestsession directory
        $tmpdir = sys_get_temp_dir();
        //TODO: check if directory already exists
        $workdir = $tmpdir."/".$_POST["session"];
        mkdir($workdir);
        //store dir in requestsession table
        $query = "INSERT INTO apprequest (appsession, app, iduser, tmppath) VALUES ('".mysql_real_escape_string($_POST["session"])."','".mysql_real_escape_string($_GET["app"])."','".mysql_real_escape_string($uid)."','".mysql_real_escape_string($workdir)."')";
        mysql_query($query) or die(mysql_error());


        //generate a $_POST copy, delete session entry

        $mypost = $_POST;
        unset($mypost['session']);

        $inputdic = "{";
        //store results at directory
        foreach ($mypost as $key => $value)
        {
            file_put_contents($workdir."/".$key, $value); 
            $inputdic .= "\\\"".$key."\\\":\\\"".$workdir."/".$key."\\\",";
        }
        foreach ($_FILES as $key => $value)
        {
            move_uploaded_file($value['tmp_name'], $workdir."/".$key); 
            $inputdic .= "\\\"".$key."\\\":\\\"".$workdir."/".$key."_wrapper\\\",";
            file_put_contents($workdir."/".$key."_wrapper", $workdir."/".$key); 
        }
        $inpudic[strlen($inputdic)-1] = '}';
        $inputdic = substr($inputdic, 0, strlen($inputdic)-1)."}";

        $inputdicout = arrayToDic(array("input" => $_GET["app"]));
        $outputdicout = arrayToDic(array("output" => "stdout"));
        $filelistout =  exec($BINARY." -t outputlist -e ".$inputdicout."  -o ".$outputdicout);
        $filearrayout = explode(',', $filelistout);

        $outputdic = "{";
        foreach ($filearrayout as $value) {
            $outputdic = $outputdic."\\\"".$value."\\\":\\\"".$workdir."/".$value."\\\",";
        }
        $outputdic[strlen($outputdic)-1] = '}';
        exec($BINARY." -t ".$_GET["app"]." -i ".$inputdic." -o ".$outputdic);
        header('Location:result.php?requestsession='.$_POST['session']);

    }

?>
