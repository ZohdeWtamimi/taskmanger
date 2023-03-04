<?php
    header("Access-Control-Allow-Origin:*");
    header("Content-Type: application/json;");
    header("Access-Control-Allow-Methods: *");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config.php';
    include_once './post.php';

    $database = new DB();
    $db = $database->getConnection();

    $post = new post($db);
    if(count($_FILES) > 0) {
        if($_FILES["post_img"]){
            $post->post_img=$_FILES["post_img"]["name"];
            move_uploaded_file($_FILES["post_img"]["tmp_name"], "../upload/" . $_FILES["post_img"]["name"]);
        }
       
    }

    $post->id= $_POST["id"];
    $post->body=$_POST["body"];
    $post->user_id=$_POST["user_id"];
    $post->group_id=$_POST["group_id"];
    
    
    

    if($post->updatePost()){
        echo json_encode("post update.");

    } else{
        echo json_encode("Failed to create post.");
    }
?>