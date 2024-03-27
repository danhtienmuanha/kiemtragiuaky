<?php
session_start();


if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    
    header('location: login.php');
    exit(); 
}

include 'config/connect.php';


if (isset($_POST['submit'])) {
   
    $ma_nv = $_POST['ma_nv'];
    $ten_nv = $_POST['ten_nv'];
    $phai = $_POST['phai'];
    $noi_sinh = $_POST['noi_sinh'];
    $ma_phong = $_POST['ma_phong'];
    $luong = $_POST['luong'];

  
    $sql = "INSERT INTO NHANVIEN (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong) 
            VALUES ('$ma_nv', '$ten_nv', '$phai', '$noi_sinh', '$ma_phong', $luong)";

    if ($conn->query($sql) === TRUE) {
       
        header('location: index.php');
        exit();
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Nhân Viên Mới</title>
</head>
<body>
    <h1>Thêm Nhân Viên Mới</h1>
    
  
    <form action="" method="POST">
        <label for="ma_nv">Mã Nhân Viên:</label><br>
        <input type="text" id="ma_nv" name="ma_nv"><br>
        
        <label for="ten_nv">Tên Nhân Viên:</label><br>
        <input type="text" id="ten_nv" name="ten_nv"><br>
        
        <label for="phai">Giới Tính:</label><br>
        <input type="text" id="phai" name="phai"><br>
        
        <label for="noi_sinh">Nơi Sinh:</label><br>
        <input type="text" id="noi_sinh" name="noi_sinh"><br>
        
        <label for="ma_phong">Mã Phòng:</label><br>
        <input type="text" id="ma_phong" name="ma_phong"><br>
        
        <label for="luong">Lương:</label><br>
        <input type="text" id="luong" name="luong"><br><br>
        
        <input type="submit" name="submit" value="Thêm Nhân Viên">
    </form>
</body>
</html>
