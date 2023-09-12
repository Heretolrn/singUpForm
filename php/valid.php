<?php
require_once "connect.php";
require_once "functions.php";


$data = json_decode(file_get_contents("php://input"));

if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
    // Handle JSON decoding error
    echo "Error decoding JSON data.";
} else {
    // Check if 'fullname' property exists in the decoded data
    if (property_exists($data, 'username') && property_exists($data, 'fullname') && property_exists($data,'age') && property_exists($data,'email') && property_exists($data,'password')) {
        $username = $data->username;
        $fullname = $data->fullname;
        $age = $data->age;
        $email = $data->email;
        $password = $data->password;
        $hashPassword = password_hash($password,PASSWORD_DEFAULT);
        
        if(usernameExists($conn,$username) != false){
            echo "username exist";
            exit();
        }
        if(emailExists($conn,$email) != false){
            echo "email exist";
            exit();
        }
        

        $sql = "INSERT INTO info(username,fullname,age,email,password) VALUES(?,?,?,?,?);";
        $stmt = mysqli_stmt_init($conn);
        if(mysqli_stmt_prepare($stmt,$sql)){
            mysqli_stmt_bind_param($stmt,"sssss",$username,$fullname,$age,$email,$hashPassword);
            if(mysqli_stmt_execute($stmt)){
                echo "Data successfully inserted";
                exit();
            }
        }


        
    } else {
        echo "fullname property not found in the JSON data.";
    }
}

