<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json;");
    
    include_once '../config.php';
    // include_once './users.php';

    $database = new DB();
    $db = $database->getConnection();
    $sql="SELECT * FROM `category`";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r(json_encode($categories));
?>