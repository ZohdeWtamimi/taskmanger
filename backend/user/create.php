<?php
    header("Access-Control-Allow-Origin:*");
    header("Content-Type: application/json;");
    header("Access-Control-Allow-Methods: *");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config.php';
    include_once './users.php';

    $database = new DB();
    $db = $database->getConnection();

    $user = new User($db);
   
    $data = json_decode(file_get_contents("php://input"));
    
    $user->name = $data->name;
    $user->password = $data->password;
    $user->email = $data->email;
    if($user->createUser()){
        print_r(json_encode($data)) ;

    } else{
        echo json_encode("Failed to create user.");
    }
?>