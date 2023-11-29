<?php

include "./database.php";
session_start();
$conn = new kapcsolat();

$res = $conn->getImageById($_GET['id']);

if(!isset($_SESSION['email'])){
    header("Location: login.php");
}

if(isset($_GET['type']) && isset($_GET['id']) && isset($_SESSION['email'])){
    if($_GET['type'] == '1'){
        $conn->addLike($_SESSION['id'], $_GET['id']);
    }else{
        $conn->addDislike($_SESSION['id'], $_GET['id']);
        
    }
    foreach($res as $img){
        header("Location: view.php?v=".$img['filename']);
    }
}


?>