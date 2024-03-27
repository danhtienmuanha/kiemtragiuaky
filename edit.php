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

    
    $sql = "SELECT * FROM NHANVIEN WHERE Ma_NV = '$ma_nv'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

       
        if (isset($_POST['submit'])) {
           
            $ten_nv = $_POST['ten_nv'];
            $phai = $_POST['phai'];
            $noi_sinh = $_POST['noi_sinh'];
            $ma_phong = $_POST['ma_phong'];
            $luong = $_POST['luong'];

           
            $update_sql = "UPDATE NHANVIEN 
                           SET Ten_NV = '$ten_nv', Phai = '$phai', Noi_Sinh = '$noi_sinh', 
                               Ma_Phong = '$ma_phong', Luong = $luong 
                           WHERE Ma_NV = '$ma_nv'";

            if ($conn->query($update_sql) === TRUE) {
                
                header('location: index.php');
                exit();
            } else {
                echo "Lỗi: " . $conn->error;
            }
        }
    } else {
        
        echo "Không tìm thấy nhân viên.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Thông Tin Nhân Viên</title>
</head>
<body>
    <h1>Sửa Thông Tin Nhân Viên</h1>
    
    <!-- Form sửa nhân viên -->
    <form action="" method="POST">
        <label for="ma_nv">Mã Nhân Viên:</label><br>
        <input type="text" id="ma_nv" name="ma_nv" value="<?php echo $row['Ma_NV']; ?>" disabled><br>
        
        <label for="ten_nv">Tên Nhân Viên:</label><br>
        <input type="text" id="ten_nv" name="ten_nv" value="<?php echo $row['Ten_NV']; ?>"><br>
        
        <label for="phai">Giới Tính:</label><br>
        <input type="text" id="phai" name="phai" value="<?php echo $row['Phai']; ?>"><br>
        
        <label for="noi_sinh">Nơi Sinh:</label><br>
        <input type="text" id="noi_sinh" name="noi_sinh" value="<?php echo $row['Noi_Sinh']; ?>"><br>
        
        <label for="ma_phong">Mã Phòng:</label><br>
        <input type="text" id="ma_phong" name="ma_phong" value="<?php echo $row['Ma_Phong']; ?>"><br>
        
        <label for="luong">Lương:</label><br>
        <input type="text" id="luong" name="luong" value="<?php echo $row['Luong']; ?>"><br><br>
        
        <input type="submit" name="submit" value="Lưu">
    </form>
</body>
</html>

