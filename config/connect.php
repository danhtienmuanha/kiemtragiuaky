<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "ql_nhansu"; 

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}
