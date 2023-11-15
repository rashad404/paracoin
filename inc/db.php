<?php

$mysqli_host = 'localhost';
$mysqli_user = 'root';
$mysqli_db = 'livescore';
$mysqli_pass = 'root';


//$mysqli_user = 'xfscores19_fs';
//$mysqli_db = 'xfscores19_fs';
//$mysqli_pass = 'keVFSnXC';


$link = mysqli_connect($mysqli_host,$mysqli_user,$mysqli_pass,$mysqli_db);

// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>