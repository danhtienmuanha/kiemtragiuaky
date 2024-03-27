<?php
session_start();


if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
   
    header('location: login.php');
    exit(); 
}


if (!isset($_GET['id'])) {
    
    header('location: index.php');
    exit();
} else {
    
    include 'config/connect.php';

   
    $ma_nv = $_GET['id'];

  
    $sql = "DELETE FROM NHANVIEN WHERE Ma_NV = '$ma_nv'";

    if ($conn->query($sql) === TRUE) {
       
        header('location: index.php');
        exit();
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>
