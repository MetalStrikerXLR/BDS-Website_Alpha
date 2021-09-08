<?php
    $Course_ID = $_GET['CID'];
    $Student_ID = $_GET['SID'];

    echo $Course_ID;
    echo $Student_ID;

    //$servername = "sql302.epizy.com";
    //$usernameDB = "epiz_25899308";
    //$passwordDB = "MIShdzzsf8";
    //$DBname = "epiz_25899308_Blood_Donation";

    $servername = "localhost";
    $username = "root";
    $password = "";
    $DBname = "Blood_Donation_DB";

    $connection = new mysqli($servername, $usernameDB, $passwordDB, $DBname);

    //Check Connection
    if($connection->connect_error)
    {
        die("Connection failed: " . $connection->connect_error);
        echo "<br>";
    }

    $sql_query_delete = "Delete From Registration Where Course_ID = '".$Course_ID."' AND Student_ID = '".$Student_ID."' ";
    $connection->query($sql_query_delete);
    header("Location: Student_Panel.php");

    $connection->close();

?>