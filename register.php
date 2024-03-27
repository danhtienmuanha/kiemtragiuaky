<?php
session_start();
include 'config/connect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST['username'];
    $password = $_POST['password']; 
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];

    
    $check_user_query = "SELECT * FROM User WHERE username='$username' OR email='$email' LIMIT 1";
    $result = $conn->query($check_user_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { 
        echo "Tài khoản đã tồn tại";
    } else {
       
        $query = "INSERT INTO User (username, password, fullname, email, role) VALUES('$username', '$password', '$fullname', '$email', 'user')";
        mysqli_query($conn, $query);
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'user';
        header('location: index.php'); 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>
</head>
<body>
    <h2>Đăng ký tài khoản</h2>
    <form action="register.php" method="POST">
        <label for="username">Tên đăng nhập:</label><br>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Mật khẩu:</label><br>
        <input type="password" id="password" name="password" required><br>

        <label for="fullname">Họ và tên:</label><br>
        <input type="text" id="fullname" name="fullname" required><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>

        <input type="submit" value="Đăng ký">
    </form>
    
</body>
</html>
