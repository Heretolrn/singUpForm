<?php
function usernameExists($conn,$username){
    $result;
    $sql = "SELECT * from info where username=?;";
    $stmt = mysqli_stmt_init($conn);
    if(mysqli_stmt_prepare($stmt,$sql)){
       mysqli_stmt_bind_param($stmt, "s",$username);
       mysqli_stmt_execute($stmt);
       $result = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($result) > 0){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }
}

function emailExists($conn,$email){
    $result;
    $sql = "SELECT * from info where email=?;";
    $stmt = mysqli_stmt_init($conn);
    if(mysqli_stmt_prepare($stmt,$sql)){
       mysqli_stmt_bind_param($stmt, "s",$email);
       mysqli_stmt_execute($stmt);
       $result = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($result) > 0){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }
}



