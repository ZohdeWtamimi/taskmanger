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
        $sql="SELECT * FROM users ORDER BY ID DESC LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        print_r(json_encode($user));
        // print_r(json_encode($data)) ;

    } else{
        echo json_encode("Failed to create user.");
    }
?>