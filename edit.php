<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập và có quyền 'admin' chưa
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    // Nếu không, chuyển hướng đến trang đăng nhập
    header('location: login.php');
    exit(); // Dừng thực thi script
}

// Kiểm tra xem đã có mã nhân viên được chọn để sửa chưa
if (!isset($_GET['id'])) {
    // Nếu không, chuyển hướng đến trang index.php hoặc thông báo lỗi
    header('location: index.php');
    exit();
} else {
    // Kết nối CSDL
    include 'config/connect.php';

    // Lấy mã nhân viên từ URL
    $ma_nv = $_GET['id'];

    // Query lấy thông tin nhân viên từ CSDL
    $sql = "SELECT * FROM NHANVIEN WHERE Ma_NV = '$ma_nv'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Xử lý form sửa nhân viên
        if (isset($_POST['submit'])) {
            // Lấy dữ liệu từ form
            $ten_nv = $_POST['ten_nv'];
            $phai = $_POST['phai'];
            $noi_sinh = $_POST['noi_sinh'];
            $ma_phong = $_POST['ma_phong'];
            $luong = $_POST['luong'];

            // Query cập nhật thông tin nhân viên vào CSDL
            $update_sql = "UPDATE NHANVIEN 
                           SET Ten_NV = '$ten_nv', Phai = '$phai', Noi_Sinh = '$noi_sinh', 
                               Ma_Phong = '$ma_phong', Luong = $luong 
                           WHERE Ma_NV = '$ma_nv'";

            if ($conn->query($update_sql) === TRUE) {
                // Chuyển hướng đến trang index.php hoặc thông báo thành công
                header('location: index.php');
                exit();
            } else {
                echo "Lỗi: " . $conn->error;
            }
        }
    } else {
        // Không tìm thấy nhân viên có mã tương ứng
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

