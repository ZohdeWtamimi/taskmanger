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
    if(count($_FILES) > 0) {
        if($_FILES["profileImg"]){
            $user->profile_img=$_FILES["profileImg"]["name"];
            move_uploaded_file($_FILES["profileImg"]["tmp_name"], "../upload/" . $_FILES["profileImg"]["name"]);
        }
        if($_FILES["coverImg"]){
            $user->background_img=$_FILES["coverImg"]["name"];
            move_uploaded_file($_FILES["coverImg"]["tmp_name"], "../upload/" . $_FILES["coverImg"]["name"]);
        }
    }

    $user->id= $_POST["id"];
    $user->user_name=$_POST["user_name"];
    $user->phone=$_POST["phone"];
    $user->email=$_POST["email"];
    

    if($user->updateUser()){
        // cho json_encode("Failed to updated user.");
        print_r(json_encode(['id' => $user->id, 'email' => $user->email, 'user_name'=> $user->user_name, 'phone' => $user->phone, 'background_img' => $user->background_img, 'profile_img'=> $user->profile_img]));
    } else{
        echo json_encode("Failed to create user.");
    }
?>