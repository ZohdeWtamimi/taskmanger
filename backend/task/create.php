<?php
    header("Access-Control-Allow-Origin:*");
    header("Content-Type: application/json;");
    header("Access-Control-Allow-Methods: *");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config.php';
    include_once './task.php';

    $database = new DB();
    $db = $database->getConnection();

    $task = new task($db);

    $task->user_id=$_POST["user_id"];
    $task->name=$_POST["name"];
    $task->category_id=$_POST["category"];
    $task->priority=$_POST["priority"];
    $task->completed=$_POST["completed"];
    

    if($task->createtask()){
        echo json_encode("task created.");

    } else{
        echo json_encode("Failed to create task.");
    }
?>