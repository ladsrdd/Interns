<?php
include 'conn.php';
if (isset($_GET['suppid'])){
    $id=$_GET['suppid'];

    $sql= "DELETE FROM form where id=$id";
    $result=mysqli_query($conn,$sql);
    if($result){
        header('location:rech.php');
    }
    else{
        die(mysqli_error($conn));
    }

}








?>