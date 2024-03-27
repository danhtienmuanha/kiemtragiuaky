<?php
session_start();
include 'config/connect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST['username'];
    $password = $_POST['password']; 

    
    $check_user_query = "SELECT * FROM User WHERE username='$username' AND password='$password' LIMIT 1";
    $result = $conn->query($check_user_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { 
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $user['role'];
        header('location: index.php');
    } else {
        echo "Thông tin đăng nhập không chính xác";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
</head>
<body>
    <h2>Đăng nhập</h2>
    <form action="login.php" method="POST">
        <label for="username">Tên đăng nhập:</label><br>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Mật khẩu:</label><br>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Đăng nhập">
    </form>
</body>
</html>
