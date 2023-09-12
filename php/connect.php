<?php

$severname = "localhost";
$username = "root";
$password = "";
$db = "signupform";

try{
$conn = mysqli_connect($severname,$username,$password,$db);
if($conn){
}
else{
    die("failed to connect to databae");
}
}
catch(Exception $e){
    echo $e;
}

