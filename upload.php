<?php

include "database.php";

if(isset($_FILES['image']) && isset($_POST['uploadImg'])){
    $errors= array();
    $file_name = $_FILES['image']['name'];
    $file_size =$_FILES['image']['size'];
    $file_tmp =$_FILES['image']['tmp_name'];
    $file_type=$_FILES['image']['type'];
    $tmp = explode('.', $file_name);
    $file_ext = end($tmp);
    
    $title = $_REQUEST['title'];
    $desc = $_REQUEST['desc'];

    $extensions= array("jpeg","jpg","png");
    
    if(in_array($file_ext,$extensions)=== false){
       $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }
    
    if($file_size > 20971520){
       $errors[]='File size must be excately 2 MB';
    }
    
    if(empty($errors)==true){
       move_uploaded_file($file_tmp,"uploads/".date("YmdH_i_s")."_".$file_name);
       echo "Success";
       $conn = new kapcsolat();
       $lastId = $conn->uploadPhoto($title, $desc, date("YmdH_i_s")."_".$file_name);
       

       $result = $conn->getAllTag();
       foreach($result as $tag){
         if(isset($_POST['tag_'.$tag['id']])){
            $conn->addTagToPhoto($tag, $lastId);
         }
       }

       header('Location: ./view.php?v='.date("YmdH_i_s")."_".$file_name);
       die();
    }else{
       print_r($errors);
    }
 }
?>