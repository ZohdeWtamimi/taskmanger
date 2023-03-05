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

    $task->id=$_POST["id"];
    

    if($task->deleteUser()){
        echo json_encode("task deleted.");

    } else{
        echo json_encode("Failed to create task.");
    }
?>